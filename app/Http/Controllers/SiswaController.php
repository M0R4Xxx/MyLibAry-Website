<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    /**
     * Menampilkan halaman profile siswa
     */
    public function profile()
    {
        return view('Siswa.Profile');
    }

    /**
     * Memperbarui data profil (Username, Password, & Foto Profil)
     */
    public function updateProfile(Request $request)
    {
        $siswa = Auth::user();

        $request->validate([
            'username' => [
                'required', 
                'min:4', 
                'alpha_dash', 
                Rule::unique('all_library_users', 'username')->ignore($siswa->user_id, 'user_id'),
            ],
            'password' => [
                'nullable',
                'min:6',
                'confirmed',
                'regex:/^\S*$/',
            ],
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:512000',
        ], [
            'username.required' => 'Username tidak boleh dikosongkan.',
            'username.min' => 'Username terlalu pendek (Minimal 4 karakter).',
            'username.alpha_dash' => 'Username tidak boleh mengandung spasi.',
            'username.unique' => 'Username sudah digunakan oleh orang lain.',
            
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password tidak boleh mengandung spasi.',
            
            'foto_profile.image' => 'File harus berupa gambar.',
            'foto_profile.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'foto_profile.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $siswa->username = $request->username;

        if ($request->filled('password')) {
            $siswa->password = $request->password;
        }

        if ($request->hasFile('foto_profile')) {
            if ($siswa->foto_profile && Storage::disk('public')->exists($siswa->foto_profile)) {
                Storage::disk('public')->delete($siswa->foto_profile);
            }

            $path = $request->file('foto_profile')->store('profile_photos', 'public');
            $siswa->foto_profile = $path;
        }

        $siswa->save();

        return back()->with('success', 'Profile has been updated successfully!');
    }

    /**
     * Fungsi updatePhoto lama (Hapus jika tidak digunakan)
     */
    public function updatePhoto(Request $request)
    {
        // Logika dipindah ke updateProfile untuk efisiensi satu tombol save
    }
}