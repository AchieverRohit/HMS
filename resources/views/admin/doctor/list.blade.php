@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="main-panel">
    <div class="ml-2 mr-2 content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Doctor Table</h4>
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
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                    <td class="py-1">
                                        @if ($patient->picture)
                                            <img src="{{  asset('storage/' . $patient->picture) }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">
                                        @else
                                            <img src="{{ asset('path/to/default/profile.png') }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">
                                        @endif
                                    </td>
                                        <td>{{ $patient->FirstName }} {{ $patient->LastName }} {{$patient->id}}</td>
                                        <td>{{ $patient->email }}</td>
                                        <td>
                                            <span class="badge
                                                @if ($patient->role === 'Admin') badge-primary
                                                @elseif ($patient->role === 'Editor') badge-secondary
                                                @elseif ($patient->role === 'Viewer') badge-success
                                                @else badge-info
                                                @endif">
                                                {{ $patient->role }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($patient->created_at)->toDateString() }}</td>
                                        <td>
                                            <div class="d-inline-flex align-items-center">
                                                <!-- Edit Button -->
                                
                                                <a href="{{ route('admin.patient.edit', ['id' => $patient->Id]) }}" class="btn btn-sm btn-outline-secondary edit-user mr-1 mb-2" >
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <!-- admin.patient.edit -->

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.patient.destroy', $patient->Id) }}" method="POST" class="delete-form mt-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
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