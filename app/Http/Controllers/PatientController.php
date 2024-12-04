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
    // public function showList()
    // {
    //     $patients = Patient::paginate(10);
    //     return view('admin.patient.list', ['patients' => $patients]);
    // }
    public function showList(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereRaw("CONCAT(FirstName, ' ', LastName) LIKE ?", ["%$search%"])
                ->orWhere("Email", "LIKE", "%" . $search . "%")
                ->orWhere("MobileNo", "LIKE", "%" . $search . "%")
                ->orWhere("PatientNo", "LIKE", "%" . $search . "%");
        }

        $patients = $query->paginate(10);

        $patients->appends(['search' => $request->search]);

        return view('admin.patient.list', [
            'patients' => $patients,
            'search' => $request->search,
        ]);
    }


    public function createForm()
    {

        $lastPatient = Patient::orderBy('PatientNo', 'desc')->first();

        // Calculate the new PatientNo (PatientNo + 1)
        $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;

        return view('admin.patient.create', compact('PatientNo'));

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
        $patient = Patient::where('Id', $id)->first();

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

        $patient = Patient::where('Id', $id)->update($updateData);  // or Patient::findOrFail($request->id);

        return redirect()->route('admin.patient')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Patient::where('Id', $id)->delete();

        return redirect()->route('admin.patient')->with('success', 'User deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('HospitalId', session('LoggedInfo')->HospitalId) // Filter by HospitalId
                ->where(function ($q) use ($search) {
                    $q->where('PatientNo', 'LIKE', "%$search%")
                        ->orWhere('FirstName', 'LIKE', "%$search%")
                        ->orWhere('LastName', 'LIKE', "%$search%")
                        ->orWhere('MobileNo', 'LIKE', "%$search%");
                });
        }

        $patients = $query->paginate(10); // Adjust pagination as needed

        return view('admin.patient.list', [
            'patients' => $patients,
            'search' => $request->search,
        ]);
    }


}
