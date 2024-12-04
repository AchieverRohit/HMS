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
                                <h4 class="card-title mb-0">Book Appointment</h4>
                                <a href="{{ route('admin.appointment') }}" class="btn btn-sm btn-primary">
                                    <- Back
                                </a>
                            </div>
                            <form id="editPatientForm" action="{{ route('admin.appointment.store', $patient->Id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="container">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-2 ml-auto">
                                                <label for="PatientNo" class="form-label">P. No</label>
                                                <span id="PatientNo" class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                    {{ $patient->PatientNo }}
                                                </span>
                                            </div>
                                            <div class="col-md-4 ml-auto">
                                                <label for="FirstName" class="form-label">First Name</label>
                                                <span id="FirstName" class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                    {{ $patient->FirstName }}
                                                </span>
                                            </div>
                                            <div class="col-md-3 ml-auto">
                                                <label for="LastName" class="form-label">Last Name</label>
                                                <span id="LastName" class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                    {{ $patient->LastName }}
                                                </span>
                                            </div>
                                            <div class="col-md-3 ml-auto">
                                                <label for="MobileNo" class="form-label">Phone</label>
                                                <span id="MobileNo" class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                    {{ $patient->MobileNo }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Patient Fields -->
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 ml-auto">
                                                <label for="Doctor" class="form-label">Doctor</label>
                                                <select class="custom-select" id="DoctorId" Name="DoctorId">
                                                    <option selected disabled value="">Choose...</option>
                                                    @foreach($doctors as $item)
                                                        <option value="{{ $item->Id }}">Dr. {{ $item->FirstName }} {{ $item->LastName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 ml-auto">
                                                <label for="Doctor" class="form-label">Service</label>
                                                <select class="custom-select" id="ServiceId" Name="ServiceId">
                                                    @foreach($service as $item)
                                                        <option value="{{ $item->Id }}">{{ $item->ServiceName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 ml-auto">
                                                <label for="Doctor" class="form-label">Status</label>
                                                <select class="custom-select" id="Status" Name="StatusId">
                                                    @foreach($status as $item)
                                                        <option value="{{ $item->Id }}">{{ $item->StatusName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 ml-auto">
                                                <label for="Doctor" class="form-label">Duration</label>
                                                <select class="custom-select" id="Duration" Name="Duration">
                                                  <option selected value="10 min">10 min</option>
                                                  <option value="15 min">15 min</option>
                                                  <option value="20 min">20 min</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 ml-auto">
                                                <label for="Date" class="form-label">Date</label>
                                                <input type="date" name="Date" class="form-control" id="Date" value="{{ \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d') }}">
                                            </div>
                                            @php
                                                date_default_timezone_set('Asia/Kolkata');
                                                $currentTime = date('H:i');
                                            @endphp
                                            <div class="col-md-4 ml-auto">
                                                <label for="time" class="form-label">Time</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="Hour" id="hour">
                                                        @for($i = 1; $i <= 12; $i++)
                                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                                        @endfor
                                                    </select>
                                                    <!-- <span>:</span> -->
                                                    <select class="form-control" name="Minute" id="minute">
                                                        @for($i = 0; $i < 60; $i += 1) 
                                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                                        @endfor
                                                    </select>
                                                    <select class="form-control" name="AmPm" id="ampm">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 ml-auto">
                                                <label for="ReferBy" class="form-label">Refer By</label>
                                                <input type="text" name="ReferBy" class="form-control" id="ReferBy">
                                            </div>
                                            <div class="col-md-4 ml-auto">

                                            </div>
                                            <div class="col-md-4 ml-auto">

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button type="reset" class="btn btn-secondary" id="resetButton">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Book Appointment</button>
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
            form.reset();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const now = new Date();
            let hours = now.getHours();
            const minutes = now.getMinutes();
            const ampm = hours >= 12 ? "PM" : "AM";

            // Convert to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; // If hour is 0, set to 12

            // Set the values in the dropdowns
            document.getElementById('hour').value = hours;
            document.getElementById('minute').value = minutes;
            document.getElementById('ampm').value = ampm;
        });
    </script>
@endsection
