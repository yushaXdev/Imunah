<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\TestResult;
use App\Models\VaccinationStatus;
use App\Models\Hospital;
use App\Models\Vaccine;

class ReportController extends Controller
{
    public function index()
    {
        $totalTests = Appointment::where('service_type', 'Covid Test')->count();
        $totalVaccinations = Appointment::where('service_type', 'Vaccination')->count();
        $positiveCases = TestResult::where('result', 'Positive')->count();
        $negativeCases = TestResult::where('result', 'Negative')->count();

        $todayTests = Appointment::where('service_type', 'Covid Test')
            ->whereDate('created_at', today())->count();
        $weekTests = Appointment::where('service_type', 'Covid Test')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthTests = Appointment::where('service_type', 'Covid Test')
            ->whereMonth('created_at', now()->month)->count();

        $todayVaccinations = Appointment::where('service_type', 'Vaccination')
            ->whereDate('created_at', today())->count();
        $weekVaccinations = Appointment::where('service_type', 'Vaccination')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthVaccinations = Appointment::where('service_type', 'Vaccination')
            ->whereMonth('created_at', now()->month)->count();

        $hospitalWise = Hospital::where('status', 'Approved')
            ->withCount(['appointments'])
            ->orderByDesc('appointments_count')
            ->get();

        $vaccineWise = Vaccine::withCount(['appointments'])
            ->orderByDesc('appointments_count')
            ->get();

        $dailyTests = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = Appointment::where('service_type', 'Covid Test')
                ->whereDate('created_at', $date)->count();
            $dailyTests[] = [
                'date' => now()->subDays($i)->format('M d'),
                'count' => $count,
            ];
        }

        $dailyVaccinations = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = Appointment::where('service_type', 'Vaccination')
                ->whereDate('created_at', $date)->count();
            $dailyVaccinations[] = [
                'date' => now()->subDays($i)->format('M d'),
                'count' => $count,
            ];
        }

        return view('admin.reports', [
            'adminName' => session('admin_name'),
            'totalTests' => $totalTests,
            'totalVaccinations' => $totalVaccinations,
            'positiveCases' => $positiveCases,
            'negativeCases' => $negativeCases,
            'todayTests' => $todayTests,
            'weekTests' => $weekTests,
            'monthTests' => $monthTests,
            'todayVaccinations' => $todayVaccinations,
            'weekVaccinations' => $weekVaccinations,
            'monthVaccinations' => $monthVaccinations,
            'hospitalWise' => $hospitalWise,
            'vaccineWise' => $vaccineWise,
            'dailyTests' => $dailyTests,
            'dailyVaccinations' => $dailyVaccinations,
        ]);
    }

    public function export($type)
    {
        $filename = $type . '_report_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($type) {
            $file = fopen('php://output', 'w');

            if ($type === 'tests') {
                fputcsv($file, ['ID', 'Patient', 'Hospital', 'Date', 'Result', 'Remarks']);
                $results = TestResult::with(['patient', 'hospital'])->get();
                foreach ($results as $r) {
                    fputcsv($file, [
                        $r->result_id,
                        $r->patient->name ?? 'N/A',
                        $r->hospital->name ?? 'N/A',
                        $r->date,
                        $r->result,
                        $r->remarks,
                    ]);
                }
            } else {
                fputcsv($file, ['ID', 'Patient', 'Hospital', 'Vaccine', 'Dose', 'Date', 'Status']);
                $records = VaccinationStatus::with(['patient', 'hospital', 'vaccine'])->get();
                foreach ($records as $r) {
                    fputcsv($file, [
                        $r->id,
                        $r->patient->name ?? 'N/A',
                        $r->hospital->name ?? 'N/A',
                        $r->vaccine->vaccine_name ?? 'N/A',
                        $r->dose,
                        $r->date,
                        $r->status,
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}