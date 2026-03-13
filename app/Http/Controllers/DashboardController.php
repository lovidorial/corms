<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = Activity::where('user_id', auth()->id())->latest()->get();
        
        $stats = [
            'total' => $activities->count(),
            'pending' => $activities->where('status', 'pending')->count(),
            'approved' => $activities->where('status', 'approved')->count(),
            'rejected' => $activities->where('status', 'rejected')->count(),
        ];

        return view('dashboard', compact('activities', 'stats'));
    }
}