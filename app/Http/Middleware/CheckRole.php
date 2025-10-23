<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- 1. JANGAN LUPA TAMBAHKAN INI

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles   // <-- 2. Tambahkan parameter ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 3. Ini adalah Logika Inti-nya
        // Cek apakah user sudah login DAN perannya ada di dalam daftar $roles
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {

            // Jika tidak diizinkan, tendang ke halaman utama
            return redirect('/');
        }

        // Jika diizinkan, lanjutkan request
        return $next($request);
    }
}
