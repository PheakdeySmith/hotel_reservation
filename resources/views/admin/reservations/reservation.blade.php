@extends('admin.admin_dashboard')
@section('content')
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendors/fullcalendar/main.min.css">
<!-- End plugin css for this page -->

<!-- Layout styles -->
<link rel="stylesheet" href="{{ asset('assets') }}/css/demo2/style.css">
<!-- End layout styles -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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


<!-- core:js -->
<script src="{{ asset('assets') }}/vendors/core/core.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets') }}/vendors/moment/moment.min.js"></script>
<script src="{{ asset('assets') }}/vendors/fullcalendar/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- End plugin js for this page -->

<!-- Custom js for this page -->
{{-- <script src="{{ asset('assets') }}/js/fullcalendar.js"></script> --}}
<!-- End custom js for this page -->
<!-- core:js -->
<!-- endinject -->

<script>
    const modal = $('#modal-action')
    const csrfToken = $('meta[name=csrf_token]').attr('content')

    document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('fullcalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,today,next",
                center: 'title',
                right: 'dayGridMonth'
            },
            events: `{{ route('admin.reservation.list') }}`,
            editable: true,
        });
        calendar.render();
    });
</script>
@endsection
