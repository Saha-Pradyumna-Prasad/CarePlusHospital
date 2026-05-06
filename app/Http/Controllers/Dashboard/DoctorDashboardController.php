<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;
        $pa = PA::where('doctor_id', $doctor->id)->first();
        $patients = Patient::whereHas('appointments', function($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })->distinct()->get();
        
        $upcomingAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_time', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_time', 'asc')
            ->get();
        
        $pastAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_time', '<', now())
            ->orWhereIn('status', ['completed', 'cancelled'])
            ->orderBy('appointment_time', 'desc')
            ->take(10)
            ->get();
        
        return view('dashboard.doctor.index', compact('doctor', 'pa', 'patients', 'upcomingAppointments', 'pastAppointments'));
    }
    
    public function patients()
    {
        $doctor = Auth::user()->doctor;
        $patients = Patient::whereHas('appointments', function($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })->with('reports')->paginate(10);
        
        return view('dashboard.doctor.patients', compact('patients'));
    }
    
    public function appointments()
    {
        $doctor = Auth::user()->doctor;
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);
        
        return view('dashboard.doctor.appointments', compact('appointments'));
    }
    
    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);
        
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        
        return redirect()->back()->with('success', 'Appointment status updated successfully!');
    }
    
    public function storeReport(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:lab,diagnosis,discharge',
        ]);
        
        Report::create([
            'patient_id' => $request->patient_id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'created_by' => Auth::id(),
        ]);
        
        return redirect()->back()->with('success', 'Report created successfully!');
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        
        $doctor = Auth::user()->doctor;
        $doctor->phone = $request->phone;
        $doctor->save();
        
        if ($request->new_password) {
            if (Hash::check($request->current_password, Auth::user()->password)) {
                Auth::user()->update(['password' => Hash::make($request->new_password)]);
            } else {
                return redirect()->back()->with('error', 'Current password is incorrect!');
            }
        }
        
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}