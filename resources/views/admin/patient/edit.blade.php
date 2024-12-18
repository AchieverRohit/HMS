@extends('layouts.admin')

@section('title', 'Edit Patient')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Patient Table</h4>
                                <a href="{{ route('admin.patient') }}" class="btn btn-sm btn-primary">
                                    <- Back
                                </a>
                            </div>
                            <form id="editPatientForm" action="{{ route('admin.patient.update', $patient->Id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="container">
                                    <!-- Patient Fields -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="PatientNo" class="form-label">Patient No</label>
                                            <input type="text" id="PatientNo" name="PatientNo" class="form-control"
                                                value="{{ $patient->PatientNo }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="FirstName" class="form-label">First Name</label>
                                            <input type="text" id="FirstName" name="FirstName" class="form-control"
                                                value="{{ $patient->FirstName }}">
                                                @error('FirstName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="LastName" class="form-label">Last Name</label>
                                            <input type="text" id="LastName" name="LastName" class="form-control"
                                                value="{{ $patient->LastName }}">
                                                @error('LastName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="email" id="Email" name="Email" class="form-control"
                                                value="{{ $patient->Email }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="MobileNo" class="form-label">Phone</label>
                                            <input type="number" id="MobileNo" name="MobileNo" class="form-control"
                                                value="{{ $patient->MobileNo }}">
                                                @error('MobileNo')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for="Age" class="form-label">Age</label>
                                            <input type="number" id="Age" name="Age" class="form-control"
                                                value="{{ $patient->Age }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Dob" class="form-label">Date of Birth</label>
                                            <input type="date" id="Dob" name="Dob" class="form-control"
                                                value="{{ $patient->Dob }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Address" class="form-label">Address</label>
                                            <textarea id="Address" name="Address" class="form-control">{{ $patient->Address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for="Gender" class="form-label">Gender</label>
                                            <select id="Gender" name="Gender" class="form-control">
                                                <option value="" disabled>Select Gender</option>
                                                <option value="Male" {{ $patient->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $patient->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ $patient->Gender == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="BloodGroup" class="form-label">Blood Group</label>
                                            <input type="text" id="BloodGroup" name="BloodGroup" class="form-control"
                                                value="{{ $patient->BloodGroup }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Pin" class="form-label">Pin</label>
                                            <input type="text" id="Pin" name="Pin" class="form-control"
                                                value="{{ $patient->Pin }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="City" class="form-label">City</label>
                                            <input type="text" id="City" name="City" class="form-control"
                                                value="{{ $patient->City }}">
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button type="reset" class="btn btn-secondary" id="resetButton">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Update Patient</button>
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
