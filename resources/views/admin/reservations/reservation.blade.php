@extends('admin.admin_dashboard')
@section('content')
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendors/fullcalendar/main.min.css">
<!-- End plugin css for this page -->

<!-- Layout styles -->
<link rel="stylesheet" href="{{ asset('assets') }}/css/demo2/style.css">
<!-- End layout styles -->

<!-- Additional CSS for datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('assets') }}/fonts/feather-font/css/iconfont.css">
<link rel="stylesheet" href="{{ asset('assets') }}/vendors/flag-icon-css/css/flag-icon.min.css">
<!-- endinject -->

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Reservation Form</h6>
                        <div id='external-events' class='external-events'>
                            <form id="form-action">
                                @csrf
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Customer Name</h6>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Start Date</h6>
                                    <input type="text" class="form-control datepicker" id="start_date" name="start_date">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">End Date</h6>
                                    <input type="text" class="form-control datepicker" id="end_date" name="end_date">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Number of Days</h6>
                                    <input type="text" class="form-control" id="number_of_days" name="number_of_days">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Number of Adults</h6>
                                    <input type="text" class="form-control" id="number_of_adults" name="number_of_adults">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Number of Children</h6>
                                    <input type="text" class="form-control" id="number_of_children" name="number_of_children">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id='fullcalendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-action" class="modal" tabindex="-1">

</div>

<!-- core:js -->
<script src="{{ asset('assets') }}/vendors/core/core.js"></script>
<!-- endinject -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- jQuery UI library -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<!-- Plugin js for this page -->
<script src="{{ asset('assets') }}/vendors/moment/moment.min.js"></script>
<script src="{{ asset('assets') }}/vendors/fullcalendar/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<!-- End plugin js for this page -->

<!-- Additional JS for datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script src="{{ asset('assets') }}/js/fullcalendar.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = $('#modal-action');
        const csrfToken = $('meta[name=csrf_token]').attr('content');
        var calendarEl = document.getElementById('fullcalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,today,next",
                center: 'title',
                right: 'dayGridMonth'
            },
            editable: true,
            events: "{{ route('reservation.list') }}",
            dateClick: function(info) {
                const { event } = info
                $.ajax({
                    url: "{{ route('reservation.create') }}",
                    data: {
                        check_in_date: info.dateStr,
                        check_out_date: info.dateStr
                    },
                    success: function(res) {
                        modal.html(res);
                        modal.modal('show');
                        $('.datepicker').datepicker({
                            format: 'yyyy-mm-dd',
                            autoclose: true,
                        });

                        $('#form-action').on('submit', function(e) {
                            e.preventDefault()
                            const form = this
                            const formData = new FormData(form)

                            // Check if check_out_date is behind check_in_date
                            if (formData.get('check_out_date') < formData.get('check_in_date')) {
                                formData.set('check_out_date', formData.get('check_in_date'));
                            }
                            $.ajax({
                                url: form.action,
                                method: form.method,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                    iziToast.success({
                                        title: 'Success',
                                        message: res.message,
                                        position: 'topRight'
                                    });
                                },
                                error: function(res) {
                                    const message = res.responseJSON.message
                                    info.revert()
                                    iziToast.error({
                                        title: 'Error',
                                        message: message ?? 'Something wrong',
                                        position: 'topRight'
                                    });
                                }
                            })
                        })
                    }
                })
            },
            eventClick: function ({event}) {
                $.ajax({
                    url: `{{ url('reservation') }}/${event.id}/edit`,
                    success: function (res) {
                        modal.html(res);
                        modal.modal('show');

                        $('#form-action').on('submit', function(e) {
                            e.preventDefault()
                            const form = this
                            const formData = new FormData(form)
                            $.ajax({
                                url: form.action,
                                method: form.method,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                }
                            })
                        })
                    }
                })
            },
        });
        // Ensure modal is properly initialized
        modal.modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
        calendar.render();
    });
</script>
@endsection
