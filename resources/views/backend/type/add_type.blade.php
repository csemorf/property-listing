@extends('admin.admin_dashboard')
@section('admin')
    <img src="image.jpg" alt="Round Image" class="round-image">

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

    <div class="page-content">


        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add property Type</h6>

                        <form method="POST" action="{{ route('store.type') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="type_name" class="form-label">Type name</label>
                                <input type="text" class="form-control @error('type_name') is-invalid @enderror"
                                    placeholder="Type name" name="type_name" id="type_name">
                                @error('type_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type_icon" class="form-label">Type Icon</label>
                                <input type="text" class="form-control @error('type_icon') is-invalid @enderror"
                                    placeholder="Type name" name="type_icon" id="type_icon">
                                @error('type_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save Change</button>
                    </div>
                </div>
                <!-- middle wrapper end -->
                <!-- right wrapper start -->

                <!-- right wrapper end -->
            </div>

        </div>
    @endsection()
