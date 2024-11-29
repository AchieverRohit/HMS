<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function showList()
    {
        $Appointments = Appointment::all();

        return view('admin.appointment.list', ['appointments' => $Appointments]);

    }

    public function createForm()
    {
        return view('admin.appointment.create');
    }

    public function store(Request $request)
    {
        // dd($request->FirstName);

        $appointment = new Appointment();

        // Assign values to the patient model
        // $patient->FirstName = $request->FirstName;
        // $patient->LastName = $request->LastName;
        // $patient->Email = $request->Email;
        // $patient->MobileNo = $request->MobileNo;
        // $patient->Address = $request->Address;
        // $patient->Dob = $request->Dob;
        // $patient->Gender = $request->Gender;
        // $patient->Age = $request->Age;
        // $patient->BloodGroup = $request->BloodGroup;
        // $patient->City = $request->City;
        // $patient->Pin = $request->Pin;
        // $patient->HospitalId = 1;


        // $patient->save();
        return redirect()->route('admin.appointment');
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
