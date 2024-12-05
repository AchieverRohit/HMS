@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Edit Appointment</h4>
                                <a href="{{ route('admin.appointment') }}" class="btn btn-sm btn-primary">
                                    <- Back</a>
                            </div>
                            <form id="editAppointmentForm"
                                action="{{ route('admin.appointment.update', $appointment->Id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Patient Details (Non-editable) -->
                                <div class="container">
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <label for="PatientNo" class="form-label">Patient No</label>
                                            <span class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                {{ $appointment->patient->PatientNo }}
                                            </span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="FirstName" class="form-label">First Name</label>
                                            <span class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                {{ $appointment->patient->FirstName }}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="LastName" class="form-label">Last Name</label>
                                            <span class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                {{ $appointment->patient->LastName }}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="MobileNo" class="form-label">Phone</label>
                                            <span class="form-control-plaintext bg-light text-muted px-2 rounded">
                                                {{ $appointment->patient->MobileNo }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Editable Fields -->
                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="DoctorId" class="form-label">Doctor</label>
                                            <select class="custom-select" id="DoctorId" name="DoctorId">
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->Id }}"
                                                        {{ $doctor->Id == $appointment->DoctorId ? 'selected' : '' }}>
                                                        Dr. {{ $doctor->FirstName }} {{ $doctor->LastName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ServiceId" class="form-label">Service</label>
                                            <select class="custom-select" id="ServiceId" name="ServiceId">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->Id }}"
                                                        {{ $service->Id == $appointment->ServiceId ? 'selected' : '' }}>
                                                        {{ $service->ServiceName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="StatusId" class="form-label">Status</label>
                                            <select class="custom-select" id="StatusId" name="StatusId">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->Id }}"
                                                        {{ $status->Id == $appointment->StatusId ? 'selected' : '' }}>
                                                        {{ $status->StatusName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Date, Time, and Refer By -->
                                    <div class="row mt-3">

                                        @php
                                            // Parse the stored DateTime value
                                            $dateTime = $appointment->DateTime
                                                ? \Carbon\Carbon::createFromFormat(
                                                    'Y-m-d H:i:s',
                                                    $appointment->DateTime,
                                                )
                                                : \Carbon\Carbon::now();

                                            // Extract Date, Hour, Minute, and AM/PM
                                            $date = $dateTime->format('Y-m-d'); // Extract Date
                                            $hour = $dateTime->format('g'); // Extract 12-hour format hour
                                            $minute = $dateTime->format('i'); // Extract minutes
                                            $ampm = $dateTime->format('A'); // Extract AM/PM
                                        @endphp

                                        <div class="col-md-4">
                                            <label for="Date" class="form-label">Date</label>
                                            <input type="date" name="Date" class="custom-select" id="Date"
                                                value="{{ $date }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="time" class="form-label">Time</label>
                                            <div class="input-group">
                                                <!-- Hour Dropdown -->
                                                <select class="custom-select" name="Hour" id="hour">
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ $i == $hour ? 'selected' : '' }}>
                                                            {{ sprintf('%02d', $i) }}
                                                        </option>
                                                    @endfor
                                                </select>

                                                <!-- Minute Dropdown -->
                                                <select class="custom-select" name="Minute" id="minute">
                                                    @for ($i = 0; $i < 60; $i++)
                                                        <option value="{{ sprintf('%02d', $i) }}"
                                                            {{ $i == $minute ? 'selected' : '' }}>
                                                            {{ sprintf('%02d', $i) }}
                                                        </option>
                                                    @endfor
                                                </select>

                                                <!-- AM/PM Dropdown -->
                                                <select class="custom-select" name="AmPm" id="ampm">
                                                    <option value="AM" {{ $ampm == 'AM' ? 'selected' : '' }}>AM
                                                    </option>
                                                    <option value="PM" {{ $ampm == 'PM' ? 'selected' : '' }}>PM
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 ml-auto">
                                            <label for="Duration" class="form-label">Duration</label>
                                            <select class="custom-select" id="Duration" Name="Duration">
                                                <option value="10 min"
                                                    {{ $appointment->Duration == '10 min' ? 'selected' : '' }}>10 min
                                                </option>
                                                <option value="15 min"
                                                    {{ $appointment->Duration == '15 min' ? 'selected' : '' }}>15 min
                                                </option>
                                                <option value="20 min"
                                                    {{ $appointment->Duration == '20 min' ? 'selected' : '' }}>20 min
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="AppointmentTokenNo" class="form-label">TokenNo</label>
                                            <input type="text" name="AppointmentTokenNo" class="form-control"
                                                id="AppointmentTokenNo" value="{{ $appointment->AppointmentTokenNo }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="ReffernceBy" class="form-label">Refer By</label>
                                            <input type="text" name="ReffernceBy" class="form-control"
                                                id="ReffernceBy" value="{{ $appointment->ReffernceBy }}">
                                        </div>

                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <button type="submit" class="btn btn-primary">Update Appointment</button>
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
