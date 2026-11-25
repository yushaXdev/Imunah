<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Appointment, Hospital, Patient, TestResult, VaccinationStatus};

class PatientController extends Controller
{
    /**
     * Share the patient name with all views in this controller to avoid repetition.
     * Alternatively, use a View Composer in a ServiceProvider.
     */
    protected function getViewData(array $extra = []): array
    {
        return array_merge(['patientName' => session('patient_name')], $extra);
    }

    public function dashboard()
    {
        $patientId = session('patient_id');

        $upcoming = Appointment::with('hospital')
            ->where('patient_id', $patientId)
            ->whereIn('status', ['Pending', 'Approved'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        $completed = Appointment::with('hospital')
            ->where('patient_id', $patientId)
            ->where('status', 'Completed')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('patient.dashboard', $this->getViewData([
            'upcoming' => $upcoming,
            'completed' => $completed,
        ]));
    }

    public function search(Request $request)
    {
        $query = Hospital::where('status', 'Approved');

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $hospitals = $query->orderBy('name')->get();

        return view('patient.search', $this->getViewData([
            'hospitals' => $hospitals,
            'city' => $request->city,
            'name' => $request->name,
        ]));
    }

    public function appointments()
    {
        $patientId = session('patient_id');
        
        $appointments = Appointment::with(['hospital', 'vaccine'])
            ->where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.appointments', $this->getViewData([
            'appointments' => $appointments,
        ]));
    }

    public function results()
    {
        $patientId = session('patient_id');

        $testResults = TestResult::with('hospital')
            ->where('patient_id', $patientId)
            ->orderBy('date', 'desc')
            ->get();

        $vaccinations = VaccinationStatus::with(['hospital', 'vaccine'])
            ->where('patient_id', $patientId)
            ->orderBy('date', 'desc')
            ->get();

        return view('patient.results', $this->getViewData([
            'testResults' => $testResults,
            'vaccinations' => $vaccinations,
        ]));
    }

    public function profile()
    {
        // Using findOrFail ensures we get a 404 if the ID is invalid, rather than a null error
        $patient = Patient::findOrFail(session('patient_id'));

        return view('patient.profile', $this->getViewData([
            'patient' => $patient,
        ]));
    }

    public function updateProfile(Request $request)
    {
        $patientId = session('patient_id');

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
        ]);

        // Retrieve the model instance first for consistency
        $patient = Patient::findOrFail($patientId);
        
        $patient->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        // Update session name
        session(['patient_name' => $request->name]);

        return back()->with('success', 'Profile updated successfully.');
    }
}