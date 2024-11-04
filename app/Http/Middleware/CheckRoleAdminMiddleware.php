<?php

namespace App\Http\Middleware;

use App\Models\TaiKhoan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check() && Auth::user() instanceof TaiKhoan && Auth::user()->chuc_vu_id === TaiKhoan::role_admin) {
            return $next($request);
        }
        abort(403);
    }
}
