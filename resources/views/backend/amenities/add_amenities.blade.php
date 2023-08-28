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

                        <h6 class="card-title">Add Amenities</h6>

                        <form id="myForm" method="POST" action="{{ route('store.amenities') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3 form-group">
                                <label for="amenities_name" class="form-label">Amenities name</label>
                                <input type="text" class="form-control" placeholder="Amenities name"
                                    name="amenities_name">

                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save Change</button>
                    </div>
                </div>
                <!-- middle wrapper end -->
                <!-- right wrapper start -->

                <!-- right wrapper end -->
            </div>

        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#myForm').validate({
                    rules: {
                        amenities_name: {
                            required: true,
                        },

                    },
                    messages: {
                        amenities_name: {
                            required: 'Please Enter Amenities',
                        },


                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        </script>
    @endsection()
