<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Virtual Report', 'description' => 'Get your medical reports online', 'category' => 'diagnostic'],
            ['name' => 'Physical Report', 'description' => 'Physical copy of medical reports', 'category' => 'diagnostic'],
            ['name' => 'X-Ray', 'description' => 'Digital X-Ray imaging service', 'category' => 'diagnostic'],
            ['name' => 'Ultrasound', 'description' => 'Ultrasound scanning service', 'category' => 'diagnostic'],
            ['name' => 'ICU', 'description' => 'Intensive Care Unit services', 'category' => 'clinical'],
            ['name' => 'Emergency', 'description' => '24/7 Emergency services', 'category' => 'clinical'],
            ['name' => 'O.T', 'description' => 'Operation Theatre facilities', 'category' => 'clinical'],
            ['name' => 'Clean Washroom', 'description' => 'Hygienic washroom facilities', 'category' => 'facility'],
            ['name' => 'Filtered Water', 'description' => 'RO filtered drinking water', 'category' => 'facility'],
            ['name' => 'Canteen', 'description' => 'Healthy food options', 'category' => 'facility'],
            ['name' => 'Medicine Corner', 'description' => '24/7 pharmacy services', 'category' => 'support'],
            ['name' => 'Lab Room', 'description' => 'Modern laboratory facilities', 'category' => 'support'],
            ['name' => 'Ambulance Service', 'description' => 'Emergency ambulance service', 'category' => 'support'],
            ['name' => 'Wheelchair', 'description' => 'Wheelchair assistance', 'category' => 'support'],
            ['name' => 'Stretcher', 'description' => 'Stretcher service', 'category' => 'support'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}