@extends('layouts.admin')

@section('title', 'Patients List')

@section('content')

    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Patient Table</h4>
                                <a href="{{ route('admin.patient.add') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user-plus"></i> Add User
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>PatientId</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            <tr>
                                                <td>{{ $patient->PatientNo }}</td>
                                                <td>{{ $patient->FirstName }} {{ $patient->LastName }}</td>
                                                <td>{{ $patient->Email }}</td>
                                                <td>{{ $patient->MobileNo }}</td>
                                                <td>{{ $patient->Dob }}</td>
                                                <td>{{ $patient->Gender }}</td>
                                                <td>
                                                    <a href="{{ route('admin.patient.edit', $patient->Id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('admin.patient.destroy', $patient->Id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

    @endsection
