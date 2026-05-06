<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Staff;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@rcms.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Manager
        $managerUser = User::create([
            'name' => 'John Manager',
            'email' => 'manager@hospital.com',
            'password' => Hash::make('password123'),
            'role' => 'manager',
        ]);

        Staff::create([
            'user_id' => $managerUser->id,
            'staff_id' => 'ST-0001',
            'name' => 'John Manager',
            'role_type' => 'manager',
            'email' => 'manager@hospital.com',
            'phone' => '+1234567890',
            'status' => true,
        ]);

        // Create Doctors
        $doctorUser1 = User::create([
            'name' => 'Dr. Sarah Johnson',
            'email' => 'sarah.johnson@hospital.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        Doctor::create([
            'user_id' => $doctorUser1->id,
            'doctor_id' => 'DR-0001',
            'name' => 'Dr. Sarah Johnson',
            'designation' => 'Senior Consultant',
            'specialty' => 'Cardiology',
            'degree' => 'MD, FACC',
            'email' => 'sarah.johnson@hospital.com',
            'phone' => '+1234567891',
            'status' => true,
        ]);

        $doctorUser2 = User::create([
            'name' => 'Dr. Michael Chen',
            'email' => 'michael.chen@hospital.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        Doctor::create([
            'user_id' => $doctorUser2->id,
            'doctor_id' => 'DR-0002',
            'name' => 'Dr. Michael Chen',
            'designation' => 'Neurologist',
            'specialty' => 'Neurology',
            'degree' => 'MD, FRCP',
            'email' => 'michael.chen@hospital.com',
            'phone' => '+1234567892',
            'status' => true,
        ]);

        // Create PA
        $paUser = User::create([
            'name' => 'Emily Wilson',
            'email' => 'emily.wilson@hospital.com',
            'password' => Hash::make('password123'),
            'role' => 'pa',
        ]);

        PA::create([
            'user_id' => $paUser->id,
            'pa_id' => 'PA-0001',
            'name' => 'Emily Wilson',
            'email' => 'emily.wilson@hospital.com',
            'phone' => '+1234567893',
            'doctor_id' => 1,
            'status' => true,
        ]);

        // Create Receptionist
        $receptionistUser = User::create([
            'name' => 'Lisa Brown',
            'email' => 'lisa.brown@hospital.com',
            'password' => Hash::make('password123'),
            'role' => 'receptionist',
        ]);

        Staff::create([
            'user_id' => $receptionistUser->id,
            'staff_id' => 'ST-0002',
            'name' => 'Lisa Brown',
            'role_type' => 'receptionist',
            'email' => 'lisa.brown@hospital.com',
            'phone' => '+1234567894',
            'status' => true,
        ]);

        // Create Lab Tester
        $labTesterUser = User::create([
            'name' => 'David Miller',
            'email' => 'david.miller@hospital.com',
            'password' => Hash::make('password123'),
            'role' => 'lab_tester',
        ]);

        Staff::create([
            'user_id' => $labTesterUser->id,
            'staff_id' => 'ST-0003',
            'name' => 'David Miller',
            'role_type' => 'lab_tester',
            'email' => 'david.miller@hospital.com',
            'phone' => '+1234567895',
            'status' => true,
        ]);

        // Create Patient
        $patientUser = User::create([
            'name' => 'John Doe',
            'email' => 'patient@example.com',
            'password' => Hash::make('password123'),
            'role' => 'patient',
        ]);

        Patient::create([
            'patient_id' => 'PT-0001',
            'name' => 'John Doe',
            'age' => 35,
            'gender' => 'male',
            'phone' => '+1234567896',
            'email' => 'patient@example.com',
            'address' => '123 Main St, City',
            'blood_group' => 'O+',
            'emergency_contact' => '+1234567897',
            'registered_by' => 1,
        ]);
    }
}