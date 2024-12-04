@extends('layouts.admin')

@section('title', 'Diagnosis List')

@section('content')

    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <!-- Title -->
                                <h4 class="card-title mb-2 mb-md-0">Diagnosis Table</h4>
                                <!-- Search Form -->
                                <form action="{{ route('admin.role') }}" method="GET"
                                    class="form-inline d-flex flex-wrap mb-2 mb-md-0">
                                    <input type="text" name="search"
                                        class="form-control form-control-sm mr-2 mb-2 mb-sm-0" placeholder="Search"
                                        value="{{ old('search', $search ?? '') }}">
                                    <button type="submit" class="btn btn-sm btn-primary mb-2 mb-sm-0">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('admin.role') }}"
                                        class="btn btn-sm btn-secondary ml-sm-2 mb-2 mb-sm-0">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </form>
                                <!-- Add User Button -->
                                <a href="{{ route('admin.diagnosis.add') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user-plus"></i> Add Diagnosis
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Diagnosis Name</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diagnosis as $digno)
                                            <tr>
                                                <td>{{ $digno->DiagnosisName }}</td>
                                                <td>{{ $digno->Duration }}</td>
                                                <td>
                                                    <a href="{{ route('admin.diagnosis.edit', $digno->Id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                        </svg>
                                                    </a>
                                                    <form id="delete-form-{{ $digno->Id }}" 
                                                        action="{{ route('admin.diagnosis.destroy', $digno->Id) }}" 
                                                        method="POST" 
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $digno->Id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $diagnosis->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    <script>
    function confirmDelete(diagnosisID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you realy want to delete patient",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                document.getElementById('delete-form-' + diagnosisID).submit();
            }
        });
    }
</script>
<script>
    // Auto close success alert after 5 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
            successAlert.style.display = 'none';
        }

        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.classList.remove('show');
            errorAlert.style.display = 'none';
        }
    }, 5000);
</script>
