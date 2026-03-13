<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/gpoa-form.css') }}">
    
    <!-- Modal Backdrop -->
    <div class="modal-backdrop">
        <!-- Modal Container -->
        <div class="modal-container">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Submit GPOA Activity Report</h2>
                    <a href="{{ route('dashboard') }}" class="modal-close">&times;</a>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="modal-body">
                    <p class="modal-subtitle">Fill out the form below to submit your activity report</p>

                    <form action="{{ route('gpoa.store') }}" method="POST" enctype="multipart/form-data" class="gpoa-form">
                        @csrf

                        <!-- Activity Information Section -->
                        <div class="form-section">
                            <h3 class="section-title">Activity Information</h3>
                            
                            <div class="form-group">
                                <label for="title">Activity Title *</label>
                                <input type="text" id="title" name="title" required placeholder="Enter activity title" value="{{ old('title') }}">
                                @error('title') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="organization">Organization *</label>
                                    <select id="organization" name="organization" required>
                                        <option value="">Select organization</option>
                                        <option value="PASSED" {{ old('organization') == 'PASSED' ? 'selected' : '' }}>PASSED</option>
                                        <option value="JAB-CIM" {{ old('organization') == 'JAB-CIM' ? 'selected' : '' }}>JAB-CIM</option>
                                        <option value="HMS" {{ old('organization') == 'HMS' ? 'selected' : '' }}>HMS</option>
                                        <option value="FAME" {{ old('organization') == 'FAME' ? 'selected' : '' }}>FAME</option>
                                        <option value="GFARS-SCO" {{ old('organization') == 'GFARS-SCO' ? 'selected' : '' }}>GFARS-SCO</option>
                                        <option value="ASDIDS" {{ old('organization') == 'ASDIDS' ? 'selected' : '' }}>ASDIDS</option>
                                        <option value="CITE-SC" {{ old('organization') == 'CITE-SC' ? 'selected' : '' }}>CITE-SC</option>
                                        <option value="GFARS-SC" {{ old('organization') == 'GFARS-SC' ? 'selected' : '' }}>GFARS-SC</option>
                                        <option value="CICS-SC" {{ old('organization') == 'CICS-SC' ? 'selected' : '' }}>CICS-SC</option>
                                        <option value="MARAHUYO" {{ old('organization') == 'MARAHUYO' ? 'selected' : '' }}>MARAHUYO</option>
                                        <option value="CTE-SC" {{ old('organization') == 'CTE-SC' ? 'selected' : '' }}>CTE-SC</option>
                                        <option value="CTE-SC" {{ old('organization') == 'CTE-SC' ? 'selected' : '' }}>CTE-SC</option>
                                        <option value="CIM-SC" {{ old('organization') == 'CIM-SC' ? 'selected' : '' }}>CIM-SC</option>
                                        <option value="LEVEL" {{ old('organization') == 'LEVEL' ? 'selected' : '' }}>LEVEL</option>
                                        <option value="CSC" {{ old('organization') == 'CSC' ? 'selected' : '' }}>CSC</option>
                                        <option value="THE WATERWORLD" {{ old('organization') == 'THE WATERWORLD' ? 'selected' : '' }}>THE WATERWORLD</option>
                                        <option value="THE MANFOR" {{ old('organization') == 'THE MANFOR' ? 'selected' : '' }}>THE MANFOR</option>
                                        <option value="THE LEDGER" {{ old('organization') == 'THE LEDGER' ? 'selected' : '' }}>THE LEDGER</option>
                                        <option value="THE CONDUIT" {{ old('organization') == 'THE CONDUIT' ? 'selected' : '' }}>THE CONDUIT</option>
                                        <option value="THE CALIBER" {{ old('organization') == 'THE CALIBER' ? 'selected' : '' }}>THE CALIBER</option>
                                        <option value="THE BANQUET" {{ old('organization') == 'THE BANQUET' ? 'selected' : '' }}>THE BANQUET</option>
                                        <option value="THE ACADEMIA" {{ old('organization') == 'THE ACADEMIA' ? 'selected' : '' }}>THE ACADEMIA</option>
                                        <option value="THE AQUARIUS" {{ old('organization') == 'THE AQUARIUS' ? 'selected' : '' }}>THE AQUARIUS</option>
                                        <option value="SARIGAWAN" {{ old('organization') == 'SARIGAWAN' ? 'selected' : '' }}>SARIGAWAN</option>
                                        <option value="STA" {{ old('organization') == 'STA' ? 'selected' : '' }}>STA</option>
                                        <option value="SIKLAHON" {{ old('organization') == 'SIKLAHON' ? 'selected' : '' }}>SIKLAHON</option>
                                        <option value="SARITADA" {{ old('organization') == 'SARITADA' ? 'selected' : '' }}>SARITADA</option>
                                        <option value="KASINDAKAN" {{ old('organization') == 'KASINDAKAN' ? 'selected' : '' }}>KASINDAKAN</option>
                                        <option value="TOUCH" {{ old('organization') == 'TOUCH' ? 'selected' : '' }}>TOUCH</option>
                                        <option value="GS-SC" {{ old('organization') == 'GS-SC' ? 'selected' : '' }}>GS-SC</option>
                                        <option value="CBI" {{ old('organization') == 'CBI' ? 'selected' : '' }}>CBI</option>
                                    </select>
                                    @error('organization') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="colleges">College *</label>
                                    <select id="colleges" name="colleges" required>
                                        <option value="">Select college</option>
                                        <option value="CTED" {{ old('colleges') == 'CTED' ? 'selected' : '' }}>CTED</option>
                                        <option value="CCJE" {{ old('colleges') == 'CCJE' ? 'selected' : '' }}>CCJE</option>
                                        <option value="CHM" {{ old('colleges') == 'CHM' ? 'selected' : '' }}>CHM</option>
                                        <option value="CFAS" {{ old('colleges') == 'CFAS' ? 'selected' : '' }}>CFAS</option>
                                        <option value="CBEA" {{ old('colleges') == 'CBEA' ? 'selected' : '' }}>CBEA</option>
                                        <option value="CIT" {{ old('colleges') == 'CIT' ? 'selected' : '' }}>CIT</option>
                                        <option value="CICS" {{ old('colleges') == 'CICS' ? 'selected' : '' }}>CICS</option>
                                    </select>
                                    @error('colleges') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date">Activity Date *</label>
                                    <input type="date" id="date" name="date" required value="{{ old('date') }}">
                                    @error('date') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="venue">Venue *</label>
                                <input type="text" id="venue" name="venue" required placeholder="Enter venue location" value="{{ old('venue') }}">
                                @error('venue') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description *</label>
                                <textarea id="description" name="description" required placeholder="Describe the activity in detail..." rows="5">{{ old('description') }}</textarea>
                                @error('description') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Participants Section -->
                        <div class="form-section">
                            <h3 class="section-title">Participants & Impact</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="participants_count">Number of Participants *</label>
                                    <input type="number" id="participants_count" name="participants_count" required min="1" value="{{ old('participants_count') }}">
                                    @error('participants_count') <span class="error-msg">{{ $message }}</span> @enderror
                                </div>

                            </div>

                        </div>

                        <!-- Document Upload Section -->
                        <div class="form-section">
                            <h3 class="section-title">Supporting Documents</h3>
                            
                            <div class="form-group">
                                <label for="communication_letter">Communication Letter (PDF) *</label>
                                <input type="file" id="communication_letter" name="communication_letter" accept=".pdf" required>
                                <p class="help-text">Required format: PDF</p>
                                @error('communication_letter') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="narrative_report">Narrative Report (PDF) *</label>
                                <input type="file" id="narrative_report" name="narrative_report" accept=".pdf" required>
                                <p class="help-text">Required format: PDF</p>
                                @error('narrative_report') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group checkbox">
                                <input type="checkbox" id="verify" name="verify" required>
                                <label for="verify">I verify that the information provided is accurate and complete</label>
                                @error('verify') <span class="error-msg">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Modal Footer (Sticky) -->
                        <div class="form-actions">
                            <a href="{{ route('dashboard') }}" class="btn-secondary">Cancel</a>
                            <button type="submit" class="btn-primary">Submit Activity Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Prevent body scroll when modal is open
        document.body.classList.add('modal-open');
        
        // Optional: Add keyboard shortcut to close modal (Escape key)
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                window.location.href = '{{ route('dashboard') }}';
            }
        });
    </script>
</x-app-layout>
