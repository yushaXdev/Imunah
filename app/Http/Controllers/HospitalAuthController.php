<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\Hash;

class HospitalAuthController extends Controller
{
    public function showRegister()
    {
        if (session('hospital_id')) {
            return redirect()->route('hospital.dashboard');
        }
        return view('hospital.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:hospitals,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Hospital::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'status' => 'Pending',
        ]);

        return redirect()->route('hospital.login')
            ->with('success', 'Registration successful! Please wait for admin approval.');
    }

    public function showLogin()
    {
        if (session('hospital_id')) {
            return redirect()->route('hospital.dashboard');
        }
        return view('hospital.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $hospital = Hospital::where('email', $request->email)->first();

        if ($hospital && Hash::check($request->password, $hospital->password)) {
            if ($hospital->status === 'Pending') {
                return back()->with('error', 'Your registration is still pending admin approval.');
            }
            if ($hospital->status === 'Rejected') {
                return back()->with('error', 'Your registration has been rejected by admin.');
            }

            session([
                'hospital_id' => $hospital->hospital_id,
                'hospital_name' => $hospital->name,
                'hospital_status' => $hospital->status,
            ]);
            return redirect()->route('hospital.dashboard')->with('success', 'Welcome, ' . $hospital->name . '!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        session()->forget(['hospital_id', 'hospital_name', 'hospital_status']);
        return redirect('/hospital/login')->with('success', 'Logged out successfully.');
    }
}