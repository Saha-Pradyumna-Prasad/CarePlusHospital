<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\Patient;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LabController extends Controller
{
    public function index()
    {
        $labTester = Auth::user()->staff;
        $recentTests = LabTest::where('performed_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        $pendingTests = LabTest::where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->take(5)
            ->get();
        
        $patients = Patient::all();
        
        return view('dashboard.lab.index', compact('labTester', 'recentTests', 'pendingTests', 'patients'));
    }
    
    public function tests()
    {
        $tests = LabTest::where('performed_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.lab.tests', compact('tests'));
    }
    
    public function storeTest(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'test_type' => 'required|string',
            'bottle_id' => 'nullable|string',
            'result' => 'nullable|string',
            'status' => 'required|in:pending,processing,completed',
        ]);
        
        $test = LabTest::create([
            'patient_id' => $request->patient_id,
            'test_type' => $request->test_type,
            'bottle_id' => $request->bottle_id,
            'result' => $request->result,
            'status' => $request->status,
            'performed_by' => Auth::id(),
        ]);
        
        // If test is completed, create a lab report automatically
        if ($request->status == 'completed' && $request->result) {
            Report::create([
                'patient_id' => $request->patient_id,
                'test_id' => $test->id,
                'title' => 'Lab Test Report: ' . $request->test_type,
                'content' => $request->result,
                'type' => 'lab',
                'created_by' => Auth::id(),
            ]);
        }
        
        return response()->json(['success' => true, 'message' => 'Test created successfully!']);
    }
    
    public function updateTest(Request $request, $id)
    {
        $test = LabTest::findOrFail($id);
        
        $request->validate([
            'result' => 'nullable|string',
            'status' => 'required|in:pending,processing,completed',
        ]);
        
        $oldStatus = $test->status;
        $test->update([
            'result' => $request->result,
            'status' => $request->status,
        ]);
        
        // If test is completed, create or update lab report
        if ($request->status == 'completed' && $request->result) {
            Report::updateOrCreate(
                ['test_id' => $test->id],
                [
                    'patient_id' => $test->patient_id,
                    'title' => 'Lab Test Report: ' . $test->test_type,
                    'content' => $request->result,
                    'type' => 'lab',
                    'created_by' => Auth::id(),
                ]
            );
        }
        
        return redirect()->back()->with('success', 'Lab test updated successfully!');
    }
    
    public function showTest($id)
    {
        $test = LabTest::with('patient')->findOrFail($id);
        return response()->json($test);
    }
    
    public function generatePDF($id)
    {
        $test = LabTest::with('patient', 'performedBy')->findOrFail($id);
        
        $data = [
            'test' => $test,
            'patient' => $test->patient,
            'hospital_name' => 'Care Plus Hospital',
            'hospital_address' => '123 Healthcare Avenue, Medical District, NY 10001',
            'hospital_phone' => '+1 (234) 567-8900',
            'hospital_email' => 'info@careplushospital.com',
            'generated_date' => now()->format('F d, Y H:i:s')
        ];
        
        $pdf = Pdf::loadView('pdf.lab-report', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Lab-Report-' . $test->test_id . '.pdf');
    }
    
    public function deleteTest($id)
    {
        try {
            $test = LabTest::findOrFail($id);
            
            // Delete associated report if exists
            if ($test->report) {
                $test->report->delete();
            }
            
            $test->delete();
            
            return redirect()->back()->with('success', 'Lab test deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting test: ' . $e->getMessage());
        }
    }
}