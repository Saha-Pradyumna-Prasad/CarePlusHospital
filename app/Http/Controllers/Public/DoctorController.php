<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::where('status', true);
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('specialty', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('specialty') && $request->specialty) {
            $query->where('specialty', $request->specialty);
        }
        
        $doctors = $query->paginate(10);
        $specialties = Doctor::distinct()->pluck('specialty');
        
        return view('public.doctors', compact('doctors', 'specialties'));
    }
    
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('public.doctors-show', compact('doctor'));
    }
}