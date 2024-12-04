@extends('layouts.admin')

@section('title', 'Edit Hospital')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Hospital Table</h4>
                                <a href="{{ route('admin.hospital') }}" class="btn btn-sm btn-primary">
                                    <- Back </a>
                            </div>
                            <form id="editHospitalForm" action="{{ route('admin.hospital.update', $hospital->Id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="container">

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Name" class="form-label">Hospital Name</label>
                                            <input type="text" id="Name" name="Name" class="form-control"
                                                value="{{ $hospital->Name }}">
                                            @error('Name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="Address" class="form-label">Address</label>
                                            <textarea id="Address" name="Address" class="form-control">{{ $hospital->Address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">

                                        <div class="col-md-3">
                                            <label for="IsActive" class="form-label">Active</label>
                                            <input type="checkbox" id="IsActive" name="IsActive"
                                                class="form-check-input ml-1" value="1"
                                                {{ old('IsActive', $hospital->IsActive) ? 'checked' : '' }}>
                                            @error('IsActive')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <!-- Buttons -->
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button type="reset" class="btn btn-secondary" id="resetButton">
                                            Reset</button>
                                        <button type="submit" class="btn btn-primary">Update Hospital</button>
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
            const form = document.getElementById('editHospitalForm');
            form.reset(); // Reset all form fields to their initial state (empty)
            // Manually clear select and textarea values
            // form.querySelectorAll('textarea, select').forEach(function(field) {
            //     field.value = '';
            // });
        });
    </script>
@endsection
