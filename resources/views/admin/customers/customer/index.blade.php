@extends('admin.admin_dashboard')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customer Table</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Customer lists</h6>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <a href="{{ route('admin.customer.create') }}" class="btn btn-primary">New Customer</a>
                        </div>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <span class="mx-1"></span>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Code</th>
                                    <th>Sex</th>
                                    <th>Date of Birth</th>
                                    <th>Phone</th>
                                    <th>Passport Number</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $item)
                                    <tr>
                                        <td>{{ $item->customer_id }}</td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->customerType->customertype_name }}</td>
                                        <td>{{ $item->customer_code }}</td>
                                        <td>{{ $item->sex }}</td>
                                        <td>{{ $item->dob }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->passportnumber }}</td>
                                        <td>{{ $item->country }}</td>
                                        <td>
                                            <form action="{{ route('admin.customer.destroy', $item->customer_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <a class="btn btn-primary"
                                                    href="{{ route('admin.customer.edit', $item->customer_id) }}">Edit</a>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
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
    <!-- core:js -->
@endsection
