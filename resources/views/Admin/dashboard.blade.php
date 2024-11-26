@extends('Admin.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>
                            @php
                                $get_active_resident = App\Models\User::where('role', 'User')->where('status', 'Active')->count();
                            @endphp
                            {{ $get_active_resident }}
                        </h3>
                        <p>Active Resident</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            @php
                                $get_pending_transaction = App\Models\Transaction::where('status', 'Pending')->count();
                            @endphp

                            {{ $get_pending_transaction }}
                        </h3>

                        <p>Panding Transactions</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>

                            @php
                                $get_no_of_officials = App\Models\User::where('role' , '!=', 'Student')->where('status', 'Active')->count();
                                $get_no_of_officials_1 = App\Models\Official::where('status', 'Active')->count();
                            @endphp
                        {{ $get_no_of_officials + $get_no_of_officials_1 }}
                        </h3>

                        <p>No.# of Active Officials</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Events and Announcements</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-text">
                            List of Pending Transactions
                        </p>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped" id="data_table">
                            <thead class="table-warning">
                                <th>Transaction Code</th>
                                <th>Complete Name</th>
                                <th>Address</th>
                                <th>Document Type</th>
                            </thead>
                            <tbody>
                                @php
                                    $get_pending_transactions = App\Models\Transaction::where('status', 'Pending')->get();
                                @endphp

                                @foreach ($get_pending_transactions as $item_get_pending_transactions)
                                    <tr>
                                        <td>{{ $item_get_pending_transactions->transaction_code }}</td>
                                        <td>{{ $item_get_pending_transactions->get_user->complete_name }}</td>
                                        <td>{{ $item_get_pending_transactions->address }}</td>
                                        <td>{{ $item_get_pending_transactions->document_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-text">
                            Calendar Activities
                        </p>
                    </div>

                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>


            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>

display_calendar();

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
