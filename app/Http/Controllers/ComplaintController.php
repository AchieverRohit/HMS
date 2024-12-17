<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Complaint;


class ComplaintController extends Controller
{
    public function searchList(Request $request)
    {
        $query = $request->get('query');
        $results = Complaint::where('ComplaintName', 'LIKE', "%{$query}%")->get();
        return response()->json($results);
    }


}