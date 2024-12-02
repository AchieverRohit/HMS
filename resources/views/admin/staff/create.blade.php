@extends('layouts.admin')

@section('title', 'Add Staff')


@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Add Staff</h4>
                                <a href="{{ route('admin.staff') }}" class="btn btn-sm btn-primary">
                                    <- Back </a>
                            </div>
                            <form id="addstaffForm" action="{{ route('admin.staff.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="FirstName" class="form-label">First Name<span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="FirstName" name="FirstName" class="form-control"
                                                placeholder="First Name (Hitesh)" value="{{ old('FirstName') }}"
                                                oninput="clearError()">
                                            @error('FirstName')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="LastName" class="form-label">Last Name<span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="LastName" name="LastName" class="form-control"
                                                value="{{ old('LastName') }}" placeholder="Last Name (Ahire)">
                                            @error('LastName')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Row 2: Email and Phone -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="Email" id="Email" name="Email" class="form-control"
                                                value="{{ old('Email') }}" placeholder="Email (hitesh@gmail.com)">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Mobile" class="form-label">Phone<span
                                                    style="color: red;">*</span></label>
                                            <input type="number" id="Mobile" name="Mobile" class="form-control"
                                                placeholder="Mobile No. (8888888888)" value="{{ old('Mobile') }}">
                                            @error('Mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Row 3: Roles -->
                                    <div class="row  mt-2">
                                        <div class="col-md-6">
                                            <label for="RoleId" class="form-label">Role<span
                                                    style="color: red;">*</span></label>
                                            <select id="RoleId" name="RoleId" class="form-select">
                                                <option value="">Select Role</option>
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


                                    <!-- Submit & Reset Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button id="resetButton" type="button" class="btn btn-secondary">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Add
                                                Staff</button>
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
    <script>
        document.getElementById('resetButton').addEventListener('click', function(e) {
            e.preventDefault();
            const form = document.getElementById('addstaffForm');
            form.reset();
        });
    </script>
    <script>
        const inputFields = document.querySelectorAll('#FirstName, #LastName, #Mobile');
        inputFields.forEach(function(input) {
            input.addEventListener('input', function() {
                let errorElement = input.closest('.col-md-6').querySelector('.text-danger');
                if (errorElement) {
                    errorElement.remove();
                }
            });
        });
    </script>

@endsection
