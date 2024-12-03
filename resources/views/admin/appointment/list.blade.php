@extends('layouts.admin')

@section('title', 'Appointments List')

@section('content')
<div class="main-panel">
    <div class="ml-2 mr-2 content-wrapper">
        <div class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Appointment
            </button>
            <!-- Modal -->
            <div class="modal fade @if($errors->any()) show @endif" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true" style="@if($errors->any()) display:block; @endif">
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="appointmentForm" action="{{ route('admin.appointment.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cancelModal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="FirstName" class="form-label">Name<span style="color: red;">*</span></label>
                                            <input type="text" id="FirstName" name="FirstName" class="form-control"
                                                placeholder="First Name (Hitesh)" value="{{ old('FirstName') }}">
                                            <div class="text-danger error-message">@error('FirstName'){{ $message }}@enderror</div>       
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="email" id="Email" name="Email" class="form-control"
                                                placeholder="Email (hitesh@gmail.com)" value="{{ old('Email') }}">
                                            <div class="text-danger error-message">@error('Email'){{ $message }}@enderror</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="MobileNo" class="form-label">Phone<span style="color: red;">*</span></label>
                                            <input type="number" id="MobileNo" name="MobileNo" class="form-control"
                                                placeholder="Mobile No. (8888888888)" value="{{ old('MobileNo') }}">
                                            <div class="text-danger error-message">@error('MobileNo'){{ $message }}@enderror</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="Age" class="form-label">Age</label>
                                            <input type="number" id="Age" name="Age" class="form-control"
                                                placeholder="Age (24)" value="{{ old('Age') }}">
                                            <div class="text-danger error-message">@error('Age'){{ $message }}@enderror</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Dob" class="form-label">Date of Birth</label>
                                            <input type="date" id="Dob" name="Dob" class="form-control"
                                                value="{{ old('Dob') }}">
                                            @error('Dob')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Gender" class="form-label">Gender</label>
                                            <select id="Gender" name="Gender" class="form-control">
                                                <option value="" disabled {{ old('Gender') == '' ? 'selected' : '' }}>
                                                    Select Gender
                                                </option>
                                                <option value="Male" {{ old('Gender') == 'Male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="Female" {{ old('Gender') == 'Female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                                <option value="Other" {{ old('Gender') == 'Other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            <div class="text-danger error-message">@error('Gender'){{ $message }}@enderror</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="BloodGroup" class="form-label">Blood Group</label>
                                            <input type="text" id="BloodGroup" name="BloodGroup" class="form-control"
                                                placeholder="Blood Group (B+)" value="{{ old('BloodGroup') }}">
                                            @error('BloodGroup')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Address" class="form-label">Address</label>
                                            <input type="text" id="Address" name="Address" class="form-control"
                                                placeholder="Address (Indira Nagar)" value="{{ old('Address') }}">
                                            @error('Address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Pin" class="form-label">Pin</label>
                                            <input type="number" id="Pin" name="Pin" class="form-control"
                                                placeholder="Pin (423202)" value="{{ old('Pin') }}">
                                            @error('Pin')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="ReferralBy" class="form-label">Referral By</label>
                                            <input type="text" id="ReferralBy" name="ReferralBy" class="form-control"
                                                placeholder="Dr. Bhamre" value="{{ old('ReferralBy') }}">
                                            @error('ReferralBy')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <h5>System Generated Patient No: {{ $PatientNo }}</h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelButton">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Patient</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-2">
                                    <h4 class="card-title mb-0">Appointments</h4>
                                </div>
                                <div class="col-md-8 ">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <form action="{{ route('admin.appointment') }}" method="GET"
                                                class="form-inline d-flex flex-wrap mb-2 mb-md-0">
                                                <input type="text" name="search"
                                                    class="form-control form-control-sm mr-2 mb-2 mb-sm-0"
                                                    placeholder="Search" value="{{ old('search', $search ?? '') }}">
                                                <button type="submit" class="btn btn-sm btn-primary mb-2 mb-sm-0">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                                <a href="{{ route('admin.appointment') }}"
                                                    class="btn btn-sm btn-secondary  mb-2 mb-sm-0">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </form>
                                        </div>
                                        <div class="col-md-5">
                                            <form id="filterForm" action="{{ route('admin.appointment') }}" method="GET">
                                                <div class="d-flex justify-content-between">
                                                    <label for="filter_date" class="form-label "><b>Date</b></label>
                                                    <input type="date" name="filter_date" id="filter_date"
                                                        class="form-control ml-3" value="{{ request('filter_date') }}"
                                                        oninput="document.getElementById('filterForm').submit()">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.appointment.add') }}" class="btn btn-sm btn-primary">
                                        Add Appointment
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>TokenNo</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Service</th>
                                            <th>Date Time</th>
                                            <th>Duration</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->AppointmentTokenNo }}</td>
                                                <td>{{ $appointment->patient->FirstName }}
                                                    {{ $appointment->patient->LastName }}</td>
                                                <td>{{ $appointment->doctor->FirstName }}
                                                    {{ $appointment->doctor->LastName }}</td>
                                                <td>{{ $appointment->service->ServiceName }}</td>
                                                <td>{{ $appointment->DateTime }}</td>
                                                <td>{{ $appointment->Duration }}</td>
                                                <td>
                                                    <a href="{{ route('admin.appointment.edit', $appointment->Id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                        </svg>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.appointment.destroy', $appointment->Id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Open modal if validation errors exist
        @if ($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        @endif

        // Reload the page on "Cancel" button click
        const cancelButtons = document.querySelectorAll('#cancelButton, .btn-close');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function () {
                location.reload(); // Reload the page
            });
        });
    });
</script>

    @endsection
