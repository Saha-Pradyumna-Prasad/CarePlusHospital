<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::where('status', true);
        
        if ($request->has('role') && $request->role) {
            $query->where('role_type', $request->role);
        }
        
        $staff = $query->paginate(10);
        $roles = Staff::distinct()->pluck('role_type');
        
        return view('public.staff', compact('staff', 'roles'));
    }
}