@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
            <!-- partial -->
<div class="main-panel">
<div class="ml-2 mr-2 content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Users Table</h4>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUserModal">
                            <i class="fas fa-user-plus"></i> Add User
                        </button>
                    </div>

                    <!-- Add User Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
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
                                                <!-- Add more options as needed -->
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
                    </div>

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
                                @foreach ($users as $user)
                                    <tr>
                                    <td class="py-1">
    @if ($user->picture)
        <img src="{{  asset('storage/' . $user->picture) }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">
    @else
        <img src="{{ asset('path/to/default/profile.png') }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">
    @endif
</td>

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge
                                                @if ($user->role === 'Admin') badge-primary
                                                @elseif ($user->role === 'Editor') badge-secondary
                                                @elseif ($user->role === 'Viewer') badge-success
                                                @else badge-info
                                                @endif">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->toDateString() }}</td>
                                        <td>
    <div class="d-inline-flex align-items-center">
        <!-- Edit Button -->
        <a href="#" class="btn btn-sm btn-outline-secondary edit-user mr-1 mb-2" data-toggle="modal" data-target="#editUserModal{{ $user->id }}" data-id="{{ $user->id }}">
            <i class="fas fa-pencil-alt"></i>
        </a>

        <!-- Delete Button -->
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form mt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="far fa-trash-alt"></i>
            </button>
        </form>
    </div>
</td>

                                    </tr>

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form id="editUserForm{{ $user->id }}" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <div class="form-group">
                                                            <label for="editUserName{{ $user->id }}">Name</label>
                                                            <input type="text" class="form-control" id="editUserName{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserEmail{{ $user->id }}">Email</label>
                                                            <input type="email" class="form-control" id="editUserEmail{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserRole{{ $user->id }}">Role</label>
                                                            <select class="form-control" id="editUserRole{{ $user->id }}" name="role" required>
                                                                <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                                                                <option value="Editor" {{ $user->role === 'Editor' ? 'selected' : '' }}>Editor</option>
                                                                <option value="Viewer" {{ $user->role === 'Viewer' ? 'selected' : '' }}>Viewer</option>
                                                                <!-- Add more options as needed -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editUserPicture{{ $user->id }}">Profile Picture</label>
                                                            <input type="file" class="form-control-file" id="editUserPicture{{ $user->id }}" name="picture">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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