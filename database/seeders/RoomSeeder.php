<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['room_number' => 'W-101', 'name' => 'General Ward A', 'type' => 'patient_ward', 'floor' => 1, 'capacity' => 10],
            ['room_number' => 'W-102', 'name' => 'General Ward B', 'type' => 'patient_ward', 'floor' => 1, 'capacity' => 10],
            ['room_number' => 'DR-201', 'name' => 'Dr. Sarah Johnson', 'type' => 'doctor_room', 'floor' => 2, 'capacity' => 1],
            ['room_number' => 'DR-202', 'name' => 'Dr. Michael Chen', 'type' => 'doctor_room', 'floor' => 2, 'capacity' => 1],
            ['room_number' => 'XR-301', 'name' => 'X-Ray Room', 'type' => 'xray_room', 'floor' => 3, 'capacity' => 5],
            ['room_number' => 'US-302', 'name' => 'Ultrasound Scan Room', 'type' => 'ultra_scan_room', 'floor' => 3, 'capacity' => 5],
            ['room_number' => 'ICU-401', 'name' => 'ICU Unit 1', 'type' => 'icu', 'floor' => 4, 'capacity' => 8],
            ['room_number' => 'ER-101', 'name' => 'Emergency Room', 'type' => 'emergency', 'floor' => 1, 'capacity' => 15],
            ['room_number' => 'OT-501', 'name' => 'Operation Theatre 1', 'type' => 'ot', 'floor' => 5, 'capacity' => 10],
            ['room_number' => 'RC-101', 'name' => 'Reception Area', 'type' => 'reception', 'floor' => 1, 'capacity' => 20],
            ['room_number' => 'RP-302', 'name' => 'Report Collection', 'type' => 'report_room', 'floor' => 3, 'capacity' => 10],
            ['room_number' => 'WB-101', 'name' => 'Public Washroom', 'type' => 'washroom', 'floor' => 1, 'capacity' => 5],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}