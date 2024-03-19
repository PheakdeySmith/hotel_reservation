{{-- C:\laragon\www\hotel_reservation\resources\views\admin\reservations\reservation-form.blade.php --}}

<x-modal-action action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="form-label">Customers</label>
                <input type="text" name="customer_id" readonly value="{{ $data->customer_id ?? request()->customer_id }}" class="form-control">
            </div>
        </div>
        <div class="col-6">
            {{-- <div class="mb-3">
                <input type="text" name="check_in_date" readonly value="{{ $data->check_in_date ?? request()->check_in_date }}" class="form-control datepicker">
            </div> --}}
            <div class="input-group flatpickr mb-3" id="flatpickr-date">
                <input type="text" class="form-control" placeholder="Select date" data-input  value="{{ $data->check_in_date ?? request()->check_in_date }}">
                <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="check_out_date" readonly value="{{ $data->check_out_date ?? request()->check_out_date }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-2">
            <div class="mb-3">
                <label for="form-label">Days</label>
                <input type="text" name="number_of_days" readonly value="{{ $data->number_of_days ?? request()->number_of_days }}" class="form-control">
            </div>
        </div>
        <div class="col-5">
            <div class="mb-3">
                <label for="form-label">Adults</label>
                <input type="text" name="number_of_adults" readonly value="{{ $data->number_of_adults ?? request()->number_of_adults }}" class="form-control">
            </div>
        </div>
        <div class="col-5">
            <div class="mb-3">
                <label for="form-label">Children</label>
                <input type="text" name="number_of_children" readonly value="{{ $data->number_of_children ?? request()->number_of_children }}" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <textarea name="description" class="form-control">{{ $data->description }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'success' ? 'checked' : null }} type="radio" name="category" id="category-success" value="success">
                    <label class="form-check-label" for="category-success">Success</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'danger' ? 'checked' : null }} type="radio" name="category" id="category-danger" value="danger">
                    <label class="form-check-label" for="category-danger">Danger</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'warning' ? 'checked' : null }} type="radio" name="category" id="category-warning" value="warning">
                    <label class="form-check-label" for="category-warning">Warning</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'info' ? 'checked' : null }} type="radio" name="category" id="category-info" value="info">
                    <label class="form-check-label" for="category-info">Info</label>
                  </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                  </div>
            </div>
        </div>
    </div>
</x-modal-action>
