@extends('admin.admin_dashboard')
@section('content')
 <!-- Plugin css for this page -->
 <link rel="stylesheet" href="{{ asset('assets') }}/vendors/fullcalendar/main.min.css">
 <!-- End plugin css for this page -->

 <!-- Layout styles -->
 <link rel="stylesheet" href="{{ asset('assets') }}/css/demo2/style.css">
 <!-- End layout styles -->

 <!-- Flatpickr CSS -->
 <link rel="stylesheet" href="{{ asset('assets') }}/vendors/flatpickr/flatpickr.min.css">

 <!-- Bootstrap Icons CSS -->
 <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

 <!-- Izitoast CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 <!-- Additional CSS -->
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
                            <form>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Customer Name</h6>
                                    <input type="text" class="form-control" id="formGroupExampleInput">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Start Date</h6>
                                    <input type="text" class="form-control" id="formGroupExampleInput2">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">End Date</h6>
                                    <input type="text" class="form-control" id="formGroupExampleInput2">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Number of Days</h6>
                                    <input type="text" class="form-control" id="formGroupExampleInput2">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Number of Adults</h6>
                                    <input type="text" class="form-control" id="formGroupExampleInput2">
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-muted">Number of Children</h6>
                                    <input type="text" class="form-control" id="formGroupExampleInput2">
                                </div>
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


<!-- Core JS -->
<script src="{{ asset('assets') }}/vendors/core/core.js"></script>
<!-- End Core JS -->

<!-- Plugin JS for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets') }}/vendors/moment/moment.min.js"></script>
<script src="{{ asset('assets') }}/vendors/fullcalendar/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets') }}/vendors/flatpickr/flatpickr.min.js"></script>
<!-- End Plugin JS -->

<!-- Custom JS for this page -->
<script src="{{ asset('assets') }}/js/fullcalendar.js"></script>
<script src="{{ asset('assets') }}/js/flatpickr.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
            const modal = $('#modal-action');
            const csrfToken = $('meta[name=csrf_token]').attr('content');
            var calendarEl = document.getElementById('fullcalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: `{{ route('admin.reservation.list') }}`,
            editable: true,
            dateClick: function (info) {
                const {event} = info
                $.ajax({
                    url: `{{ route('reservation.create') }}`,
                    data: {
                        check_in_date: info.dateStr,
                        check_out_date: info.dateStr
                    },
                    success: function (res) {
                        modal.html(res);
                        modal.modal('show');
                        $('.flatpickr').flatpickr({
                            dateFormat: "Y-m-d",
                            enableTime: true,
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
                                success: function (res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                    iziToast.success({
                                        title: 'Success',
                                        message: res.message,
                                        position: 'topRight'
                                    });
                                },
                                error: function (res) {
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
