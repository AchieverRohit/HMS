<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Patient;
use App\Models\Doctor;


class PatientController extends Controller
{
    public function showList()
    {
        // auth()->user();
        $Patients = Patient::all();


        // Pass the admin data to the profile view
        return view('admin.patient.list', ['patients' => $Patients]);
        // return view('admin.patient.list');
    }

    public function createForm()
    {
        // dd("okay");
        // auth()->user();
        // $Patients = Patient::all();

        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();

        // Calculate the new PatientNo (PatientNo + 1)
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;

        return view('admin.patient.create', compact('PatientNo'));
        // return view('admin.patient.list');
    }

    public function store(Request $request)
    {
        // dd($request->FirstName);

        $patient = new Patient();

        // Assign values to the patient model
        $patient->FirstName = $request->FirstName;
        $patient->LastName = $request->LastName;
        $patient->Email = $request->Email;
        $patient->MobileNo = $request->MobileNo;
        $patient->Address = $request->Address;
        $patient->Dob = $request->Dob;
        $patient->Gender = $request->Gender;
        $patient->Age = $request->Age;
        $patient->BloodGroup = $request->BloodGroup;
        $patient->City = $request->City;
        $patient->Pin = $request->Pin;
        $patient->HospitalId = 1;
        $patient->PatientNo = $request->input('PatientNo');

        $doctors = Doctor::all();
        $services = Service::all();

        $patient->save();
        return redirect()->route('admin.appointment.add', compact('doctors', 'services'));
    }

    public function editForm($id)
    {
        $patient = Patient::where('Id', $id)->first();

        // dd($patient);
        return view('admin.patient.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {

        // Prepare the data to update
        $updateData = [
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->Email,
            'MobileNo' => $request->MobileNo,
            'Address' => $request->Address,
            'Dob' => $request->Dob,
            'Gender' => $request->Gender,
            'Age' => $request->Age,
            'BloodGroup' => $request->BloodGroup,
            'City' => $request->City,
            'Pin' => $request->Pin,
        ];

        // Assuming you have the patient ID
        $patient = Patient::where('Id', $id)->update($updateData);  // or Patient::findOrFail($request->id);

        // Redirect to the updated patient details page
        return redirect()->route('admin.patient')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        // $patient = Patient::findOrFail($id);
        // $patient->delete();
        $patient = Patient::where('Id', $id)->delete();

        return redirect()->route('admin.patient')->with('success', 'User deleted successfully.');
    }



}
