@extends('layouts.admin')

@section('title', 'Add Diagnosis')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Add Diagnosis</h4>
                                <a href="{{ route('admin.diagnosis') }}" class="btn btn-sm btn-primary">
                                     <-  Back
                                </a>
                            </div>
                            <form id="addPatientForm" action="{{ route('admin.diagnosis.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="DiagnosisName" class="form-label">Diagnosis Name<span style="color: red;">*</span></label>
                                            <input type="text" id="DiagnosisName" name="DiagnosisName" class="form-control"
                                                placeholder="Enter the diagnosis" value="{{ old('DiagnosisName') }}" oninput="clearError()">
                                                @error('DiagnosisName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Duration" class="form-label">Duration</label>
                                            <input type="text" id="Duration" name="Duration" class="form-control" value="{{ old('Duration') }}"
                                                placeholder="Enter the Duration">
                                        </div>
                                    </div>
                                    <!-- Submit & Reset Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button id="resetButton" type="button" class="btn btn-secondary">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Add
                                                Diagnosis</button>
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
    <script>
        document.getElementById('resetButton').addEventListener('click', function(e) {
            e.preventDefault();
            const form = document.getElementById('addPatientForm');
            form.reset();
        });
    </script>
    <script>
        const inputFields = document.querySelectorAll('#DiagnosisName');
        inputFields.forEach(function(input) {
            input.addEventListener('input', function() {
                let errorElement = input.closest('.col-md-6').querySelector('.text-danger');
                if (errorElement) {
                    errorElement.remove();
                }
            });
        });
    </script>

@endsection
