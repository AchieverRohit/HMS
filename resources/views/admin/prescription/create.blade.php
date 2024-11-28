@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Patient</h4>
                            <form action="{{ route('admin.patient.add') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12 d-flex justify-content-between gap-3">
                                            <div class="flex-grow-1">
                                                <label for="name1" class="form-label">Name 1</label>
                                                <input type="text" id="FirstName" name="FirstName" class="form-control" value="" required>
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <label for="email">Email</label>
                                                <input disabled type="email" id="email" name="email"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between gap-3">
                                            <div class="flex-grow-1">
                                                <label for="name1" class="form-label">Name 1</label>
                                                <input type="text" id="name1" name="name1" class="form-control" value="">
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <label for="email">Email</label>
                                                <input disabled type="email" id="email" name="email"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between gap-3">
                                            <div class="flex-grow-1">
                                                <label for="name1" class="form-label">Name 1</label>
                                                <input type="text" id="name1" name="name1" class="form-control" value="">
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <label for="email">Email</label>
                                                <input disabled type="email" id="email" name="email"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between gap-3">
                                            <div class="flex-grow-1">
                                                <label for="name1" class="form-label">Name 1</label>
                                                <input type="text" id="name1" name="name1" class="form-control" value="">
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <label for="email">Email</label>
                                                <input disabled type="email" id="email" name="email"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea id="bio" name="bio"
                                        class="form-control">hvdfbjdfvbj,</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Profile Picture</label>
                                    <input type="file" id="picture" name="picture"
                                        class="form-control-file">
                                </div>
                                <!-- Add more fields (image upload, etc.) as needed -->

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

    <!-- partial -->
</div>

@endsection 