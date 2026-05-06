<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Room;
use App\Models\Patient;

class HomeController extends Controller
{
    public function index()
    {
        $totalDoctors = Doctor::count();
        $totalServices = Service::count();
        $totalRooms = Room::count();
        $totalPatients = Patient::count();
        $featuredServices = Service::where('status', true)->take(6)->get();
        $featuredDoctors = Doctor::where('status', true)->take(4)->get();
        
        return view('public.home', compact(
            'totalDoctors', 
            'totalServices', 
            'totalRooms',
            'totalPatients',
            'featuredServices', 
            'featuredDoctors'
        ));
    }
}