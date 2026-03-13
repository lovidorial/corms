<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
            <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
    
    @if(auth()->user()->isAdmin())
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-semibold">Total Submitted</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-semibold">Pending</p>
            <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-semibold">Approved</p>
            <p class="text-3xl font-bold text-green-500 mt-2">{{ $stats['approved'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-semibold">Rejected</p>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ $stats['rejected'] }}</p>
        </div>
    </div>
    @endif
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-full overflow-x-auto">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Your Recent Activities</h3>
        
        @if($activities->count() > 0)
        <table class="w-full text-sm min-w-[500px]">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 text-gray-500">Title</th>
                        <th class="text-left py-2 text-gray-500">Date</th>
                        <th class="text-left py-2 text-gray-500">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities->take(5) as $activity)
                    <tr class="border-b last:border-0">
                        <td class="py-3">{{ $activity->title }}</td>
                        <td class="py-3">{{ $activity->date->format('M d, Y') }}</td>
                        <td class="py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-bold
                                {{ $activity->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $activity->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $activity->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500 py-4">No activities submitted yet. 
        </p>
        @endif
    </div>
</x-app-layout>