<x-app-layout>
    <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Submit Activity Report</h2>
        
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Title of Activity</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Organization</label>
                        <select name="organization" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">Select organization</option>
                            <option value="PASSED">PASSED</option>
                            <option value="JAB-CIM">JAB-CIM</option>
                            <option value="HMS">HMS</option>
                            <option value="FAME">FAME</option>
                            <option value="GFARS-SCO">GFARS-SCO</option>
                            <option value="ASDIDS">ASDIDS</option>
                            <option value="CITE-SC">CITE-SC</option>
                            <option value="GFARS-SC">GFARS-SC</option>
                            <option value="CICS-SC">CICS-SC</option>
                            <option value="MARAHUYO">MARAHUYO</option>
                            <option value="CTE-SC">CTE-SC</option>
                            <option value="CIM-SC">CIM-SC</option>
                            <option value="LEVEL">LEVEL</option>
                            <option value="CSC">CSC</option>
                            <option value="THE WATERWORLD">THE WATERWORLD</option>
                            <option value="THE MANFOR">THE MANFOR</option>
                            <option value="THE LEDGER">THE LEDGER</option>
                            <option value="THE CONDUIT">THE CONDUIT</option>
                            <option value="THE CALIBER">THE CALIBER</option>
                            <option value="THE BANQUET">THE BANQUET</option>
                            <option value="THE ACADEMIA">THE ACADEMIA</option>
                            <option value="THE AQUARIUS">THE AQUARIUS</option>
                            <option value="SARIGAWAN">SARIGAWAN</option>
                            <option value="STA">STA</option>
                            <option value="SIKLAHON">SIKLAHON</option>
                            <option value="SARITADA">SARITADA</option>
                            <option value="KASINDAKAN">KASINDAKAN</option>
                            <option value="TOUCH">TOUCH</option>
                            <option value="GS-SC">GS-SC</option>
                            <option value="CBI">CBI</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                        <input type="date" name="date" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Venue</label>
                        <input type="text" name="venue" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Communication Letter</label>
                        <input type="file" name="communication_letter" class="w-full border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Narrative Report</label>
                        <input type="file" name="narrative_report" class="w-full border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t">
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition">
                    Submit Activity
                </button>
            </div>
        </form>
    </div>
</x-app-layout>