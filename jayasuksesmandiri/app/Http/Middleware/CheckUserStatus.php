<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user -> status == 0) {
            return redirect()->route('login')->with('error-message', 'Akun anda butuh diverifikasikan. Silahkan laporkan kepada Eddy Tjhai - 085267733700 untuk melakukan verifikasi akun');
        } else {
            return $next($request);
        }
    }
}
