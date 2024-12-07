@extends('layouts.admin')

@section('title', 'Appointments List')

@section('content')
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <form id="searchPatientForm" class="col-md-11" action="{{ route('admin.patient') }}"
                                    method="GET" autocomplete="off">
                                    <div class="position-relative">
                                        <input type="text" name="search_patient" id="search_patient" class="form-control"
                                            placeholder="Search by Patient ID, First Name, Last Name, or Mobile Number"
                                            value="{{ request('search_patient') }}" oninput="filterSuggestions()" />
                                        <ul id="suggestions" class="list-group position-absolute w-100"
                                            style="z-index: 1000; display: none;">
                                            <!-- Suggestions will appear here -->
                                        </ul>
                                    </div>
                                </form>
                                <div class="col-md-1 mt-1">
                                    <a href="{{ route('admin.appointment.add-patient') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
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
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>TokenNo</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Service</th>
                                            <th>Status</th>
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
                                                <td>{{ $appointment->status->StatusName }}</td>
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
                                                    <a href="{{ route('admin.prescription.add', $appointment->Id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-user-plus"></i>
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
    </div>
    <script>
        const patients = @json($patients->toArray());
        console.log(patients);
        const filterSuggestions = () => {
            const query = document.getElementById("search_patient").value.toLowerCase();
            const suggestionsList = document.getElementById("suggestions");
            suggestionsList.innerHTML = ""; // Clear previous suggestions
            if (!query) {
                suggestionsList.style.display = "none";
                return;
            }

            try {
                const matches = patients.filter((patient) => {
                    const patientNo = patient.PatientNo ? patient.PatientNo.toString() : "";
                    const firstName = patient.FirstName ? patient.FirstName.toLowerCase() : "";
                    const lastName = patient.LastName ? patient.LastName.toLowerCase() : "";
                    const mobileNo = patient.MobileNo ? patient.MobileNo.toString() : "";
                    return (
                        patientNo.includes(query) ||
                        firstName.includes(query) ||
                        lastName.includes(query) ||
                        mobileNo.includes(query)
                    );
                });

                if (matches.length > 0) {
                    matches.forEach((patient) => {
                        const li = document.createElement("li");
                        li.className = "list-group-item list-group-item-action";
                        li.textContent = `${patient.FirstName || ""} ${patient.LastName || ""} - ${
                           patient.MobileNo || "N/A"
                       } (ID: ${patient.PatientNo || "N/A"})`;
                        li.style.cursor = "pointer";
                        // Modify this onclick to redirect to the desired URL
                        li.onclick = () => {
                            const patientId = patient.Id || "";
                            const url =
                                `/admin/appointment/${patientId}/add`; // Build the URL with patient ID
                            window.location.href = url; // Redirect to the URL
                        };

                        suggestionsList.appendChild(li);
                    });

                    suggestionsList.style.display = "block";
                } else {
                    suggestionsList.style.display = "none";
                }
            } catch (error) {
                console.error("Error filtering suggestions:", error);
            }
        };
    </script>

@endsection
