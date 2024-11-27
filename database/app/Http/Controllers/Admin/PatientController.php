<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }


    public function create()
    {
        return view('patients.create');
    }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'age' => 'required|integer',
    //         'gender' => 'required|string',
    //         'address' => 'nullable|string',
    //     ]);

    //     $patient = Patient::create($validatedData);
    //     return response()->json(['message' => 'Patient created successfully!', 'patient' => $patient]);
    // }


    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }


    // public function edit($id)
    // {
    //     $patient = Patient::findOrFail($id);
    //     return view('patients.edit', compact('patient')); // Optional for API
    // }


    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'age' => 'required|integer',
    //         'gender' => 'required|string',
    //         'address' => 'nullable|string',
    //     ]);

    //     $patient = Patient::findOrFail($id);
    //     $patient->update($validatedData);

    //     return response()->json(['message' => 'Patient updated successfully!', 'patient' => $patient]);
    // }


    // public function destroy($id)
    // {
    //     $patient = Patient::findOrFail($id);
    //     $patient->delete();

    //     return response()->json(['message' => 'Patient deleted successfully!']);
    // }
}
