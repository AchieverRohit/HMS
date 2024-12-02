@extends('layouts.admin')

@section('title', 'Add Hospital')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Add Hospital</h4>
                                <a href="{{ route('admin.hospital') }}" class="btn btn-sm btn-primary">
                                    <- Back </a>
                            </div>
                            <form id="addHospitalForm" action="{{ route('admin.hospital.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <!-- Row 1: First Name and Last Name -->
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="Name" class="form-label">Hospital Name<span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="Name" name="Name" class="form-control"
                                                placeholder=" Name (Hitesh)" value="{{ old('Name') }}"
                                                oninput="clearError()">
                                            @error('Name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Row 2: Email and Phone -->
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="Address" class="form-label">Address</label>
                                            <input type="text" id="Address" name="Address" class="form-control"
                                                value="{{ old('Address') }}" placeholder="Address (Indira Nagar)">
                                        </div>
                                    </div>

                                    <!-- Row 3: Address and Date of Birth -->
                                    <div class="row  mt-2">
                                        <div class="col-md-3 ">

                                            <label for="IsActive" class="form-label">Active</label>
                                            <input type="checkbox" id="IsActive" name="IsActive"
                                                class="form-check-input ml-1" value="1" {{ old('IsActive') }}>


                                        </div>

                                    </div>
                                    <!-- Submit & Reset Button -->
                                    <div class="row mt-4  ml-5">
                                        <div class="col-md-12  ml-5">
                                            <button id="resetButton" type="button" class="btn btn-secondary  ml-5">
                                                Reset</button>
                                            <button type="submit" class="btn btn-primary">Add
                                                Hospital</button>
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
            const form = document.getElementById('addHospitalForm');
            form.reset();
        });
    </script>
    <script>
        const inputFields = document.querySelectorAll('#Name');
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
