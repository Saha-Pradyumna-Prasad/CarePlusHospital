<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = Patient::where('email', Auth::user()->email)->first();
        
        if (!$patient) {
            $patient = Patient::where('phone', Auth::user()->email)->first();
        }
        
        $upcomingAppointments = Appointment::where('patient_phone', $patient->phone)
            ->where('appointment_time', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_time', 'asc')
            ->get();
        
        $pastAppointments = Appointment::where('patient_phone', $patient->phone)
            ->where('appointment_time', '<', now())
            ->orWhereIn('status', ['completed', 'cancelled'])
            ->orderBy('appointment_time', 'desc')
            ->take(10)
            ->get();
        
        $reports = Report::where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('dashboard.patient.index', compact('patient', 'upcomingAppointments', 'pastAppointments', 'reports'));
    }
    
    public function appointments()
    {
        $patient = Patient::where('email', Auth::user()->email)->first();
        $appointments = Appointment::where('patient_phone', $patient->phone)
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);
        
        return view('dashboard.patient.appointments', compact('appointments'));
    }
    
    public function reports()
    {
        $patient = Patient::where('email', Auth::user()->email)->first();
        $reports = Report::where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.patient.reports', compact('reports'));
    }
    
    public function updateProfile(Request $request)
    {
        $patient = Patient::where('email', Auth::user()->email)->first();
        
         if (!$patient) {
        $patient = Patient::where('phone', Auth::user()->email)->first();
    }

        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'emergency_contact' => 'required|string',
        ]);
        
        $patient->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,
        ]);
         if ($request->ajax()) {
        return response()->json(['success' => true]);
    }
        
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);
        $patient = Patient::where('email', Auth::user()->email)->first();
        
        if ($report->patient_id != $patient->id) {
            abort(403);
        }
        
        $pdf = Pdf::loadView('pdf.report', compact('report', 'patient'));
        return $pdf->download('report-' . $report->id . '.pdf');
    }
}