@extends('admin.admin_dashboard')
@section('content')


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Room</h4>
                <form id="roomForm" class="form-inline" action="{{ route('admin.room.update', $rooms->room_id) }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="roomCode" class="form-label">Code ID</label>
                            <input id="roomCode" class="form-control" name="room_code" type="text" value="{{ $rooms->room_code }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="roomName" class="form-label">Name</label>
                            <input id="roomName" class="form-control" name="room_name" type="text" value="{{ $rooms->room_name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="roomPhone" class="form-label">Phone Number</label>
                            <input id="roomPhone" class="form-control" name="phone" type="tel" value="{{ $rooms->phone }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="roomType">Type</label>
                            <select id="roomType" class="form-control" name="roomtype_id">
                                @foreach ($room_types as $item)
                                    <option value="{{ $item->roomtype_id }}" {{ $rooms->roomtype_id == $item->roomtype_id ? 'selected' : '' }}>{{ $item->roomtype_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="roomDob">Date of Birth</label>
                            <div class="input-group flatpickr" id="flatpickr-dob">
                                <input type="text" class="form-control" id="roomDob" name="dob" value="{{ $rooms->dob }}">
                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="sex" id="genderMale" value="M" {{ $rooms->sex == 'M' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="sex" id="genderFemale" value="F" {{ $rooms->sex == 'F' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-8">
                            <label for="roomPassport">Passport Number</label>
                            <input type="text" class="form-control" id="roomPassport" name="passportnumber" value="{{ $rooms->passportnumber }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="roomCountry">Country</label>
                            <select id="roomCountry" class="form-control" name="country">
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
