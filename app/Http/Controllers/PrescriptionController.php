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
    public function showList(Request $request)
    {


        return view('admin.prescription.list');

    }

    public function createForm()
    {
        $roles = Role::all();
        return view('admin.staff.create', compact('roles'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Mobile' => 'required|digits:10',
        ]);

        $staff = new User();

        $staff->FirstName = $request->FirstName;
        $staff->LastName = $request->LastName;
        $staff->Email = $request->Email;
        $staff->Mobile = $request->Mobile;
        $staff->HospitalId = session('LoggedInfo')->HospitalId;
        $staff->Password = Hash::make('123456');
        ;
        $staff->IsActive = 1;
        $staff->IsDeleted = 0;
        $staff->RoleId = $request->RoleId;
        // $doctors = Doctor::all();
        // $services = Service::all();

        $staff->save();

        return redirect()->route('admin.staff')->with('success', 'staff updated successfully!');
    }

    public function editForm($id)
    {
        $staff = User::where('Id', $id)->first();
        $roles = Role::all();

        return view('admin.staff.edit', [
            'staff' => $staff,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Mobile' => 'required|digits:10',
        ]);
        $updateData = [
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->Email,
            'Mobile' => $request->Mobile,
            'RoleId' => $request->RoleId,
        ];

        $staff = User::where('Id', $id)->update($updateData);  // or staff::findOrFail($request->id);

        return redirect()->route('admin.staff')->with('success', 'staff updated successfully!');
    }

    public function destroy($id)
    {
        $staff = User::where('Id', $id)->delete();

        return redirect()->route('admin.staff')->with('success', 'User deleted successfully.');
    }

    // Method to handle the suggestions for diagnoses
    public function getDiagnosisSuggestions(Request $request)
    {
        $query = $request->input('query');
        $suggestions = Diagnosis::where('DiagnosisName', 'like', '%' . $query . '%')
            ->get(['DiagnosisName']);

        return response()->json($suggestions);
    }
}
