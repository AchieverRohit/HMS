<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Diagnosis;


class DiagnosisController extends Controller
{
    public function showList(Request $request)
    {
        $query = Diagnosis::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->orWhere("DiagnosisName", "LIKE", "%" . $search . "%");
                // ->orWhere("Description", "LIKE", "%" . $search . "%");
        }

        $diagnosis = $query->paginate(10);

        $diagnosis->appends(['search' => $request->search]);

        return view('admin.diagnosis.list', [
            'diagnosis' => $diagnosis,
            'search' => $request->search,
        ]);
    }

    
    public function createForm()
    {

        return view('admin.diagnosis.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'DiagnosisName' => 'required|string|max:255',
        ]);

        $Diagnosis = new Diagnosis();

        $Diagnosis->DiagnosisName = $request->DiagnosisName;
        $Diagnosis->Duration = $request->Duration;

        $Diagnosis->save();

        return redirect()->route('admin.diagnosis')->with('success', 'Role updated successfully!');
    }

    public function editForm($id)
    {
        $diagnosis = Diagnosis::where('Id', $id)->first();

        return view('admin.diagnosis.edit', compact('diagnosis'));
    }

    public function update(Request $request, $id)
    {
        // dd("DDD");
        $request->validate([
            'DiagnosisName' => 'required|string|max:255',
        ]);
        $updateData = [
            'DiagnosisName' => $request->DiagnosisName,
            'Duration' => $request->Duration,
        ];

        $diagnosis = Diagnosis::where('Id', $id)->update($updateData);  // or Patient::findOrFail($request->id);

        return redirect()->route('admin.diagnosis')->with('success', 'Diagnosis updated successfully!');
    }

    public function destroy($id)
    {   
        $diagnosis = Diagnosis::where('Id', $id)->delete();
    
        if ($diagnosis) {
            return redirect()->route('admin.diagnosis')->with('success', 'Diagnosis deleted successfully.');
        }
    
        return redirect()->route('admin.diagnosis')->with('error', 'Failed to delete the role.');

    }

}