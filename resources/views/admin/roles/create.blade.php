@extends('layouts.admin')

@section('title', 'Add Role')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Add Role</h4>
                                <a href="{{ route('admin.role') }}" class="btn btn-sm btn-primary">
                                     <-  Back
                                </a>
                            </div>
                            <form id="addPatientForm" action="{{ route('admin.role.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="RoleName" class="form-label">Role<span style="color: red;">*</span></label>
                                            <input type="text" id="RoleName" name="RoleName" class="form-control"
                                                placeholder="Enter the role" value="{{ old('RoleName') }}" oninput="clearError()">
                                                @error('RoleName')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Description" class="form-label">Description</label>
                                            <input type="text" id="Description" name="Description" class="form-control" value="{{ old('Description') }}"
                                                placeholder="Enter the description">
                                        </div>
                                    </div>
                                    <!-- Submit & Reset Button -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button id="resetButton" type="button" class="btn btn-secondary">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Add
                                                Role</button>
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
            const form = document.getElementById('addPatientForm');
            form.reset();
        });
    </script>
    <script>
        const inputFields = document.querySelectorAll('#FirstName, #LastName, #MobileNo');
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
