<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Activity::count(),
            'organizations' => User::where('role', 'user')->count(),
            'approved' => Activity::where('status', 'approved')->count(),
            'pending' => Activity::where('status', 'pending')->count(),
            'rejected' => Activity::where('status', 'rejected')->count(),
        ];

        // Chart Data
        $topOrgs = User::withCount('activities')
            ->where('role', 'user')
            ->orderBy('activities_count', 'desc')
            ->take(5)
            ->get();

        // Recent submissions for quick review
        $recentActivities = Activity::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'topOrgs', 'recentActivities'));
    }

    public function monitor(Request $request)
    {
        $query = Activity::with('user');

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('venue', 'like', "%{$term}%")
                  ->orWhere('title', 'like', "%{$term}%");
                try {
                    $date = \Carbon\Carbon::parse($term)->toDateString();
                    $q->orWhereDate('date', $date);
                } catch (\Exception $e) {
                    // ignore
                }
            });
        }

        $activities = $query->latest()->paginate(10)->withQueryString();

        // statistics for summary
        $stats = [
            'total' => Activity::count(),
            'approved' => Activity::where('status', 'approved')->count(),
            'pending' => Activity::where('status', 'pending')->count(),
            'rejected' => Activity::where('status', 'rejected')->count(),
            'organizations' => User::where('role', 'user')->count(),
        ];

        return view('admin.monitoring', compact('activities', 'stats'));
    }

    public function approve($id)
    {
        $activity = Activity::findOrFail($id);
        
        // Double check conflict
        $conflict = Activity::where('date', $activity->date)
            ->where('venue', $activity->venue)
            ->where('status', 'approved')
            ->where('id', '!=', $id)
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Cannot approve. Conflict detected.');
        }

        $activity->update(['status' => 'approved']);
        return back()->with('success', 'Activity approved.');
    }

    public function reject($id)
    {
        Activity::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Activity rejected.');
    }

    /**
     * Export activities list as CSV or PDF.
     */
    public function exportActivities(Request $request, $format)
    {
        $query = Activity::with('user');
        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('venue', 'like', "%{$term}%")
                  ->orWhere('title', 'like', "%{$term}%");
                try {
                    $date = \Carbon\Carbon::parse($term)->toDateString();
                    $q->orWhereDate('date', $date);
                } catch (\Exception $e) {
                }
            });
        }
        $activities = $query->latest()->get();

        if ($format === 'excel') {
            $filename = 'activities_' . now()->format('Ymd_His') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];
            $callback = function() use ($activities) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Title','Date','Venue','User','Status']);
                foreach ($activities as $a) {
                    fputcsv($handle, [
                        $a->title,
                        $a->date->toDateString(),
                        $a->venue,
                        $a->user->name,
                        $a->status,
                    ]);
                }
                fclose($handle);
            };
            return response()->stream($callback, 200, $headers);
        }

        if ($format === 'pdf') {
            $pdf = \PDF::loadView('admin.exports.activities', compact('activities'));
            return $pdf->download('activities_' . now()->format('Ymd_His') . '.pdf');
        }

        abort(404);
    }
}