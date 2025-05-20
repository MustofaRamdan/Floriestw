<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role=null): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Jika user sudah login, cegah akses ke halaman login dan register
            if (in_array($request->route()->getName(), ['masuk', 'daftar'])) {
                return redirect()->route($user->role === 'admin' ? 'admin.home' : 'user.home');
            }

            // Jika user role tidak sesuai dengan yang diminta
            if ($role === 'user' && $user->role !== 'user') {
                abort(403, 'Unauthorized');
            }

            if ($role === 'admin' && $user->role !== 'admin') {
                abort(403, 'Unauthorized');
            }
        } else {
            // Cegah redirect ke /masuk jika sudah berada di sana
            if ($request->route()->getName() !== 'masuk') {
                return redirect()->route('masuk');
            }
        }

        return $next($request);
    }

}
