<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Patient;


class PrescriptionController extends Controller
{
    public function showProfile()
    {
        $Patients = Patient::all();
        return view('admin.prescription.list', [ 'patients' => $Patients ]);
    }
}