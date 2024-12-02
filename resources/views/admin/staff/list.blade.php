@extends('layouts.admin')

@section('title', 'Staffs List')

@section('content')

    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <!-- Title -->
                                <h4 class="card-title mb-2 mb-md-0">Staff Table</h4>
                                <!-- Search Form -->
                                <form action="{{ route('admin.staff') }}" method="GET"
                                    class="form-inline d-flex flex-wrap mb-2 mb-md-0">
                                    <input type="text" name="search"
                                        class="form-control form-control-sm mr-2 mb-2 mb-sm-0" placeholder="Search"
                                        value="{{ old('search', $search ?? '') }}">
                                    <button type="submit" class="btn btn-sm btn-primary mb-2 mb-sm-0">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('admin.staff') }}"
                                        class="btn btn-sm btn-secondary ml-sm-2 mb-2 mb-sm-0">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </form>
                                <!-- Add User Button -->
                                <a href="{{ route('admin.staff.add') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user-plus"></i> Add Staff
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffs as $staff)
                                            <tr>
                                                <td>{{ $staff->FirstName }} {{ $staff->LastName }}</td>
                                                <td>{{ $staff->Email }}</td>
                                                <td>{{ $staff->Mobile }}</td>
                                                <td>{{ $staff->Role->RoleName }}</td>
                                                <td>
                                                    <a href="{{ route('admin.staff.edit', $staff->Id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                        </svg>
                                                    </a>
                                                    @if ($staff->RoleId != 1)
                                                    <form action="{{ route('admin.staff.destroy', $staff->Id) }}"
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
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $staffs->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
