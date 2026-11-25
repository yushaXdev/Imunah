<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Appointment, Hospital, TestResult, VaccinationStatus, Vaccine};

class HospitalController extends Controller
{
    public function dashboard()
    {
        $hospitalId = session('hospital_id');
        $pending = Appointment::where('hospital_id', $hospitalId)->where('status', 'Pending')->count();
        $approved = Appointment::where('hospital_id', $hospitalId)->where('status', 'Approved')->count();
        $completed = Appointment::where('hospital_id', $hospitalId)->where('status', 'Completed')->count();
        $todayAppointments = Appointment::where('hospital_id', $hospitalId)
            ->whereDate('appointment_date', today())->count();

        return view('hospital.dashboard', [
            'hospitalName' => session('hospital_name'),
            'pending' => $pending,
            'approved' => $approved,
            'completed' => $completed,
            'todayAppointments' => $todayAppointments,
        ]);
    }

    public function requests()
    {
        $hospitalId = session('hospital_id');
        $appointments = Appointment::with(['patient', 'vaccine'])
            ->where('hospital_id', $hospitalId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('hospital.requests', [
            'appointments' => $appointments,
            'hospitalName' => session('hospital_name'),
        ]);
    }

    public function approveRequest($id)
    {
        $request = request();
        $request->validate([
            'appointment_time' => 'required|date_format:H:i',
        ]);

        Appointment::where('appointment_id', $id)->update([
            'status' => 'Approved',
            'appointment_time' => $request->appointment_time,
        ]);

        return back()->with('success', 'Appointment approved successfully.');
    }

    public function rejectRequest($id)
    {
        Appointment::where('appointment_id', $id)->update(['status' => 'Rejected']);
        return back()->with('success', 'Appointment rejected.');
    }

    public function showTestResult($id)
    {
        $appointment = Appointment::with(['patient'])->where('appointment_id', $id)->first();
        return view('hospital.update-test-result', [
            'appointment' => $appointment,
            'hospitalName' => session('hospital_name'),
        ]);
    }

    public function updateTestResult(Request $request, $id)
    {
        $request->validate([
            'result' => 'required|in:Positive,Negative',
            'remarks' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $appointment = Appointment::find($id);

        TestResult::updateOrCreate(
            ['appointment_id' => $id],
            [
                'patient_id' => $appointment->patient_id,
                'hospital_id' => $appointment->hospital_id,
                'result' => $request->result,
                'remarks' => $request->remarks,
                'date' => $request->date,
            ]
        );

        Appointment::where('appointment_id', $id)->update(['status' => 'Completed']);

        return redirect()->route('hospital.requests')
            ->with('success', 'Test result updated successfully.');
    }

    public function showVaccination($id)
    {
        $appointment = Appointment::with(['patient'])->where('appointment_id', $id)->first();
        $vaccines = Vaccine::where('status', 'Available')->get();
        return view('hospital.update-vaccination', [
            'appointment' => $appointment,
            'vaccines' => $vaccines,
            'hospitalName' => session('hospital_name'),
        ]);
    }

//     public function showLogin()
// {
//     // Agar hospital already login hai toh login page ki jagah Register page par bhej do
//     if (session('hospital_id')) {
//         return redirect()->route('hospital.register');
//     }

//     // Agar login nahi hai toh Login page dikhao
//     return view('hospital.login');
// }

    public function updateVaccination(Request $request, $id)
    {
        $request->validate([
            'vaccine_id' => 'required|exists:vaccines,vaccine_id',
            'dose' => 'required|in:1st Dose,2nd Dose,Booster Dose',
            'date' => 'required|date',
            'status' => 'required|in:Vaccinated,Scheduled',
        ]);

        $appointment = Appointment::find($id);

        VaccinationStatus::updateOrCreate(
            ['appointment_id' => $id],
            [
                'patient_id' => $appointment->patient_id,
                'hospital_id' => $appointment->hospital_id,
                'vaccine_id' => $request->vaccine_id,
                'dose' => $request->dose,
                'date' => $request->date,
                'status' => $request->status,
            ]
        );

        Appointment::where('appointment_id', $id)->update(['status' => 'Completed']);

        return redirect()->route('hospital.requests')
            ->with('success', 'Vaccination status updated successfully.');
    }
}