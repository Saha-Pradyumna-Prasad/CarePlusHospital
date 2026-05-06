<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PA;
use Illuminate\Http\Request;

class PAController extends Controller
{
    public function index(Request $request)
    {
        $query = PA::with('doctor')->where('status', true);
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $pas = $query->paginate(10);
        
        return view('public.pas', compact('pas'));
    }
}