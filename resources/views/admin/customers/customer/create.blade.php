@extends('admin.admin_dashboard')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New Customer</h4>
                <form id="customerForm" class="form-inline" action="{{ route('admin.customer.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="customerCode" class="form-label">Code ID</label>
                            <input id="customerCode" class="form-control" name="customer_code" type="text" value="CUST-">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="customerName" class="form-label">Name</label>
                            <input id="customerName" class="form-control" name="customer_name" type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="customerPhone" class="form-label">Phone Number</label>
                            <input id="customerPhone" class="form-control" name="phone" type="tel">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="customerType">Type</label>
                            <select id="customerType" class="form-control" name="customertype_id">
                                <option selected disabled value="">Choose...</option>
                                @foreach ($customerTypes as $item)
                                    <option value="{{ $item->customertype_id }}">{{ $item->customertype_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="customerDob">Date of Birth</label>
                            <div class="input-group flatpickr" id="flatpickr-dob">
                                <input type="text" class="form-control" id="customerDob" name="dob">
                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="sex" id="genderMale" value="M">
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="sex" id="genderFemale" value="F">
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-8">
                            <label for="customerPassport">Passport Number</label>
                            <input type="text" class="form-control" id="customerPassport" name="passportnumber">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="customerCountry">Country</label>
                            <select id="customerCountry" class="form-control" name="country">
                                <option selected disabled value="">Choose...</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Save" id="saveCustomer">
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

<script src="{{ asset('assets') }}/vendors/feather-icons/feather.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Initializing Flatpickr...');
        flatpickr("#customerDob", {
            dateFormat: "Y-m-d",
        });
        console.log('Flatpickr initialized.');
    });
</script>
@endsection
