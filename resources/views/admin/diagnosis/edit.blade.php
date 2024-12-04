@extends('layouts.admin')

@section('title', 'Edit Diagnosis')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Diagnosis Table</h4>
                                <a href="{{ route('admin.diagnosis') }}" class="btn btn-sm btn-primary">
                                    <- Back
                                </a>
                            </div>
                            <form id="editDiagnosisForm" action="{{ route('admin.diagnosis.update', $diagnosis->Id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="container">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="DiagnosisName" class="form-label">Diagnosis Name</label>
                                            <input type="text" id="DiagnosisName" name="DiagnosisName" class="form-control"
                                                value="{{ $diagnosis->DiagnosisName }}">
                                                @error('DiagnosisName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Duration" class="form-label">Duration</label>
                                            <input type="text" id="Duration" name="Duration" class="form-control"
                                                value="{{ $diagnosis->Duration }}">
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button type="reset" class="btn btn-secondary" id="resetButton">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Update Diagnosis</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Force Reset -->
    <script>
        document.getElementById('resetButton').addEventListener('click', function(e) {
            e.preventDefault();  // Prevent the default reset behavior
            const form = document.getElementById('editPatientForm');
            form.reset();  // Reset all form fields to their initial state (empty)
            // Manually clear select and textarea values
            // form.querySelectorAll('textarea, select').forEach(function(field) {
            //     field.value = '';
            // });
        });
    </script>
@endsection
