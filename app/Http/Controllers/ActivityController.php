<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function create()
    {
        return view('users.upload');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'communication_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'narrative_report' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Check for Date & Venue Conflict
        $conflict = Activity::where('date', $request->date)
            ->where('venue', $request->venue)
            ->where('status', 'approved')
            ->exists();

        if ($conflict) {
            return back()->withErrors(['venue' => 'An activity is already approved at this venue on this date.'])->withInput();
        }

        // Handle File Uploads
        $commPath = $request->hasFile('communication_letter') 
            ? $request->file('communication_letter')->store('uploads/comm', 'public') 
            : null;

        $narrativePath = $request->hasFile('narrative_report') 
            ? $request->file('narrative_report')->store('uploads/narratives', 'public') 
            : null;

        Activity::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'date' => $validated['date'],
            'venue' => $validated['venue'],
            // 'organization' or category may be handled differently for GPOA

            'communication_letter' => $commPath,
            'narrative_report' => $narrativePath,
        ]);

        return redirect()->route('user.activities')->with('success', 'Activity submitted successfully!');
    }

    public function index()
    {
        $activities = Activity::where('user_id', auth()->id())->latest()->paginate(10);
        return view('users.activities', compact('activities'));
    }
}