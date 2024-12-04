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
            $query->where("Name", "Like", "%" . $search . "%");
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
        // $lastPatient = Hospital::orderBy('PatientNo', 'desc')->first();

        // Calculate the new PatientNo (PatientNo + 1)
        // $PatientNo = $lastPatient ? $lastPatient->PatientNo + 1 : 1;

        return view('admin.hospital.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'Name' => 'required|string|max:255',
        ]);

        $address = new Hospital();

        $address->Name = $request->Name;
        $address->Address = $request->Address;
        if ($request->IsActive) {
            $address->IsActive = $request->IsActive;
        } else {
            $address->IsActive = 0;

        }

        $address->save();

        return redirect()->route('admin.hospital')->with('success', 'Hospital updated successfully!');
    }

    public function editForm($id)
    {
        $hospital = Hospital::where('Id', $id)->first();


        return view('admin.hospital.edit', compact('hospital'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
        ]);

        if ($request->IsActive) {
            $updateData = [
                'Name' => $request->Name,
                'Address' => $request->Address,
                'IsActive' => $request->IsActive,
            ];
        } else {
            $updateData = [
                'Name' => $request->Name,
                'Address' => $request->Address,
                'IsActive' => 0,
            ];
        }


        $patient = Hospital::where('Id', $id)->update($updateData);  // or Hospital::findOrFail($request->id);

        return redirect()->route('admin.hospital')->with('success', 'Hospital updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Hospital::where('Id', $id)->delete();

        return redirect()->route('admin.hospital')->with('success', 'Hospital deleted successfully.');
    }



}
