<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReceptionistController extends Controller
{
    // Dashboard Index
    public function index()
    {
        $receptionist = Auth::user()->staff;
        $doctors = Doctor::where('status', true)->get();
        $todayAppointments = Appointment::whereDate('appointment_time', today())
            ->orderBy('appointment_time', 'asc')
            ->get();
        
        $recentAppointments = Appointment::where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        return view('dashboard.receptionist.index', compact('receptionist', 'doctors', 'todayAppointments', 'recentAppointments'));
    }
    
    // Appointments Management
    public function appointments()
    {
        $appointments = Appointment::where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.receptionist.appointments', compact('appointments'));
    }
    
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'required|integer|min:0|max:150',
            'reason' => 'required|string',
            'appointment_time' => 'required|date',
            'patient_phone' => 'required|string|max:20',
        ]);
        
        $pa = PA::where('doctor_id', $request->doctor_id)->where('status', true)->first();
        
        if (!$pa) {
            return redirect()->back()->with('error', 'No PA assigned to this doctor.');
        }
        
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'pa_id' => $pa->id,
            'patient_name' => $request->patient_name,
            'patient_age' => $request->patient_age,
            'patient_phone' => $request->patient_phone,
            'reason' => $request->reason,
            'appointment_time' => $request->appointment_time,
            'status' => 'confirmed',
            'created_by' => Auth::id(),
        ]);
        
        return redirect()->back()->with('success', 'Appointment booked successfully! Reference ID: ' . $appointment->appointment_id);
    }
    
    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        if ($appointment->created_by != Auth::id()) {
            abort(403);
        }
        
        $appointment->status = 'cancelled';
        $appointment->save();
        
        return redirect()->back()->with('success', 'Appointment cancelled successfully!');
    }
    
    // Get PA info via AJAX
    public function getPA($doctorId)
    {
        $pa = PA::where('doctor_id', $doctorId)->where('status', true)->first();
        if ($pa) {
            return response()->json([
                'success' => true,
                'pa_name' => $pa->name,
                'pa_phone' => $pa->phone
            ]);
        }
        return response()->json(['success' => false]);
    }
    
    // Patients Management
    public function patients()
    {
        $patients = Patient::with('registeredBy')->paginate(100);
        return view('dashboard.receptionist.patients', compact('patients'));
    }
    
    public function storePatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string',
            'address' => 'required|string',
            'emergency_contact' => 'required|string',
        ]);
        
        $patient = Patient::create([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'blood_group' => $request->blood_group,
            'emergency_contact' => $request->emergency_contact,
            'registered_by' => auth()->id(),
        ]);
        
        // Create user account if email and password provided
        if ($request->email && $request->password) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'patient',
            ]);
        }
        
        return redirect()->route('receptionist.patients')->with('success', 'Patient added successfully!');
    }
    
    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string',
            'address' => 'required|string',
            'emergency_contact' => 'required|string',
        ]);
        
        $patient->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'blood_group' => $request->blood_group,
            'emergency_contact' => $request->emergency_contact,
        ]);
        
        return redirect()->route('receptionist.patients')->with('success', 'Patient updated successfully!');
    }
    
    public function deletePatient($id)
    {
        $patient = Patient::findOrFail($id);
        
        // Delete associated user account if exists
        if ($patient->user) {
            $patient->user->delete();
        }
        
        $patient->delete();
        
        return redirect()->route('receptionist.patients')->with('success', 'Patient deleted successfully!');
    }
}