<x-app-layout>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">My Activities</h2>

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto border border-gray-200">
        <table class="w-full text-sm min-w-[600px]">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Title</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Date</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Venue</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Files</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($activities as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 font-medium">{{ $item->title }}</td>
                    <td class="px-4 py-4">{{ $item->date->format('M d, Y') }}</td>
                    <td class="px-4 py-4">{{ $item->venue }}</td>
                    <td class="px-4 py-4">
                        @if($item->communication_letter)
                            <a href="{{ asset('storage/' . $item->communication_letter) }}" target="_blank" class="text-sky-600 hover:underline mr-2">Comm</a>
                        @endif
                        @if($item->narrative_report)
                            <a href="{{ asset('storage/' . $item->narrative_report) }}" target="_blank" class="text-green-600 hover:underline">Narrative</a>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-bold
                            {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $item->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $item->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $activities->links() }}
</x-app-layout>