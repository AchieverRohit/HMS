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
                            <form action="{{ route('admin.appointment.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="AppointmentTokenNo" class="form-label">Appointment Token No</label>
                                            <input type="number" id="AppointmentTokenNo" name="AppointmentTokenNo"
                                                class="form-control" placeholder="AppointmentTokenNo (7)" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="DateTime" class="form-label">Date and Time</label>
                                            <input type="datetime-local" id="DateTime" name="DateTime" class="form-control"
                                                placeholder="Date Time " required>
                                        </div>
                                    </div>

                                    <!-- Row 2: Email and Phone -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Doctor" class="form-label">Select Doctor</label>
                                            <select id="Doctor" name="DoctorId" class="form-control" required>
                                                <option value="" disabled selected>Select a Doctor</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->Id }}">{{ $doctor->Designation }}
                                                        {{ $doctor->Qualification }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Duration" class="form-label">Duration ( min.)</label>
                                            <input type="number" id="Duration" name="Duration" class="form-control"
                                                placeholder="30 min" required>
                                        </div>
                                    </div>

                                    <!-- Row 3: Address and Date of Birth -->
                                    <div class="row  mt-2">
                                        <div class="col-md-6">
                                            <label for="Service" class="form-label">Select Service</label>
                                            <select id="Service" name="ServiceId" class="form-control" required>
                                                <option value="" disabled selected>Select a Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ReffernceBy" class="form-label">Reffernce By</label>
                                            <input type="text" id="ReffernceBy" name="ReffernceBy" class="form-control"
                                                placeholder="Reffernce By">
                                        </div>
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
