@extends('layouts.admin')

@section('title', 'Patients List')

@section('content')

    <div class="container my-4">
        <!-- Doctor Header -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4">Dr. John Doe</h2>
                    <p class="text-muted">General Practitioner</p>
                </div>
                <div class="text-end">
                    <p class="text-muted">Contact: +1 (555) 123-4567</p>
                </div>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Patient Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="patient-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="patient-name" placeholder="Patient's name">
                    </div>
                    <div class="col-md-4">
                        <label for="patient-age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="patient-age" placeholder="Patient's age">
                    </div>
                    <div class="col-md-4">
                        <label for="patient-gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="patient-gender" placeholder="Patient's gender">
                    </div>
                </div>
            </div>
        </div>

        <!-- Complaints Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Complaints</h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" rows="3" placeholder="Enter patient's complaints"></textarea>
            </div>
        </div>

        <!-- Diagnosis Section with Table and Auto-suggestions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Diagnoses</h5>
            </div>
            <div class="card-body">
                <!-- Diagnosis Table -->
                <table class="table" id="diagnosis-table">
                    <thead>
                        <tr>
                            <th>Diagnosis Name</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="diagnosis-row">
                            <td>
                                <input type="text" name="diagnosis[0][DiagnosisName]"
                                    class="form-control diagnosis-input" placeholder="Start typing..." autocomplete="off">
                                <ul class="autocomplete-suggestions list-group" style="display:none;"></ul>
                            </td>
                            <td><input type="date" name="diagnosis[0][Date]" class="form-control"></td>
                            <td><input type="text" name="diagnosis[0][Duration]" class="form-control"></td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-primary" id="add-row">Add Row</button>
            </div>
        </div>


        <!-- Medicines Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Medicines</h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" rows="4" placeholder="Enter prescribed medicines"></textarea>
            </div>
        </div>

        <!-- Advice Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Advice</h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" rows="3" placeholder="Enter advice for the patient"></textarea>
            </div>
        </div>

        <!-- Tests Requested Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Tests Requested</h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" rows="3" placeholder="Enter requested tests"></textarea>
            </div>
        </div>

        <!-- Follow-up Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Follow-up</h5>
            </div>
            <div class="card-body">
                <label for="follow-up-date" class="form-label">Next Appointment</label>
                <input type="date" class="form-control" id="follow-up-date">
            </div>
        </div>

        <!-- Save Button -->
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary btn-lg">Save Prescription</button>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Add a new row to the diagnosis table
            $('#add-row').on('click', function() {
                var newRow = $('#diagnosis-table tbody tr:first').clone();
                newRow.find('input').val('');
                newRow.find('.autocomplete-suggestions').hide();
                newRow.appendTo('#diagnosis-table tbody');
            });

            // Remove a row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // Autocomplete for diagnosis name input
            $(document).on('input', '.diagnosis-input', function() {
                var input = $(this);
                var query = input.val();
                var suggestions = input.siblings('.autocomplete-suggestions');

                if (query.length > 1) {
                    // Fetch suggestions from the server
                    $.ajax({
                        url: '{{ route('diagnosis.suggestions') }}',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            suggestions.empty().show();
                            if (data.length) {
                                data.forEach(function(item) {
                                    var suggestionItem = $(
                                        '<li class="list-group-item"></li>');
                                    suggestionItem.text(item.DiagnosisName);
                                    suggestionItem.on('click', function() {
                                        input.val(item.DiagnosisName);
                                        suggestions.hide();
                                    });
                                    suggestions.append(suggestionItem);
                                });
                            } else {
                                suggestions.hide();
                            }
                        }
                    });
                } else {
                    suggestions.hide();
                }
            });
        });
    </script>
@endpush
