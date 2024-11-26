@extends('Admin.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Logs</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-primary">
            <div class="card-header">
                <p class="card-text">Log and Activity History</p>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-striped" id="data_table">
                    <thead class="table-warning">
                        <th>Logs/remarks</th>
                        <th>Responsible</th>
                    </thead>
                    <tbody id="log_table_body" >
                        @php
                            $logs = App\Models\HistoryLog::all();
                        @endphp

                        @foreach ($logs as $item_logs)
                            <tr>
                                <td>{{ $item_logs->remarks }}</td>
                                <td>{{ $item_logs->get_responsible ?  $item_logs->get_responsible->complete_name : 'N/A'}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

