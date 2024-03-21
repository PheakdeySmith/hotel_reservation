@extends('admin.admin_dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Room Type</h4>
                <form action="{{ route('admin.roomtype.update', $room_types->id) }}" method="post" class="form-inline">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="roomTypeName" class="form-label">Room Type</label>
                            <input id="roomTypeName" class="form-control" name="roomtype_name" type="text" value="{{ $room_types->roomtype_name }}">
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Save">
                    <a href="{{ route('admin.roomtype.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
