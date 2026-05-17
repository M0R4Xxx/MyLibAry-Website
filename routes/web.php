<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookManagementController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\LendingReportController;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// 1. Halaman Utama
Route::get('/', function () { 
    $books = DB::table('books')->inRandomOrder()->take(4)->get(); 
    return view('Landing', compact('books')); 
})->name('landing');

// 2. Halaman Login & Daftar
Route::get('/login', function () { 
    return view('Login'); 
})->name('login');

Route::get('/daftar', function () { 
    return view('Daftar'); 
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/daftar', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'validateEmailRequest'])->name('password.email');

Route::get('/reset-password-form', [AuthController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password-update', [AuthController::class, 'resetPassword'])->name('password.update');


Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::middleware(['admin_access'])->group(function () {

        // A. Dashboard & Panel Utama
        Route::get('/admin-panel', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // B. Manajemen Buku
        Route::controller(BookManagementController::class)->group(function() {
            Route::get('/admin/manage-books', 'index')->name('admin.books');
            Route::post('/admin/manage-books/store', 'store')->name('admin.books.store');
            Route::put('/admin/manage-books/{book}', 'update')->name('admin.books.update');
            Route::delete('/admin/manage-books/{book}', 'destroy')->name('admin.books.destroy');
            Route::get('/admin/manage-books/check-title', 'checkTitle')->name('admin.books.check');
        });

        // C. Manajemen Member & Transaksi
        Route::controller(\App\Http\Controllers\Admin\MemberManagementController::class)->group(function() {
            Route::get('/admin/manage-members', 'index')->name('admin.members');
            Route::post('/admin/manage-members/update-fine/{id}', 'updateFine')->name('admin.members.updateFine');
            Route::post('/admin/manage-members/store', 'store')->name('admin.members.store');
            Route::put('/admin/manage-members/update/{id}', 'update')->name('admin.members.update');
            Route::delete('/admin/manage-members/delete/{id}', 'destroy')->name('admin.members.destroy');

            Route::patch('/admin/member/pay-fine/{id}', 'payFine')->name('admin.member.payFine');
            Route::post('/admin/member/pay-off/{id}', 'payOffFine')->name('admin.member.payOff');
        });

        Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions');
        Route::post('/admin/return-book/{id}', [TransactionController::class, 'returnBook'])->name('admin.returnBook');


        Route::get('/admin/reports', [LendingReportController::class, 'index'])->name('admin.reports');
        Route::get('/admin/reports/export-pdf', [LendingReportController::class, 'exportPdf'])->name('admin.reports.export_pdf');
        Route::get('/admin/reports/export-fine-pdf', [LendingReportController::class, 'exportFinePdf'])->name('admin.reports.export_fine_pdf');
        Route::delete('/admin/reports/{id}', [LendingReportController::class, 'destroy'])->name('admin.reports.destroy');
        Route::delete('/admin/reports/fine-delete/{id}', [LendingReportController::class, 'destroyFineReport'])->name('admin.reports.fineDestroy');

        // D. Permintaan Pinjaman
        Route::prefix('admin')->controller(\App\Http\Controllers\Admin\AdminLoanController::class)->group(function () {
            Route::get('/pending-loans', 'index')->name('admin.loans.index');
            Route::patch('/loans/{id}/approve', 'approve')->name('admin.loans.approve');
            Route::patch('/loans/{id}/reject', 'reject')->name('admin.loans.reject');
        });

        Route::get('/admin/members/check-availability', function (Illuminate\Http\Request $request) {
            try {
                $field = $request->query('field');
                $value = $request->query('value');

                if (!$field || !$value || !in_array($field, ['username', 'email'])) {
                    return response()->json(['exists' => false]);
                }

                $exists = DB::table('users')
                    ->where($field, '=', $value)
                    ->exists();
                    
                return response()->json(['exists' => $exists]);

            } catch (\Exception $e) {
                return response()->json(['error' => 'Server Error', 'exists' => false], 500);
            }
        })->name('admin.members.check');
    });


    Route::post('/logout', [AuthController::class, 'logout'])->name('siswa.logout');
     

    Route::get('/', function () {
        $user = Auth::user(); 
        $userId = $user->user_id;

    $activeLoans = \App\Models\Loan::with('book')
        ->where('user_id', $user->user_id) 
        ->whereIn('status', ['borrowed', 'pending', 'rejected'])
        ->oldest() 
        ->get();

        $currentlyBorrowedIds = \App\Models\Loan::where('user_id', $userId)
            ->whereIn('status', ['borrowed', 'pending'])
            ->pluck('book_id')
            ->toArray();

        $wishlistBookIds = \App\Models\Wishlist::where('user_id', $userId)
            ->pluck('book_id')
            ->toArray();

        $books = \App\Models\Book::whereNotIn('id', $currentlyBorrowedIds)
            ->inRandomOrder()
            ->take(15)
            ->get();

            return view('Siswa.PeminjamanBuku', compact('books', 'activeLoans', 'wishlistBookIds'));
        })->name('siswa.dashboard');

        
    // 2. Halaman Library
    Route::get('/library', [BookController::class, 'index'])->name('siswa.library');


    // 3. Halaman Detail Buku
    Route::get('/book/{id}', function ($id) {
        $book = Book::with(['reviews.user'])->findOrFail($id);

        $userId = Auth::user()->user_id;

        $currentlyBorrowedIds = \App\Models\Loan::where('user_id', $userId)
            ->where('status', 'borrowed')
            ->pluck('book_id')
            ->toArray();

        $wishlistBookIds = \App\Models\Wishlist::where('user_id', $userId)
            ->pluck('book_id')
            ->toArray();

        $books = \App\Models\Book::whereNotIn('id', $currentlyBorrowedIds)
            ->where('id', '!=', $id) // Menjamin buku yang sedang dilihat tidak muncul di rekomendasi
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('Siswa.BookDetail', compact('book', 'books', 'wishlistBookIds'));
    })->name('siswa.book.detail');


    Route::post('/book/{id}/review', [ReviewController::class, 'store'])->name('siswa.review.store');

    // 4. Halaman History
    Route::get('/history', [HistoryController::class, 'index'])->name('siswa.history');
    Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('siswa.history.destroy');

    // 5. Halaman Profile Settings
    Route::get('/profile-settings', [SiswaController::class, 'profile'])->name('siswa.profile');
    Route::put('/profile/update', [SiswaController::class, 'updateProfile'])->name('siswa.profile.update');
    Route::patch('/profile/update-photo', [SiswaController::class, 'updatePhoto'])->name('siswa.profile.updatePhoto');

    // 6. Halaman Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('siswa.wishlist');
    Route::post('/wishlist/toggle/{book}', [WishlistController::class, 'toggle'])->name('siswa.wishlist.toggle');

    // 7. Halaman Return/Pengembalian
    Route::get('/return', [ReturnController::class, 'index'])->name('siswa.return');
    

    // 8. Halaman Buku yang Sedang Dipinjam
    Route::get('/borrowed', [BorrowController::class, 'index'])->name('siswa.borrowed');
    
    // 9. Proses Simpan Peminjaman
    Route::post('/borrow/store/{book_id}', [BorrowController::class, 'store'])->name('siswa.borrow.store');

    // 10. Sistem Denda & Proses Pengembalian Profesional
    Route::get('/fines', [FineController::class, 'index'])->name('siswa.fines');
    Route::post('/return-process/{id}', [FineController::class, 'returnBook'])->name('siswa.return.process');

     // 11. Halaman Chatting
    Route::controller(\App\Http\Controllers\ChatController::class)->group(function () {
        Route::get('/chatting', 'index')->name('chat.index');
        
        Route::get('/chat/messages/{receiverId}', 'getMessages')->name('chat.messages');
        
        Route::post('/chat/send', 'sendMessage')->name('chat.send');
    });

}); 