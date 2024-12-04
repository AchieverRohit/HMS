@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Staff Table</h4>
                                <a href="{{ route('admin.staff') }}" class="btn btn-sm btn-primary">
                                    <- Back </a>
                            </div>
                            <form id="editStaffForm" action="{{ route('admin.staff.update', $staff->Id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="container">

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="FirstName" class="form-label">First Name</label>
                                            <input type="text" id="FirstName" name="FirstName" class="form-control"
                                                value="{{ $staff->FirstName }}">
                                            @error('FirstName')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="LastName" class="form-label">Last Name</label>
                                            <input type="text" id="LastName" name="LastName" class="form-control"
                                                value="{{ $staff->LastName }}">
                                            @error('LastName')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="email" id="Email" name="Email" class="form-control"
                                                value="{{ $staff->Email }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Mobile" class="form-label">Phone</label>
                                            <input type="number" id="Mobile" name="Mobile" class="form-control"
                                                value="{{ $staff->Mobile }}">
                                            @error('Mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="RoleId" class="form-label">Role<span
                                                    style="color: red;">*</span></label>
                                            <select id="RoleId" name="RoleId" class="form-select">
                                                <option value="">{{ $staff->Role->RoleName }}</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->Id }}"
                                                        {{ old('RoleId') == $role->Id ? 'selected' : '' }}>
                                                        {{ $role->RoleName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('RoleId')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button type="reset" class="btn btn-secondary" id="resetButton">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Update Staff</button>
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
            e.preventDefault(); // Prevent the default reset behavior
            const form = document.getElementById('editStaffForm');
            form.reset(); // Reset all form fields to their initial state (empty)
            // Manually clear select and textarea values
            // form.querySelectorAll('textarea, select').forEach(function(field) {
            //     field.value = '';
            // });
        });
    </script>
@endsection
