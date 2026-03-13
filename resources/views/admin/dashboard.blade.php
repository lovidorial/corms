<x-app-layout>
    <h2 class="admin-header">Admin Dashboard</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Total</p>
            <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow green">
            <p class="text-sm text-gray-500 uppercase">Approved</p>
            <p class="text-3xl font-bold">{{ $stats['approved'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow yellow">
            <p class="text-sm text-gray-500 uppercase">Pending</p>
            <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow red">
            <p class="text-sm text-gray-500 uppercase">Rejected</p>
            <p class="text-3xl font-bold">{{ $stats['rejected'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow purple">
            <p class="text-sm text-gray-500 uppercase">Organizations</p>
            <p class="text-3xl font-bold">{{ $stats['organizations'] }}</p>
        </div>
    </div>

    @if(isset($recentActivities) && $recentActivities->count())
    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-2">Recent Submissions</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[600px] bg-white rounded-lg shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Title</th>
                        <th class="p-2 text-left">Organization</th>
                        <th class="p-2 text-left">Date</th>
                        <th class="p-2 text-left">Venue</th>
                        <th class="p-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentActivities as $act)
                    <tr class="border-b last:border-0">
                        <td class="p-2">{{ $act->title }}</td>
                        <td class="p-2">{{ $act->organization }}</td>
                        <td class="p-2">{{ $act->date->format('M d, Y') }}</td>
                        <td class="p-2">{{ $act->venue }}</td>
                        <td class="p-2">
                            <span class="px-2 py-1 rounded-full text-xs font-bold 
                                {{ $act->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $act->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $act->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($act->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="content-grid">
        <div class="card col-span-2">
            <h3 class="card-title">Top Organizations</h3>
            <canvas id="orgChart" height="100"></canvas>
        </div>
    </div>

    <div class="activity-box">
        <div class="activity-content">
            <h4>Activity Monitoring</h4>
            <p>Review, approve, or reject pending activities.</p>
        </div>
        <a href="{{ route('admin.activities') }}" class="activity-btn">
            Go to Monitoring
        </a>
    </div>

    @push('scripts')
    <script>
        const ctx = document.getElementById('orgChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {{ $topOrgs->pluck('name') }},
                datasets: [{
                    label: 'Activities Submitted',
                    data: {{ $topOrgs->pluck('activities_count') }},
                    backgroundColor: 'rgba(14, 165, 233, 0.7)',
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>
    @endpush
</x-app-layout>