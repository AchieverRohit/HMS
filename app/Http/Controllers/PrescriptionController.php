<?php

namespace App\Http\Controllers;
use App\Models\PrescriptionComplaints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Diagnosis;
use App\Models\User;
use App\Models\Prescription;
use App\Models\Test;
use App\Models\Appointment;
use App\Models\Complaint;
use App\Models\Medicine;






class PrescriptionController extends Controller
{
    public function showList(Request $request)
    {


        return view('admin.prescription.list');

    }

    public function createForm($id)
    {
        // Your logic to handle the appointment id
        $complaints = Complaint::all();
        return view('admin.prescription.create', compact('id','complaints'));
    }


    public function store(Request $request, $id)
    {

        dd($request->all());
        $appointment = Appointment::with(['patient', 'doctor', 'service', 'status'])->where('Id', $id)->first();
        try {
            // Start a database transaction
            \DB::beginTransaction();

            // Create the Prescription record
            $prescription = Prescription::create([
                'AppointmentId' => $id,
                'PatientId' => $appointment->PatientId,
                'DoctorId' => $appointment->DoctorId,
                'NextVisitDate' => $request->NextVisitDate
            ]);
            dd($request->has('complaintName'));
            // Save Complaints
            if ($request->has('complaintName')) {
                foreach ($request->complaintName as $index => $name) {
                    if (!empty($name)) {
                        // Create the Complaint record
                        $complaint = Complaint::create([
                            'ComplaintName' => $name,
                            'Frequency' => $request->frequency[$index] ?? null,
                            'Severity' => $request->severity[$index] ?? null,
                            'Duration' => $request->duration[$index] ?? null,
                            'Date' => $request->date[$index] ?? null,
                            'Note' => $request->note[$index] ?? null,
                        ]);

                        // Associate the complaint with the prescription (using the bridge table)
                        $prescription->complaints()->attach($complaint->Id);
                    }
                }
            }

            // Save Diagnosis
            if ($request->has('diagnosisName')) {
                foreach ($request->diagnosisName as $index => $name) {
                    if (!empty($name)) {
                        $dignosis = Diagnosis::create([
                            'Diagnosis' => $name,
                            'Duration' => $request->duration[$index] ?? null,
                            'Date' => $request->date[$index] ?? null,
                        ]);

                        $prescription->diagnoses()->attach($dignosis->Id);
                    }
                }
            }

            // Save Tests
            if ($request->has('testName')) {
                foreach ($request->testName as $index => $name) {
                    if (!empty($name)) {
                        $test = Test::create([
                            'TestName' => $name,
                            'Cost' => $request->cost[$index] ?? null,
                            'Description' => $request->description[$index] ?? null,
                        ]);
                        $prescription->tests()->attach($test->Id);
                    }
                }
            }

            // Save Medicines
            if ($request->has('medicineName')) {
                foreach ($request->medicineName as $index => $name) {
                    if (!empty($name)) {
                        $medicine = Medicine::create([
                            'MedicineName' => $name,
                            'Dose' => $request->dose[$index] ?? null,
                            'Frequency' => $request->frequency[$index] ?? null,
                            'WhenToTake' => $request->whenToTake[$index] ?? null,
                            'Duration' => $request->duration[$index] ?? null,
                            'Instruction' => $request->instruction[$index] ?? null,
                        ]);
                        $prescription->medicines()->attach($medicine->Id);
                    }
                }
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('admin.prescription.list')->with('success', 'Prescription saved successfully.');
        } catch (\Exception $e) {
            // Rollback transaction if error occurs
            \DB::rollback();
            dd('' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save prescription.');
        }

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
