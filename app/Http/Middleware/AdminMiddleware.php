<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Admin::where('email', Auth::user()->email)->first();

        if ($admin && ($admin->role == 1 || $admin->role == 2)) { // Super Admin atau Admin Biasa
            return $next($request);
        }
        return redirect('/')->with('error', 'Anda tidak memiliki akses!');

    }
}
