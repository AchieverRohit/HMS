<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;


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


    public function createForm()
    {
        $AppointmentNo = '21';
        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;
        return view('admin.appointment.create', compact('PatientNo','AppointmentNo'));
    }

    public function store(Request $request)
    {
        // dd("data");
        $request->validate([
            'FirstName' => 'required|max:255',
            'MobileNo' => 'required|digits:10',
            'Gender' => 'required',
            'Email' => 'nullable|email',
            // Add more validation rules as necessary
        ]);
    
        // Save the data to the database
        Appointment::create($request->all());
    
        return redirect()->route('admin.appointment')->with('success', 'Appointment added successfully.');
    }
    

    public function editForm($id)
    {
        $patient = Appointment::where('Id', $id)->first();

        // dd($patient);
        return view('admin.appointment.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {

        // // Prepare the data to update
        // $updateData = [
        //     'FirstName' => $request->FirstName,
        // ];

        // // Assuming you have the patient ID
        // $patient = Patient::where('Id', $id)->update($updateData);  // or Patient::findOrFail($request->id);
        // // dd($patient);
        // // if ($patient) {
        // //     $patient->update($updateData);
        // // }

        // // Redirect to the updated patient details page
        return redirect()->route('admin.appointment')->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id)
    {
        // $patient = Patient::findOrFail($id);
        // $patient->delete();
        $patient = Appointment::where('Id', $id)->delete();

        return redirect()->route('admin.appointment')->with('success', 'Appointment deleted successfully.');
    }



}
