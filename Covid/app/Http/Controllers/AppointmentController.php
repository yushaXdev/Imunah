<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Vaccine;

class AppointmentController extends Controller
{
    public function showBookForm($hospitalId)
    {
        $hospital = Hospital::where('hospital_id', $hospitalId)
            ->where('status', 'Approved')
            ->firstOrFail();

        $vaccines = Vaccine::where('status', 'Available')->get();

        return view('patient.book', [
            'hospital' => $hospital,
            'vaccines' => $vaccines,
            'patientName' => session('patient_name'),
        ]);
    }

    public function store(Request $request, $hospitalId)
{
    $request->validate([
        'service_type' => 'required|in:Covid Test,Vaccination',
        'appointment_date' => 'required|date|after_or_equal:today',
        'vaccine_id' => 'nullable|exists:vaccines,vaccine_id',
    ]);

    if ($request->service_type === 'Vaccination' && !$request->vaccine_id) {
        return back()->withErrors(['vaccine_id' => 'Please select a vaccine.'])->withInput();
    }

    Appointment::create([
        'patient_id' => session('patient_id'),
        'hospital_id' => $hospitalId,
        'service_type' => $request->service_type,
        'appointment_date' => $request->appointment_date,
        'vaccine_id' => $request->service_type === 'Vaccination' ? $request->vaccine_id : null,
        'status' => 'Pending',
    ]);

    return redirect()->route('patient.appointments')
        ->with('success', 'Appointment booked successfully! Waiting for hospital approval.');
}
}