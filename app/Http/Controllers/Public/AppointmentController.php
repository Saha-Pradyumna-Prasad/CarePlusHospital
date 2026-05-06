<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function create()
    {
        $doctors = Doctor::where('status', true)->get();
        return view('public.appointment', compact('doctors'));
    }
    
    public function getPA($doctorId)
    {
        $pa = PA::where('doctor_id', $doctorId)->where('status', true)->first();
        if ($pa) {
            return response()->json([
                'success' => true,
                'pa_name' => $pa->name,
                'pa_phone' => $pa->phone,
                'pa_email' => $pa->email
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No PA assigned yet']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'required|integer|min:0|max:150',
            'reason' => 'required|string',
            'appointment_time' => 'required|date|after:now',
            'patient_phone' => 'required|string|max:20',
        ]);
        
        $pa = PA::where('doctor_id', $request->doctor_id)->where('status', true)->first();
        
        if (!$pa) {
            return redirect()->back()->with('error', 'No PA assigned to this doctor. Please contact reception.');
        }
        
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'pa_id' => $pa->id,
            'patient_name' => $request->patient_name,
            'patient_age' => $request->patient_age,
            'patient_phone' => $request->patient_phone,
            'reason' => $request->reason,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
            'created_by' => Auth::check() ? Auth::id() : 1,
        ]);
        
        return redirect()->route('home')->with('success', 'Appointment booked successfully! Your Reference ID: ' . $appointment->appointment_id);
    }
}