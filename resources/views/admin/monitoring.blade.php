<x-app-layout>
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Activity Monitoring</h2>
        <form method="GET" action="{{ route('admin.activities') }}" class="mt-2 md:mt-0 flex gap-2">
            <input type="text" name="search" placeholder="Search by venue, title or date" value="{{ request('search') }}" class="border rounded px-3 py-1" />
            <button type="submit" class="px-4 py-1 bg-sky-600 text-white rounded">Search</button>
            <button type="button" onclick="window.print()" class="ml-1 px-3 py-1 bg-gray-600 text-white rounded text-xs">Print</button>
        </form>
    </div>

    @if(isset($stats))
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Total Submitted</p>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Pending</p>
            <p class="text-3xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Approved</p>
            <p class="text-3xl font-bold text-green-500">{{ $stats['approved'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Rejected</p>
            <p class="text-3xl font-bold text-red-500">{{ $stats['rejected'] }}</p>
        </div>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm min-w-[800px] bg-white rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Activity</th>
                    <th class="p-2 text-left">Organization</th>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Venue</th>
                    <th class="p-2 text-left">Participants</th>
                    <th class="p-2 text-left">Letter</th>
                    <th class="p-2 text-left">Report</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                <tr class="border-b last:border-0">
                    <td class="p-2">{{ $activity->title }}</td>
                    <td class="p-2">{{ $activity->organization }}</td>
                    <td class="p-2">{{ $activity->date->format('M d, Y') }}</td>
                    <td class="p-2">{{ $activity->venue }}</td>
                    <td class="p-2">{{ $activity->participants_count }}</td>
                    <td class="p-2">
                        @if($activity->communication_letter)
                            <a href="{{ asset('storage/' . $activity->communication_letter) }}" target="_blank" class="text-blue-600 underline">Download</a>
                            <a href="#" data-file="{{ asset('storage/' . $activity->communication_letter) }}" class="text-blue-600 underline view-file">View</a>
                        @else
                            &mdash;
                        @endif
                    </td>
                    <td class="p-2">
                        @if($activity->narrative_report)
                            <a href="{{ asset('storage/' . $activity->narrative_report) }}" target="_blank" class="text-blue-600 underline">Download</a>
                            <a href="#" data-file="{{ asset('storage/' . $activity->narrative_report) }}" class="text-blue-600 underline view-file">View</a>
                        @else
                            &mdash;
                        @endif
                    </td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded-full text-xs font-bold 
                            {{ $activity->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $activity->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $activity->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($activity->status) }}
                        </span>
                    </td>
                    <td class="p-2 flex space-x-2">
                        @if($activity->status == 'pending')
                            <a href="{{ route('admin.approve', $activity->id) }}" class="text-green-600">Approve</a>
                            <a href="{{ route('admin.reject', $activity->id) }}" class="text-red-600">Reject</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $activities->links() }}
    </div>

    <!-- Preview Modal -->
    <div id="filePreviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden w-3/4 h-3/4">
            <div class="flex justify-end p-2">
                <button id="closePreview" class="text-gray-700">&times;</button>
            </div>
            <iframe id="previewFrame" src="" class="w-full h-full"></iframe>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.view-file').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('data-file');
                const modal = document.getElementById('filePreviewModal');
                document.getElementById('previewFrame').src = url;
                modal.classList.remove('hidden');
            });
        });
        document.getElementById('closePreview').addEventListener('click', function() {
            const modal = document.getElementById('filePreviewModal');
            modal.classList.add('hidden');
            document.getElementById('previewFrame').src = '';
        });
    </script>
    @endpush
</x-app-layout>