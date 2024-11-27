@extends('Admin.sidebar')
@section('sidebar')

@php
    use Carbon\Carbon;

    $dateToday = Carbon::today()->format('jS \d\a\y \o\f F Y');

@endphp

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">View Transaction : <span style="color:red; font-weight:bold">{{ $transactions->transaction_code }}</span> - Request for : <span style="color:red; font-weight:bold">{{ $transactions->document_type }}</span></h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">

                        <h5 class="text-center">Resident Details</h5>

                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $transactions->get_user->complete_name }}</h3>

                        <p class="text-muted text-center">{{ $transactions->get_user->phone }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Sex</b> <a class="float-right">{{ $transactions->get_user->sex }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Date of Birth</b> <a class="float-right">{{ $transactions->get_user->bday }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a class="float-right">{{ $transactions->get_user->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Civil Status</b> <a class="float-right">{{ $transactions->civil_status }}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">

                        <h5 class="text-center">Request Details</h5>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Document</b> <a class="float-right">{{ $transactions->document_type }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Purpose</b> <a class="float-right">{{ $transactions->purpose }}</a>
                            </li>
                        </ul>

                        <div class="row">
                            <div class="col-sm-6">

                                @if ($transactions->status == "Pending")
                                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#rec_schd_modal">
                                    <i class="fas fa-check"></i> Set Schedule
                                </button>
                                @endif



                                <div class="modal fade" id="rec_schd_modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Set Schedule</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/receive-transactions') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="trans_id" value="{{ $transactions->id }}">

                                                    <h5 class="text-start">Transaction Code : <span style="color:red; font-weight:bold">{{ $transactions->transaction_code }}</span></h5>

                                                    <hr>
                                                    <label>Schedule</label>
                                                    <input type="date" name="schedule" class="form-control">

                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control"></textarea>

                                                    <label>Payable</label>
                                                    <input type="text" name="payable" class="form-control">


                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-check"></i> Set
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>

                            <div class="col-sm-6">

                                @if ($transactions->status == "Pending")
                                    <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#dec_transaction_modal">
                                        <i class="fas fa-window-close"></i> Decline
                                    </button>
                                @endif


                                <div class="modal fade" id="dec_transaction_modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Decline Requests</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/decline-transactions') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="trans_id" value="{{ $transactions->id }}">

                                                    <h5 class="text-start">Transaction Code : <span style="color:red; font-weight:bold">{{ $transactions->transaction_code }}</span></h5>

                                                    <hr>
                                                    <label>Remarks / Reasons of Decline</label>
                                                    <textarea name="remarks" class="form-control"></textarea>



                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button class="btn btn-danger">Proceed Decline</button>
                                            </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>



                        @if ($transactions->status == "Received")
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#print_modal">
                                        <i class="fas fa-check"></i> Print
                                    </button>


                                <div class="modal fade" id="print_modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Print Transactions</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/print-transactions') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="trans_id" value="{{ $transactions->id }}">

                                                    <h5 class="text-start">Transaction Code : <span style="color:red; font-weight:bold">{{ $transactions->transaction_code }}</span></h5>

                                                    <hr>

                                                    <label>O.R No.#</label>
                                                    <input type="text" name="or_no" class="form-control">

                                                    <label>Validity</label>
                                                    <input type="date" name="validity" class="form-control">

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button class="btn btn-success">Proceed</button>
                                            </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                </div>
                            </div>
                        @endif


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Document</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">

                                @if ($transactions->document_type == "Certificate of Indigency")
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center>
                                                <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                                                <p class="text-center; font-weight:bold">Republic of the Philippines <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                            </center>
                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>

                                                        <p style="font-weight: bold">{{ date("m-d-Y") }}<br>____________________________________________ <br>Date:</p>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <h4>Certification of Indigency</h4>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <p class="text-justify">This is to clarify that <input type="text" name="complete_name" value="{{ $transactions->get_user->complete_name }}" style="width:300px"> of legal age, Filipino and a resident of Purok <input type="text" name="complete_name" value="{{ $transactions->address }}" style="width:100"> is in the list of indigent families of Barangay Old Nongnongan, Don Carlos, Bukidnon. </p>
                                                        <p class="text-justify">This certificatio is issued for <input type="text" name="complete_name" value="{{ $transactions->purpose }}" style="width:300px"> only to it may serve</p>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>
                                                        @php
                                                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                                                        @endphp
                                                    <p style="font-weight: bold">{{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                                                    </center>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                @elseif($transactions->document_type == "Barangay Clearance")
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <center>
                                                        <img src="{{ asset('/images/logo.png') }}" class="img-fluid" style="width:100px">
                                                    </center>
                                                </div>
                                                <div class="col-sm-6">
                                                    <center>
                                                        <p class="text-center; font-weight:bold"><span style="font-weight: bold; font-size:14pt">Republic of the Philippines</span> <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                                    </center>

                                                </div>
                                                <div class="col-sm-3">
                                                    <center>
                                                        <img src="{{ asset('/images/municipality_logo.png') }}" class="img-fluid" style="width:100px">
                                                    </center>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div style="width:50%; background-color:yellow; margin:auto; padding:20px; border-radius:10px;">
                                                        <h3 class="text-center" style="font-weight: bolder">BARANGAY CLEARANCE</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-12">
                                                    <h3>TO WHOME IT MAY CONCERN :</h3>
                                                    <p class="text-center">THIS IS TO CERTIFY that the name written below has requested record clearance from this office and verified with the following findings:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <div class="row">
                                                        <div class="col-sm-10">

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">NAME</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->name }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">ADDRESS</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->address }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">DATE OF BIRTH</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->bday }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">PLACE OF BIRTH</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->bplace }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">SEX</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->sex }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">CIVIL STATUS</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->civil_status }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">PURPOSE</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->purpose }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">VALID UNTIL</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->validity }}</h4>

                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">O.R NO.#</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->or_no }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">RES. CERT. NO.#</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">:</h4>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div style="width: 100%; border:1px solid black; height:200px; text-align: center; line-height: 150px;" class="center-cropped">
                                                                <center>

                                                                    @php
                                                                        $get_image_existence = App\Models\UserIdPic::where('user_id', $transactions->user_id)->count();
                                                                        $get_id = App\Models\UserIdPic::where('user_id', $transactions->user_id)->get();
                                                                    @endphp

                                                                    @if ($get_image_existence == 0)
                                                                        <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="vertical-align: middle;">

                                                                    @else
                                                                        @foreach ($get_id as $item_get_id)
                                                                            <img src="{{ asset('storage/'. $item_get_id->path) }}" class="img-fluid" alt="User Image" style="width:100%">

                                                                        @endforeach
                                                                    @endif


                                                                </center>
                                                            </div>
                                                            <form action="{{ url('/transaction-add-id') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf

                                                                <input type="hidden" name="user_id" value="{{ $transactions->user_id }}">

                                                                <input type="file" name="image" class="form-control">


                                                                <button class="btn btn-warning btn-block">
                                                                    <i class="fas fa-arrow-alt-circle-up"></i> Upload
                                                                </button>

                                                            </form>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="text-start">The above mentioned name is a law abiding citizens and found <b>NO DEROGATORY RECORDS</b> as far as the office is concerned</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="text-start">Issued this {{ \Carbon\Carbon::today()->format('jS \d\a\y \o\f F Y') }} at the office of the PUNONG BARANGAY OLD NONGNONGAN, DON CARLOS, BUKIDNON.</p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-3">
                                                    <center>
                                                        <p class="text-start"><b>Prepared by: <br> {{ auth()->user()->complete_name }} <br> __________________________________ <br> {{ auth()->user()->role }}</b></p>
                                                    </center>
                                                </div>
                                                <div class="col-sm-9">


                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    @php
                                                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                                                        @endphp

                                                    <p class="text-center" style="font-weight: bold">Noted By: <br> {{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                @elseif($transactions->document_type == "Barangay Certification")
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center>
                                                <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                                                <p class="text-center; font-weight:bold">Republic of the Philippines <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                            </center>
                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>

                                                        <p style="font-weight: bold">{{ date("m-d-Y") }}<br>____________________________________________ <br>Date:</p>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <h4>BARANGAY CERTIFICATION</h4>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        @php
                                                            $birthdate = $transactions->get_user->bday; // e.g., "2022-02-02"
                                                            $age = Carbon::parse($birthdate)->age;
                                                        @endphp
                                                        <p class="text-justify">This is to certify that <input type="text" name="complete_name" value="{{ $transactions->get_user->complete_name }}" style="width:300px"> age <input type="text" name="complete_name" value="{{ $age }}" style="width:300px">, Filipino and a resident of Purok <input type="text" name="complete_name" value="{{ $transactions->address }}" style="width:100">.</p>
                                                        <p class="text-justify">{{ $transactions->get_user->complete_name }} has good community standing and law-abiding citizen with no criminal offense/activities on record in this office </p>
                                                        <p class="text-justify">This certificatio is issued for <input type="text" name="complete_name" value="{{ $transactions->purpose }}" style="width:300px"> only to it may serve</p>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>
                                                        @php
                                                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                                                        @endphp
                                                    <p style="font-weight: bold">{{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                                                    </center>

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                @elseif($transactions->document_type == "Barangay Cert - First-time Job Seeker")


                                <hr>
                                <h4>BARANGAY INDIGENCY</h4>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center>
                                                <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                                                <p class="text-center; font-weight:bold">Republic of the Philippines <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                            </center>
                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>

                                                        <p style="font-weight: bold">{{ date("m-d-Y") }}<br>____________________________________________ <br>Date:</p>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <h4>Certification of Indigency</h4>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <p class="text-justify">This is to clarify that <input type="text" name="complete_name" value="{{ $transactions->get_user->complete_name }}" style="width:300px"> of legal age, Filipino and a resident of Purok <input type="text" name="complete_name" value="{{ $transactions->address }}" style="width:100"> is in the list of indigent families of Barangay Old Nongnongan, Don Carlos, Bukidnon. </p>
                                                        <p class="text-justify">This certificatio is issued for <input type="text" name="complete_name" value="{{ $transactions->purpose }}" style="width:300px"> only to it may serve</p>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>
                                                        @php
                                                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                                                        @endphp
                                                    <p style="font-weight: bold">{{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                                                    </center>

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <hr>
                                    <h4>BARANGAY CLEARANCE</h4>


                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <center>
                                                        <img src="{{ asset('/images/logo.png') }}" class="img-fluid" style="width:100px">
                                                    </center>
                                                </div>
                                                <div class="col-sm-6">
                                                    <center>
                                                        <p class="text-center; font-weight:bold"><span style="font-weight: bold; font-size:14pt">Republic of the Philippines</span> <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                                    </center>

                                                </div>
                                                <div class="col-sm-3">
                                                    <center>
                                                        <img src="{{ asset('/images/municipality_logo.png') }}" class="img-fluid" style="width:100px">
                                                    </center>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div style="width:50%; background-color:yellow; margin:auto; padding:20px; border-radius:10px;">
                                                        <h3 class="text-center" style="font-weight: bolder">BARANGAY CLEARANCE</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-12">
                                                    <h3>TO WHOME IT MAY CONCERN :</h3>
                                                    <p class="text-center">THIS IS TO CERTIFY that the name written below has requested record clearance from this office and verified with the following findings:</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <div class="row">
                                                        <div class="col-sm-10">

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">NAME</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->name }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">ADDRESS</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->address }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">DATE OF BIRTH</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->bday }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">PLACE OF BIRTH</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->bplace }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">SEX</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->sex }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">CIVIL STATUS</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->civil_status }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">PURPOSE</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->purpose }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">VALID UNTIL</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->validity }}</h4>

                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">O.R NO.#</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">: {{ $transactions->or_no }}</h4>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <h4 class="text-start">RES. CERT. NO.#</h4>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <h4 class="text-start">:</h4>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div style="width: 100%; border:1px solid black; height:200px; text-align: center; line-height: 150px;" class="center-cropped">
                                                                <center>

                                                                    @php
                                                                        $get_image_existence = App\Models\UserIdPic::where('user_id', $transactions->user_id)->count();
                                                                        $get_id = App\Models\UserIdPic::where('user_id', $transactions->user_id)->get();
                                                                    @endphp

                                                                    @if ($get_image_existence == 0)
                                                                        <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="vertical-align: middle;">

                                                                    @else
                                                                        @foreach ($get_id as $item_get_id)
                                                                            <img src="{{ asset('storage/'. $item_get_id->path) }}" class="img-fluid" alt="User Image" style="width:100%">

                                                                        @endforeach
                                                                    @endif


                                                                </center>
                                                            </div>
                                                            <form action="{{ url('/transaction-add-id') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf

                                                                <input type="hidden" name="user_id" value="{{ $transactions->user_id }}">

                                                                <input type="file" name="image" class="form-control">


                                                                <button class="btn btn-warning btn-block">
                                                                    <i class="fas fa-arrow-alt-circle-up"></i> Upload
                                                                </button>

                                                            </form>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="text-start">The above mentioned name is a law abiding citizens and found <b>NO DEROGATORY RECORDS</b> as far as the office is concerned</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="text-start">Issued this {{ \Carbon\Carbon::today()->format('jS \d\a\y \o\f F Y') }} at the office of the PUNONG BARANGAY OLD NONGNONGAN, DON CARLOS, BUKIDNON.</p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-3">
                                                    <center>
                                                        <p class="text-start"><b>Prepared by: <br> {{ auth()->user()->complete_name }} <br> __________________________________ <br> {{ auth()->user()->role }}</b></p>
                                                    </center>
                                                </div>
                                                <div class="col-sm-9">


                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-9">

                                                </div>
                                                <div class="col-sm-3">
                                                    @php
                                                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                                                        @endphp

                                                    <p class="text-center" style="font-weight: bold">Noted By: <br> {{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <hr>
                                    <h4>BARANGAY CERTIFICATION</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center>
                                                <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                                                <p class="text-center; font-weight:bold">Republic of the Philippines <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                            </center>
                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>

                                                        <p style="font-weight: bold">{{ date("m-d-Y") }}<br>____________________________________________ <br>Date:</p>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <h4>BARANGAY CERTIFICATION</h4>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <center>
                                                        @php
                                                            $birthdate = $transactions->get_user->bday; // e.g., "2022-02-02"
                                                            $age = Carbon::parse($birthdate)->age;
                                                        @endphp
                                                        <p class="text-justify">This is to certify that <input type="text" name="complete_name" value="{{ $transactions->get_user->complete_name }}" style="width:300px"> age <input type="text" name="complete_name" value="{{ $age }}" style="width:300px">, Filipino and a resident of Purok <input type="text" name="complete_name" value="{{ $transactions->address }}" style="width:100">.</p>
                                                        <p class="text-justify">{{ $transactions->get_user->complete_name }} has good community standing and law-abiding citizen with no criminal offense/activities on record in this office </p>
                                                        <p class="text-justify">This certificatio is issued for <input type="text" name="complete_name" value="{{ $transactions->purpose }}" style="width:300px"> only to it may serve</p>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <center>
                                                        @php
                                                            $kapitan = App\Models\User::where('role', 'Staff-Kapitan')->latest()->first();
                                                        @endphp
                                                    <p style="font-weight: bold">{{ $kapitan->complete_name }}<br>______________________________ <br>Punong Barangay</p>

                                                    </center>

                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                @elseif($transactions->document_type == "Incident Reports")

                                    <input type="hidden" id="transaction_id" value="{{ $transactions->id }}">

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <center>
                                                <img src="{{ asset('/images/logo.png') }}" class="img-fluid" style="width:100px">
                                            </center>
                                        </div>
                                        <div class="col-sm-6">
                                            <center>
                                                <p class="text-center; font-weight:bold"><span style="font-weight: bold; font-size:14pt">Republic of the Philippines</span> <br> Brgy Old Nongnongan, Don Carlos. <br> Bukidnon. <br> Region X.</p>

                                            </center>

                                        </div>
                                        <div class="col-sm-3">
                                            <center>
                                                <img src="{{ asset('/images/municipality_logo.png') }}" class="img-fluid" style="width:100px">
                                            </center>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="text-center"><b>Incident/Complain Reports</b></h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>
                                                Transaction No.# : <b>{{ $transactions->transaction_code }}</b><br>
                                                Date : <b>{{ date("Y/m/d, D") }}</b><br>
                                                Date & Time Reported : <b>{{ date("Y/m/d, D : h:i:s:a") }}</b><br>

                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <hr>

                                            <p><b>Report Details</b></p>

                                            <p>__________________________________________________________________________________________________________________________________________________</p>
                                            <p>__________________________________________________________________________________________________________________________________________________</p>
                                            <p>__________________________________________________________________________________________________________________________________________________</p>
                                            <p>__________________________________________________________________________________________________________________________________________________</p>
                                            <p>__________________________________________________________________________________________________________________________________________________</p>
                                            <p>__________________________________________________________________________________________________________________________________________________</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">

                                            <h5 class="text-start">People/Person Responsible Listed Below</h5>

                                            <table class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="responsible_table_body">
                                                </tbody>
                                            </table>

                                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#add_person_incharge_modal">
                                                <i class="fas fa-plus"></i> Add Person Involve
                                            </button>

                                            <div class="modal fade" id="add_person_incharge_modal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Person Incharge</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="add_person_incharge_form">
                                                                @csrf

                                                                <input type="hidden" name="transaction_id" value="{{ $transactions->id }}">

                                                                <label>Complete Name</label>
                                                                <input type="text" name="complete_name" class="form-control">

                                                                <label>Address</label>
                                                                <input type="text" name="address" class="form-control">

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" onclick="add_personel(event)" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="text-start">I hereby affirm that the above statement is true and accurate to the best of my knowledge.</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="text-start">
                                                Complainant's Signature: ___________________________ <br>
                                                Date: ____________________ <br>
                                                Received By (Officer/Authority): ___________________________ <br>
                                                Position ___________________________ <br>
                                                Date Received: ___________________________ <br>
                                            </p>
                                        </div>
                                    </div>

                                @endif

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>


    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>

    display_persones();

    function display_persones(){

        var transaction_id = $('#transaction_id').val();

        $.ajax({
            type: "GET",
            url: `{{ url('/fetch-personels/transaction-id=${transaction_id}') }}`,
            success: function (data) {
                let rows = '';

                $.each(data, function (index, persons) {
                    rows += `

                        <tr>
                            <td>${persons.complete_name}</td>
                            <td>${persons.address}</td>
                            <td>
                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#remove_person_incharge_modal${persons.id}">
                                    <i class="fas fa-window-close"></i>
                                </button>

                                <div class="modal fade" id="remove_person_incharge_modal${persons.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Remove Person Responsible</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="remove_person_incharge_form${persons.id}">
                                                    @csrf

                                                    <input type="hidden" name="res_id" value="${persons.id}">

                                                    <h5 class="text-center">Are you sure you want to remove this respondent?</h5>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="remove_person(event, ${persons.id})" class="btn btn-danger">Remove</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->



                            </td>
                        </tr>


                    `;
                });

                $('#responsible_table_body').html(rows);
            }
        });
    }

    function remove_person(event, res_id){
        $.ajax({
            type: "POST",
            url: `{{ url('/remove-involve') }}`,
            data: $('#remove_person_incharge_form' + res_id).serialize(),
            success: function (data) {
                $('#remove_person_incharge_form' + res_id)[0].reset();
                $('#remove_person_incharge_modal' + res_id).modal('hide');

                display_persones();

                Swal.fire({
                    title: 'Removed',
                    text: 'Removed Successfully',
                    icon: 'warning',
                });
            }
        });
    }

    function add_personel(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/add-involve') }}`,
            data: $('#add_person_incharge_form').serialize(),
            success: function (data) {
                $('#add_person_incharge_form')[0].reset();
                $('#add_person_incharge_modal').modal('hide');

                display_persones();

                Swal.fire({
                    title: 'Added',
                    text: 'Added Successfully',
                    icon: 'success',
                });
            }
        });
    }
</script>

@endsection
