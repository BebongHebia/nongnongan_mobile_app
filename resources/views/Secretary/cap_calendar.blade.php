@extends('Secretary.sidebar')
@section('sidebar')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Calendar</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title">Add Calendar Activity</p>
                    </div>
                    <div class="card-body">

                        <button class="btn btn-primary" data-toggle="modal" data-target="#add_calendar_act_modal">
                            <i class="fas fa-plus"></i> Add Calendar
                        </button>

                        <div class="modal fade" id="add_calendar_act_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Calendar Activity</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="add_calendar_form">
                                            @csrf

                                            <label>Activity</label>
                                            <input type="text" name="activity" class="form-control">

                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control">

                                        </form>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick="add_cal_act(event)" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <div style="width:100%;" id="cap_calendar_container">

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-8">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->







<script>
    display_cal_act();
    display_calendar();

    function display_cal_act() {
        $.ajax({
            type: "GET"
            , url: `{{ url('/fetch-cal-act') }}`
            , success: function(data) {

                let rows = '';

                $.each(data, function(index, cal_act) {

                    var backColor;
                    var textColor;

                    if (cal_act.status == "Pending") {
                        backColor = 'red';
                        textColor = 'white';
                    } else if (cal_act.status == "Ongoing") {
                        backColor = 'yellow';
                        textColor = 'black';

                    } else if (cal_act.status == "Done") {
                        backColor = 'green';
                        textColor = 'white';
                    }

                    rows += `

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div style="width:100%; box-shadow:2px 2px 2px gray; border-radius:10px; padding:5px; background: ${backColor}; color:${textColor}">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <b>${cal_act.activity}</b>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn" data-toggle="modal" data-target="#edit_calendar_act_modal${cal_act.id}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <div class="modal fade" id="edit_calendar_act_modal${cal_act.id}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" style="color:black">Edit Calendar Activity</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="edit_calendar_form${cal_act.id}">
                                                                @csrf
                                                                <input type="hidden" name="cal_cat_id" class="form-control" value="${cal_act.id}">

                                                                <label style="color:black">Activity</label>
                                                                <input type="text" name="activity" class="form-control" value="${cal_act.activity}">

                                                                <label style="color:black">Date</label>
                                                                <input type="date" name="date" class="form-control" value="${cal_act.date}">

                                                                <label style="color:black">Change Status</label>
                                                                <select class="form-select select2" name="status">
                                                                    <option value="${cal_act.status}">${cal_act.status}</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Ongoing">Ongoing</option>
                                                                    <option value="Done">Done</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" onclick="edit_cal_act(event, ${cal_act.id})" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->


                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn" data-toggle="modal" data-target="#delete_calendar_act_modal${cal_act.id}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <div class="modal fade" id="delete_calendar_act_modal${cal_act.id}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" style="color:black">Delete Calendar Activity</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="delete_calendar_form${cal_act.id}">
                                                                @csrf
                                                                <input type="hidden" name="cal_cat_id" class="form-control" value="${cal_act.id}">

                                                                <h5 class="text-center" style="color:black">Are you sure you want to delete calendar activity</h5>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" onclick="delete_cal_act(event, ${cal_act.id})" class="btn btn-danger">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    `;
                });

                $('#cap_calendar_container').html(rows);
                $('.select2').select2();
            }
        });
    }

    function delete_cal_act(event, cal_act_id) {
        event.preventDefault();

        $.ajax({
            type: "POST"
            , url: `{{ url('/delete-cal-act') }}`
            , data: $('#delete_calendar_form' + cal_act_id).serialize()
            , success: function(data) {
                $('#delete_calendar_form' + cal_act_id)[0].reset();
                $('#delete_calendar_act_modal' + cal_act_id).modal('hide');
                display_cal_act();
                display_calendar();
                Swal.fire({
                    title: 'Deleted'
                    , text: 'Cap Calendar Deleted Successfully'
                    , icon: 'warning'
                , });
            }
        });
    }

    function edit_cal_act(event, cal_act_id) {
        event.preventDefault();

        $.ajax({
            type: "POST"
            , url: `{{ url('/edit-cal-act') }}`
            , data: $('#edit_calendar_form' + cal_act_id).serialize()
            , success: function(data) {
                $('#edit_calendar_form' + cal_act_id)[0].reset();
                $('#edit_calendar_act_modal' + cal_act_id).modal('hide');
                display_cal_act();
                display_calendar();
                Swal.fire({
                    title: 'Edited'
                    , text: 'Cap Calendar Edited Successfully'
                    , icon: 'success'
                , });
            }
        });
    }

    function add_cal_act(event) {
        event.preventDefault();

        $.ajax({
            type: "POST"
            , url: `{{ url('/add-cap-calendar') }}`
            , data: $('#add_calendar_form').serialize()
            , success: function(data) {
                $('#add_calendar_form')[0].reset();
                $('#add_calendar_act_modal').modal('hide');
                display_cal_act();
                display_calendar();
                Swal.fire({
                    title: 'Added'
                    , text: 'Cap Calendar Added Successfully'
                    , icon: 'success'
                , });
            }
        });
    }


    function display_calendar(){

        $(function() {
            var Calendar = FullCalendar.Calendar;

            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: '/api/calendar-events', // Fetch events from your model
                editable: false, // Disable editing
                droppable: false, // Disable dragging external events
            });

            calendar.render();
        });

    }

</script>


@endsection
