<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientAuthController extends Controller
{
    public function showRegister()
    {
        if (session('patient_id')) {
            return redirect()->route('patient.dashboard');
        }
        return view('patient.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patient.login')
            ->with('success', 'Registration successful! Please login.');
    }

    public function showLogin()
    {
        if (session('patient_id')) {
            return redirect()->route('patient.dashboard');
        }
        return view('patient.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if ($patient && Hash::check($request->password, $patient->password)) {
            session([
                'patient_id' => $patient->patient_id,
                'patient_name' => $patient->name,
            ]);
            return redirect()->route('patient.dashboard')->with('success', 'Welcome, ' . $patient->name . '!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
{
    session()->forget(['patient_id', 'patient_name']);
    return redirect('/')->with('success', 'Logged out successfully.');
}
}