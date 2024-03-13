@extends('admin.admin_dashboard')
@section('content')


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New Room</h4>
                <form id="roomForm" class="form-inline" action="{{ route('admin.room.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="room_number" class="form-label">Room Number</label>
                            <input id="room_number" class="form-control" name="room_number" type="text" value="RN-0">
                        </div>
                        <div class="col-md-6">
                            <label for="room_name" class="form-label">Room Name</label>
                            <input id="room_name" class="form-control" name="room_name" type="text">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12 mb-3">
                            <label for="roomtype_id" class="mb-2">Type</label>
                            <select id="roomtype_id" class="form-control" name="roomtype_id">
                                <option selected disabled value="">Choose...</option>
                                @foreach ($room_types as $item)
                                    <option value="{{ $item->roomtype_id }}">{{ $item->roomtype_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Save" id="saveroom">
                    <a href="{{ route('admin.room.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

