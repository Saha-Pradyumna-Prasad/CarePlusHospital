<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('status', true);
        
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        $services = $query->get();
        $categories = Service::distinct()->pluck('category');
        
        return view('public.services', compact('services', 'categories'));
    }
}