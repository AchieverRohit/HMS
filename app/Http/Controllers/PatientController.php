<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Patient;


class PatientController extends Controller
{
    public function showProfile()
    {
        // auth()->user();
        $Patients = Patient::all();

        // Pass the admin data to the profile view
        return view('admin.patient.list', [ 'patients' => $Patients ]);
        // return view('admin.patient.list');
    }

    public function createForm()
    {
        // dd("okay");
        // auth()->user();
        // $Patients = Patient::all();

        // Pass the admin data to the profile view
        return view('admin.patient.create');
        // return view('admin.patient.list');
    }

    public function store(Request $request)
    {


        // dd($request->FirstName);

        $addData = [
            "FirstName" => $request->FirstName,
            "MobileNo" => '838383838',
            "HospitalId" => 1,
        ];

        Patient::create($addData);
        return redirect()->route('admin.patient');
    }
    

    
}