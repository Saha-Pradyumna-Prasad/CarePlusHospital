<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Staff;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard Index
    public function index()
    {
        $stats = [
            'total_doctors' => Doctor::count(),
            'total_pas' => PA::count(),
            'total_staff' => Staff::count(),
            'total_patients' => Patient::count(),
            'total_rooms' => Room::count(),
            'total_services' => Service::count(),
        ];
        
        return view('dashboard.admin.index', compact('stats'));
    }

    // Doctors Management
    public function doctors()
    {
        $doctors = Doctor::with('user')->latest()->paginate(100);
        return view('dashboard.admin.doctors', compact('doctors'));
    }

    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'designation' => 'required|string',
            'specialty' => 'required|string',
            'degree' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        Doctor::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'designation' => $request->designation,
            'specialty' => $request->specialty,
            'degree' => $request->degree,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'status' => true,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Doctor added successfully!');
    }

    public function updateDoctor(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string',
            'specialty' => 'required|string',
            'degree' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($doctor->user) {
            $doctor->user->update(['name' => $request->name]);
        }

        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $photoPath = $request->file('photo')->store('doctors', 'public');
            $doctor->photo = $photoPath;
        }

        $doctor->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'specialty' => $request->specialty,
            'degree' => $request->degree,
            'phone' => $request->phone,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Doctor updated successfully!');
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }

        if ($doctor->user) {
            $doctor->user->delete();
        }

        $doctor->delete();

        return redirect()->route('admin.doctors')->with('success', 'Doctor deleted successfully!');
    }

    // PAs Management
    public function pas()
    {
        $pas = PA::with(['user', 'doctor'])->paginate(100);
        $doctors = Doctor::where('status', true)->get();
        return view('dashboard.admin.pas', compact('pas', 'doctors'));
    }

    public function storePA(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'phone' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pa',
        ]);
        
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pas', 'public');
        }

        PA::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'doctor_id' => $request->doctor_id,
            'photo' => $photoPath,
            'status' => true,
        ]);

        return redirect()->route('admin.pas')->with('success', 'PA added successfully!');
    }

    public function updatePA(Request $request, $id)
    {
        $pa = PA::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($pa->user) {
            $pa->user->update(['name' => $request->name]);
        }
        
        if ($request->hasFile('photo')) {
            if ($pa->photo) {
                Storage::disk('public')->delete($pa->photo);
            }
            $photoPath = $request->file('photo')->store('pas', 'public');
            $pa->photo = $photoPath;
        }
        
        $pa->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'doctor_id' => $request->doctor_id,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('admin.pas')->with('success', 'PA updated successfully!');
    }

    public function deletePA($id)
    {
        $pa = PA::findOrFail($id);

        if ($pa->photo) {
            Storage::disk('public')->delete($pa->photo);
        }

        if ($pa->user) {
            $pa->user->delete();
        }

        $pa->delete();

        return redirect()->route('admin.pas')->with('success', 'PA deleted successfully!');
    }

    // Staff Management
    public function staff()
    {
        $staff = Staff::with('user')->paginate(100);
        return view('dashboard.admin.staff', compact('staff'));
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'role_type' => 'required|in:receptionist,lab_tester,manager,other',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role_type,
            ]);

            $roleMap = [
            'receptionist' => 'receptionist',
            'lab_tester' => 'lab_tester',
            'manager' => 'manager',
            'other' => 'other'
        ];
         $roleValue = $roleMap[$request->role_type] ?? 'other';

            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('staff', 'public');
            }

            Staff::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'role_type' => $request->role_type,
                'email' => $request->email,
                'phone' => $request->phone,
                'photo' => $photoPath,
                'status' => true,
            ]);

            return redirect()->route('admin.staff')->with('success', 'Staff added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding staff: ' . $e->getMessage())->withInput();
        }
    }

    public function updateStaff(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'role_type' => 'required|in:receptionist,lab_tester,manager,other',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($staff->user) {
                $staff->user->update([
                    'name' => $request->name,
                    'role' => $request->role_type
                ]);
            }

            if ($request->hasFile('photo')) {
                if ($staff->photo) {
                    Storage::disk('public')->delete($staff->photo);
                }
                $photoPath = $request->file('photo')->store('staff', 'public');
                $staff->photo = $photoPath;
            }

            $staff->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'role_type' => $request->role_type,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()->route('admin.staff')->with('success', 'Staff updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating staff: ' . $e->getMessage());
        }
    }

    public function deleteStaff($id)
    {
        try {
            $staff = Staff::findOrFail($id);

            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }

            if ($staff->user) {
                $staff->user->delete();
            }

            $staff->delete();

            return redirect()->route('admin.staff')->with('success', 'Staff deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting staff: ' . $e->getMessage());
        }
    }

    // Patients Management
    public function patients()
    {
        $patients = Patient::with('registeredBy')->paginate(100);
        return view('dashboard.admin.patients', compact('patients'));
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
        
        try {
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
            
            if ($request->email && $request->password) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'patient',
                ]);
            }
            
            return redirect()->route('admin.patients')->with('success', 'Patient added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding patient: ' . $e->getMessage());
        }
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
        
        try {
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
            
            return redirect()->route('admin.patients')->with('success', 'Patient updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating patient: ' . $e->getMessage());
        }
    }

    public function deletePatient($id)
    {
        $patient = Patient::findOrFail($id);
        
        if ($patient->photo) {
            Storage::disk('public')->delete($patient->photo);
        }
        
        if ($patient->user) {
            $patient->user->delete();
        }
        
        $patient->delete();

        return redirect()->route('admin.patients')->with('success', 'Patient deleted successfully!');
    }

    // Services Management
    public function services()
    {
        $services = Service::paginate(10);
        return view('dashboard.admin.services', compact('services'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:diagnostic,clinical,support,facility',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services')->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:diagnostic,clinical,support,facility',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services')->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Service deleted successfully!');
    }

    // Rooms Management
    public function rooms()
    {
        $rooms = Room::paginate(100);
        return view('dashboard.admin.rooms', compact('rooms'));
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|unique:rooms',
            'name' => 'required|string',
            'type' => 'required|string',
            'floor' => 'required|integer',
            'capacity' => 'required|integer',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms')->with('success', 'Room added successfully!');
    }

    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'floor' => 'required|integer',
            'capacity' => 'required|integer',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms')->with('success', 'Room updated successfully!');
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.rooms')->with('success', 'Room deleted successfully!');
    }
}