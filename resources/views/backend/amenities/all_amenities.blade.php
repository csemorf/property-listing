@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a class="btn btn-inverse-info" href="{{ route('add.amenities') }}">Add Amenities</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Table</h6>
                        <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official
                                DataTables Documentation </a>for a full list of instructions and other options.</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Amenities</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->amenities_name }}</td>
                                            <td>
                                                <a href="{{ route('edit.amenities', $item->id) }}"
                                                    class="btn btn-inverse-warning">Edit</a>
                                                <a href="{{ route('delete.amenities', $item->id) }}"
                                                    class="btn btn-inverse-danger" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Plugin js for this page -->
@endsection
