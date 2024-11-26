@extends('Secretary.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">View Announcement</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<script></script>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">

                <div style="width:90%; border:1px solid gray; border-radius:10px; margin:auto; padding:10px; box-shadow:3px 3px 3px gray">

                    <div class="row">
                        <div class="col-sm-12">
                            <center>
                                <img src="{{ url('images/logo.png') }}" class="img-fluid">
                            </center>

                            <h1 class="text-center"><b>Pahibalo / Announcement</b></h1>
                            <br>
                            <br>

                            <h4 class="text-start"><b>Title : <span style="color:red">{{ $ann_details->title }}</span></b></h4>

                            <h5 class="text-start"><b>Details : </b></h4>
                            <p class="text-start">{{ $ann_details->details }}</p>
                        </div>
                    </div>


                </div>



            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

