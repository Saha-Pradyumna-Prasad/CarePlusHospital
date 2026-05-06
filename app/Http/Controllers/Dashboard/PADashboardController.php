<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PA;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PADashboardController extends Controller
{
    public function index()
    {
        $pa = Auth::user()->pa;
        $doctor = $pa->doctor;
        $patients = [];
        
        if ($doctor) {
            $patients = \App\Models\Patient::whereHas('appointments', function($q) use ($doctor) {
                $q->where('doctor_id', $doctor->id);
            })->distinct()->get();
        }
        
        $upcomingAppointments = Appointment::where('pa_id', $pa->id)
            ->where('appointment_time', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_time', 'asc')
            ->get();
        
        return view('dashboard.pa.index', compact('pa', 'doctor', 'patients', 'upcomingAppointments'));
    }
    
    public function appointments()
    {
        $pa = Auth::user()->pa;
        $appointments = Appointment::where('pa_id', $pa->id)
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);
        
        return view('dashboard.pa.appointments', compact('appointments'));
    }
    
    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);
        
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        
        $message = '';
    if ($request->status == 'completed') {
        $message = 'Appointment marked as completed successfully!';
    } elseif ($request->status == 'confirmed') {
        $message = 'Appointment confirmed successfully!';
    } elseif ($request->status == 'cancelled') {
        $message = 'Appointment cancelled successfully!';
    } 
    elseif ($request->status == 'Done') {
        $message = 'Appointment marked as done successfully!';
    }
    
    else {
        $message = 'Appointment status updated successfully!';
    }

        return redirect()->back()->with('success', 'Appointment status updated successfully!');
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        
        $pa = Auth::user()->pa;
        $pa->phone = $request->phone;
        $pa->save();
        
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