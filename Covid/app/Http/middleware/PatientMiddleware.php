<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PatientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('patient_id')) {
            return redirect('/patient/login')->with('error', 'Please login as Patient first.');
        }
        return $next($request);
    }
}