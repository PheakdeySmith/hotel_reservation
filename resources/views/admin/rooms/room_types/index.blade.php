@extends('admin.admin_dashboard')
@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Room Type Table</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Room Type lists</h6>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="{{ route('admin.roomtype.create') }}" class="btn btn-primary">New Room Type</a>
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
                                <th>Room Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($room_types as $item)
                                <tr>
                                    <td>{{ $item->roomtype_id }}</td>
                                    <td>{{ $item->roomtype_name }}</td>
                                    <td>
                                        <form action="{{ route('admin.roomtype.destroy', $item->roomtype_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-primary" href="{{ route('admin.roomtype.edit', $item->roomtype_id) }}">Edit</a>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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


@endsection
