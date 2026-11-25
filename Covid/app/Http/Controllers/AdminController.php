<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (session('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_name']);
        return redirect('/admin/login')->with('success', 'Logged out successfully.');
    }

    public function dashboard()
    {
        $data = [
            'totalPatients' => Patient::count(),
            'totalHospitals' => Hospital::where('status', 'Approved')->count(),
            'pendingHospitals' => Hospital::where('status', 'Pending')->count(),
            'totalTests' => Appointment::where('service_type', 'Covid Test')->count(),
            'totalVaccinations' => Appointment::where('service_type', 'Vaccination')->count(),
            'todayTests' => Appointment::where('service_type', 'Covid Test')
                ->whereDate('created_at', today())->count(),
            'todayVaccinations' => Appointment::where('service_type', 'Vaccination')
                ->whereDate('created_at', today())->count(),
            'recentBookings' => Appointment::with(['patient', 'hospital'])
                ->orderBy('created_at', 'desc')->take(10)->get(),
            'adminName' => session('admin_name'),
        ];
        return view('admin.dashboard', $data);
    }

    public function hospitals()
    {
        $hospitals = Hospital::orderBy('created_at', 'desc')->get();
        return view('admin.hospitals', [
            'hospitals' => $hospitals,
            'adminName' => session('admin_name'),
        ]);
    }

    public function approveHospital($id)
    {
        Hospital::where('hospital_id', $id)->update(['status' => 'Approved']);
        return back()->with('success', 'Hospital approved successfully.');
    }

    public function rejectHospital($id)
    {
        Hospital::where('hospital_id', $id)->update(['status' => 'Rejected']);
        return back()->with('success', 'Hospital rejected.');
    }

    public function patients()
    {
        $patients = Patient::orderBy('created_at', 'desc')->get();
        return view('admin.patients', [
            'patients' => $patients,
            'adminName' => session('admin_name'),
        ]);
    }

    public function bookings()
    {
        $bookings = Appointment::with(['patient', 'hospital', 'vaccine'])
            ->orderBy('created_at', 'desc')->get();
        return view('admin.bookings', [
            'bookings' => $bookings,
            'adminName' => session('admin_name'),
        ]);
    }

    public function approveBooking($id)
{
    Appointment::where('appointment_id', $id)->update(['status' => 'Approved']);
    return back()->with('success', 'Booking approved successfully.');
}

public function rejectBooking($id)
{
    Appointment::where('appointment_id', $id)->update(['status' => 'Rejected']);
    return back()->with('success', 'Booking rejected.');
}
}