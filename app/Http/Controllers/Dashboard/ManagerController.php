<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Room;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        $manager = Auth::user()->staff;
        $stats = [
            'total_doctors' => Doctor::count(),
            'total_pas' => PA::count(),
            'total_staff' => Staff::count(),
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('status', 'available')->count(),
            'recent_reports' => Report::orderBy('created_at', 'desc')->take(5)->get(),
        ];
        
        $staff = Staff::with('user')->paginate(100);
        $rooms = Room::paginate(100);
        
        return view('dashboard.manager.index', compact('manager', 'stats', 'staff', 'rooms'));
    }
    
    public function staff()
    {
        $staff = Staff::with('user')->paginate(100);
        return view('dashboard.manager.staff', compact('staff'));
    }
    
    public function updateStaff(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'status' => 'required|boolean',
        ]);
        
        $staff->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);
        
        // Update user name if needed
        if ($staff->user) {
            $staff->user->update(['name' => $request->name]);
        }
        
        return redirect()->back()->with('success', 'Staff updated successfully!');
    }
    
    public function rooms()
    {
        $rooms = Room::paginate(100);
        return view('dashboard.manager.rooms', compact('rooms'));
    }
    
    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => 'required|integer',
            'capacity' => 'required|integer',
            'status' => 'required|in:occupied,available,maintenance',
        ]);
        
        $room->update([
            'name' => $request->name,
            'floor' => $request->floor,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('success', 'Room updated successfully!');
    }
}