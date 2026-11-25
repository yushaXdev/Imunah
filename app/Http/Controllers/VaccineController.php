<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;

class VaccineController extends Controller
{
    public function index()
    {
        $vaccines = Vaccine::orderBy('vaccine_id', 'desc')->get();
        return view('admin.vaccines', [
            'vaccines' => $vaccines,
            'adminName' => session('admin_name'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vaccine_name' => 'required|string|unique:vaccines,vaccine_name',
        ]);

        Vaccine::create([
            'vaccine_name' => $request->vaccine_name,
            'status' => 'Available',
        ]);

        return back()->with('success', 'Vaccine added successfully.');
    }

    public function toggle($id)
    {
        $vaccine = Vaccine::find($id);
        if ($vaccine) {
            $vaccine->status = $vaccine->status === 'Available' ? 'Unavailable' : 'Available';
            $vaccine->save();
            return back()->with('success', 'Vaccine status updated.');
        }
        return back()->with('error', 'Vaccine not found.');
    }
}