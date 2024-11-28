<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\User;


class PatientController extends Controller
{
    public function showProfile()
    {
        // auth()->user();
        $users = User::all(); // You might want to paginate or filter users

        // Pass the admin data to the profile view
        return view('admin.patient.list', [ 'users' => $users ]);
        // return view('admin.patient.list');
    }
}