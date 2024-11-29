@extends('layouts.admin')

@section('title', 'Add Patient')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">Add Patient</h4>
                            <form action="{{ route('admin.patient.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="FirstName" class="form-label">First Name</label>
                                            <input type="text" id="FirstName" name="FirstName" class="form-control"
                                                placeholder="First Name (Hitesh)" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="LastName" class="form-label">Last Name</label>
                                            <input type="text" id="LastName" name="LastName" class="form-control"
                                                placeholder="Last Name (Ahire)" required>
                                        </div>
                                    </div>

                                    <!-- Row 2: Email and Phone -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="Email" id="Email" name="Email" class="form-control"
                                                placeholder="Email (hitesh@gmail.com)">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="MobileNo" class="form-label">Phone</label>
                                            <input type="tel id="MobileNo" name="MobileNo" class="form-control"
                                                placeholder="Mobile No. (8888888888)" required>
                                        </div>
                                    </div>

                                    <!-- Row 3: Address and Date of Birth -->
                                    <div class="row  mt-2">
                                        <div class="col-md-3">
                                            <label for="Age" class="form-label">Age</label>
                                            <input type="text" id="Age" name="Age" class="form-control"
                                                placeholder="Age (24)">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Dob" class="form-label">Date of Birth</label>
                                            <input type="date" id="Dob" name="Dob" class="form-control"
                                                placeholder="Dob (21-12-1998)">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Address" class="form-label">Address</label>
                                            <input type="text" id="Address" name="Address" class="form-control"
                                                placeholder="Address (Indira Nagar)" required>
                                        </div>

                                    </div>

                                    <!-- Row 4: Gender and File Upload -->
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select id="gender" name="gender" class="form-control" required>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="BloodGroup" class="form-label">Blood Group</label>
                                            <input type="text" id="BloodGroup" name="BloodGroup" class="form-control"
                                                placeholder="Blood Group (B+)">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Pin" class="form-label">Pin</label>
                                            <input type="text" id="Pin" name="Pin" class="form-control"
                                                placeholder="Pin (423202)">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="City" class="form-label">City</label>
                                            <input type="text" id="City" name="City" class="form-control"
                                                placeholder="City (Nashik)">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <h5>System Generated PatientNo {{ $PatientNo }}</h5>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="row">
                                        <div class="col-md-4 mt-3 offset-4">
                                            <button type="submit" class="btn btn-primary w-100">Add Patient</button>
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

@endsection
