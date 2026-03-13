<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GpoaActivityController extends Controller
{
    public function create()
    {
        return view('gpoa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'required|string',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'description' => 'required|string',
            'participants_count' => 'required|integer|min:1',
            'communication_letter' => 'required|file|mimes:pdf|max:10240',
            'narrative_report' => 'required|file|mimes:pdf|max:10240',
            'photos.*' => 'nullable|image|mimes:jpeg,png,gif|max:10240',
            'verify' => 'required|accepted',
        ]);

        // Store the PDF documents
        $communictionLetterPath = $request->file('communication_letter')->store('activities/documents', 'public');
        $narrativeReportPath = $request->file('narrative_report')->store('activities/documents', 'public');

        $activity = Activity::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'organization' => $validated['organization'],
            'date' => $validated['date'],
            'venue' => $validated['venue'],
            'communication_letter' => $communictionLetterPath,
            'narrative_report' => $narrativeReportPath,
            'description' => $validated['description'],
            'participants_count' => $validated['participants_count'],
            'status' => 'pending',
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('activities/photos', 'public');
                // Store photo reference if you have a media table
            }
        }

        return redirect()->route('dashboard')->with('success', 'GPOA Activity submitted successfully!');
    }
}
