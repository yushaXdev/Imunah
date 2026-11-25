<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HospitalMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('hospital_id')) {
            return redirect('/hospital/login')->with('error', 'Please login as Hospital first.');
        }
        if (session('hospital_status') !== 'Approved') {
            session()->flush();
            return redirect('/hospital/login')->with('error', 'Your hospital is not approved yet.');
        }
        return $next($request);
    }
}