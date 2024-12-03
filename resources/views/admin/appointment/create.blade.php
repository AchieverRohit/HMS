@extends('layouts.admin')

@section('title', 'Add Appointment')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Add Appointment</h4>
                                <a href="{{ route('admin.appointment') }}" class="btn btn-sm btn-primary">
                                    <- Back </a>
                            </div>
                            <form id="addAppointmentForm" action="{{ route('admin.appointment.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="PatientName" class="form-label">Patient Name<span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="PatientName" name="PatientName" class="form-control"
                                                placeholder="Patient Name (Hitesh)" value="{{ old('PatientName') }}"
                                                oninput="clearError()">
                                            @error('PatientName')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="DateTime" class="form-label">DateTime</label>
                                            <input type="datetime" id="DateTime" name="DateTime" class="form-control"
                                                value="{{ old('DateTime') }}">
                                        </div>
                                    </div>

                                    <!-- Row 2: Email and Phone -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="DoctorName" class="form-label">Doctor Name<span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="DoctorName" name="DoctorName" class="form-control"
                                                value="{{ old('DoctorName') }}" placeholder="Doctor Name (Mayur)">
                                            @error('DoctorName')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Service" class="form-label">Service</label>
                                            <input type="Email" id="Email" name="Email" class="form-control"
                                                value="{{ old('Email') }}" placeholder="Email (hitesh@gmail.com)">
                                        </div>

                                    </div>

                                    <!-- Row 3: Address and Date of Birth -->
                                    <div class="row  mt-2">

                                        <div class="col-md-3">
                                            <label for="Dob" class="form-label">Date of Birth</label>
                                            <input type="date" id="Dob" name="Dob" class="form-control"
                                                value="{{ old('Dob') }}" placeholder="Dob (21-12-1998)">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Address" class="form-label">Address</label>
                                            <input type="text" id="Address" name="Address" class="form-control"
                                                value="{{ old('Address') }}" placeholder="Address (Indira Nagar)">
                                        </div>

                                    </div>

                                    <!-- Row 4: Gender and File Upload -->
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for="Gender" class="form-label">Gender</label>
                                            <select id="Gender" name="Gender" class="form-control"
                                                value="{{ old('Gender') }}">
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="BloodGroup" class="form-label">Blood Group</label>
                                            <input type="text" id="BloodGroup" name="BloodGroup" class="form-control"
                                                value="{{ old('BloodGroup') }}" placeholder="Blood Group (B+)">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Pin" class="form-label">Pin</label>
                                            <input type="number" id="Pin" name="Pin" class="form-control"
                                                value="{{ old('Pin') }}" placeholder="Pin (423202)">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="City" class="form-label">City</label>
                                            <input type="text" id="City" name="City" class="form-control"
                                                value="{{ old('City') }}" placeholder="City (Nashik)">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <h5>System Generated AppointmentNo {{ $AppointmentNo }}</h5>
                                    </div>
                                    <!-- Submit & Reset Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button id="resetButton" type="button" class="btn btn-secondary">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Add
                                                Appointment</button>
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
            const form = document.getElementById('addAppointmentForm');
            form.reset();
        });
    </script>
    <script>
        const inputFields = document.querySelectorAll('#FirstName, #LastName, #MobileNo');
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
