<?php 

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Hospital;
use App\Models\Doctor;


class HospitalController extends Controller
{
    // public function showList()
    // {
    //     $patients = Hospital::paginate(10);
    //     return view('admin.patient.list', ['patients' => $patients]);
    // }
    public function showList(Request $request)
    {
        $query = Hospital::query();
    
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereRaw("CONCAT(FirstName, ' ', LastName) LIKE ?", ["%$search%"]);
        }
    
        $hospitals = $query->paginate(10);
    
        $hospitals->appends(['search' => $request->search]);
    
        return view('admin.hospital.list', [
            'hospitals' => $hospitals,
            'search' => $request->search,
        ]);
    }
    // hospital

    public function createForm()
    {
        dd("data");
        // $lastPatient = Hospital::orderBy('PatientNo', 'desc')->first();

        // Calculate the new PatientNo (PatientNo + 1)
        // $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;

        return view('admin.hospital.create', compact('PatientNo'));

    }

    public function store(Request $request)
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

        return redirect()->route('admin.patient')->with('success', 'Patient updated successfully!');
    }

    public function editForm($id)
    {
        $patient = Hospital::where('Id', $id)->first();

        return view('admin.patient.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'MobileNo' => 'required|digits:10',
        ]);
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

        $patient = Hospital::where('Id', $id)->update($updateData);  // or Hospital::findOrFail($request->id);

        return redirect()->route('admin.patient')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Hospital::where('Id', $id)->delete();

        return redirect()->route('admin.patient')->with('success', 'User deleted successfully.');
    }



}
