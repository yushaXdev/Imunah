<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_id')) {
            return redirect('/admin/login')->with('error', 'Please login as Admin first.');
        }
        return $next($request);
    }
}