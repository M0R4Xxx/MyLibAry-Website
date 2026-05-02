<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $rolePintu = $request->role_pintu; 

        $user = User::where('username', $username)
                    ->where('password', $password)
                    ->first();

        if ($user) {
            if ($rolePintu === 'admin' && $user->role === 'siswa') {
                return back()->with('error', 'Akses Ditolak! Siswa tidak boleh masuk ke Panel Admin.')->withInput();
            }

            Auth::login($user);
            
            session(['login_via' => $rolePintu]);

            $request->session()->regenerate();

            if ($rolePintu === 'siswa') {
                return redirect()->intended(route('siswa.dashboard'));
            } 
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with('error', 'Username atau Password salah!')->withInput();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:14|alpha_dash|unique:all_library_users,username',
            'email'    => [
                'required',
                'email',
                'unique:all_library_users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'
            ],
            'password' => 'required|min:6|max:14',
            'role'     => 'required|in:admin,siswa',
        ], [
            'username.required'   => 'Username tidak boleh kosong.',
            'username.min'        => 'Username minimal 4 huruf.',
            'username.max'        => 'Username maksimal 14 huruf.',
            'username.alpha_dash' => 'Username tidak boleh menggunakan spasi.',
            'username.unique'     => 'Username sudah digunakan orang lain.',
            'email.required'      => 'Email tidak boleh kosong.',
            'email.regex'         => 'Email harus menggunakan @gmail.com',
            'email.unique'        => 'Email sudah digunakan orang lain.',
            'password.required'   => 'Password tidak boleh kosong.',
            'password.min'        => 'Password minimal 6 huruf.',
            'password.max'        => 'Password maksimal 14 huruf.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all()); 
        }

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => $request->password, 
            'role'     => $request->role,
        ]);

        return redirect('/login')->with('success', 'Daftar berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }

    public function showRequestForm()
    {
        return view('Reset_Password_Request');
    }



    public function validateEmailRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:all_library_users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
            'email.required' => 'Masukkan email Anda terlebih dahulu.'
        ]);

        $user = User::where('email', $request->email)->first();

        session([
            'reset_email' => $request->email,
            'reset_username' => $user->username 
        ]);

        return redirect()->route('password.reset.form');
    }

    public function showResetForm()
    {
        if (!session()->has('reset_email') || !session()->has('reset_username')) {
            return redirect()->route('password.request')->with('error', 'Akses ilegal! Silakan validasi email Anda terlebih dahulu.');
        }
        
        return view('ResetPassword');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|max:14|confirmed', 
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password baru minimal 6 karakter.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::where('username', $request->username)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return back()->with('error', 'Data Username atau Email tidak ditemukan.')->withInput();
        }
        $user->update([
            'password' => $request->password
        ]);

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui! Silakan login.');
    }
}