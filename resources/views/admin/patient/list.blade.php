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
                            <!-- Add User Modal -->
                            <!-- <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="addUserForm" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="form-group">
                                                                                            <label for="userName">Name</label>
                                                                                            <input type="text" class="form-control" id="userName" name="name" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="userEmail">Email</label>
                                                                                            <input type="email" class="form-control" id="userEmail" name="email" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="userRole">Role</label>
                                                                                            <select class="form-control" id="userRole" name="role" required>
                                                                                                <option value="">Select Role</option>
                                                                                                <option value="Admin">Admin</option>
                                                                                                <option value="Editor">Editor</option>
                                                                                                <option value="Viewer">Viewer</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="userPicture">Profile Picture</label>
                                                                                            <input type="file" class="form-control-file" id="userPicture" name="picture">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary">Save User</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
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
