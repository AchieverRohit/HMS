<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;


class RoleController extends Controller
{
    public function showList(Request $request)
    {
        $query = Role::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->orWhere("RoleName", "LIKE", "%" . $search . "%")
                ->orWhere("Description", "LIKE", "%" . $search . "%");
        }

        $roles = $query->paginate(10);

        $roles->appends(['search' => $request->search]);

        return view('admin.roles.list', [
            'roles' => $roles,
            'search' => $request->search,
        ]);
    }

    
    public function createForm()
    {

        return view('admin.roles.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'RoleName' => 'required|string|max:255',
        ]);

        $role = new role();

        $role->RoleName = $request->RoleName;
        $role->Description = $request->Description;

        $role->save();

        return redirect()->route('admin.role')->with('success', 'Role updated successfully!');
    }

    public function editForm($id)
    {
        $role = Role::where('Id', $id)->first();

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'RoleName' => 'required|string|max:255',
        ]);
        $updateData = [
            'RoleName' => $request->RoleName,
            'Description' => $request->Description,
        ];

        $role = Role::where('Id', $id)->update($updateData);  // or Patient::findOrFail($request->id);

        return redirect()->route('admin.role')->with('success', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        if (in_array($id, [1, 2, 3])) {
            return redirect()->route('admin.role')->with('error', 'This role cannot be deleted.');
        }
    
        $role = Role::where('Id', $id)->delete();
    
        if ($role) {
            return redirect()->route('admin.role')->with('success', 'Role deleted successfully.');
        }
    
        return redirect()->route('admin.role')->with('error', 'Failed to delete the role.');

    }

}