<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman/form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Memproses percobaan login.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Ambil kredensial (username, bukan email)
        $credentials = $request->only('username', 'password');

        // 3. Coba lakukan autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // 4. Cek apakah user aktif (sesuai tabel Anda)
            if (Auth::user()->is_active == 0) {
                Auth::logout(); // Logout paksa jika tidak aktif
                return back()->withErrors([
                    'username' => 'Akun Anda tidak aktif. Silakan hubungi Admin.',
                ])->onlyInput('username');
            }

            // 5. Sukses! Regenerate session & redirect
            $request->session()->regenerate();

            // Redirect ke /dashboard, nanti rute /dashboard yg akan atur ke role masing-masing
            return redirect()->intended('/dashboard');
        }

        // 6. Gagal login
        throw ValidationException::withMessages([
            'username' => 'Username atau password salah.',
        ]);
    }

    /**
     * Memproses logout.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirect ke halaman utama
    }
}
