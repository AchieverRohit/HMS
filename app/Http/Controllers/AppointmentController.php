<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Service;
use App\Models\AppointmentStatus;


class AppointmentController extends Controller
{
    public function showList(Request $request)
    {
        $hospitalId = session('LoggedInfo')->HospitalId;

        // Get the filter date from the request
        $filterDate = $request->input('filter_date');

        // Fetch appointments filtered by date if filter_date is provided
        $appointmentsQuery = Appointment::with(['doctor', 'patient', 'service'])
            ->where('HospitalId', $hospitalId);

        if ($filterDate) {
            $appointmentsQuery->whereDate('DateTime', $filterDate); // Filter by date
        }

        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;

        $appointments = $appointmentsQuery->get();

        return view('admin.appointment.list', compact('appointments','PatientNo'));
    }


    public function createForm($id)
    {
        // dd("Create New Appointment.",$id);
        $hospitalId = session('LoggedInfo')->HospitalId;
        $patient = Patient::where('Id', $id)->first();
        $doctors = User::query()->select('Id', 'FirstName', 'LastName')
            ->where('HospitalId', $hospitalId)
            ->where('RoleId', 3)
            ->get();
        $service = Service::all();
        $status = AppointmentStatus::all();
        // dd($patient, $doctors, $service, $status);

        return view('admin.appointment.create', compact('patient','status','doctors','service'));

        // $AppointmentNo = '21';
        // $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        // $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;
        // return view('admin.appointment.create', compact('PatientNo','AppointmentNo'));
    }

    public function store(Request $request, $id)
    {
        dd($request->all());
        // dd("data");
        // $request->validate([
        //     'FirstName' => 'required|max:255',
        //     'MobileNo' => 'required|digits:10',
        //     'Gender' => 'required',
        //     'Email' => 'nullable|email',
        //     // Add more validation rules as necessary
        // ]);
    
        // // Save the data to the database
        // Appointment::create($request->all());
    
        // return redirect()->route('admin.appointment')->with('success', 'Appointment added successfully.');
    }
    
    public function createPatientForm(){
        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;
        return view('admin.appointment.create-patient', compact('PatientNo'));
    }

    public function storePatientForm(Request $request)
    {

        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'MobileNo' => 'required|digits:10',
        ]);

        $patient = new Patient();

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
        $patient->HospitalId = session('LoggedInfo')->HospitalId;
        $patient->PatientNo = $request->input('PatientNo');

        // $doctors = Doctor::all();
        // $services = Service::all();

        $patient->save();
        $insertedId = $patient->id;

        return redirect()->route('admin.appointment.add', ['id' => $insertedId])->with('success', 'Patient updated successfully!');

        // return redirect()->route('admin.patient')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        // $patient = Patient::findOrFail($id);
        // $patient->delete();
        $patient = Appointment::where('Id', $id)->delete();

        return redirect()->route('admin.appointment')->with('success', 'Appointment deleted successfully.');
    }



}
