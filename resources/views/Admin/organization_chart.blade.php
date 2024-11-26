@extends('Admin.sidebar')
@section('sidebar')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Organizational Chart</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <center>
                    @php
                    $get_punong_barangay = App\Models\User::where('role', 'Staff-Kapitan')->where('status', 'Active')->get();
                    $get_secretary = App\Models\User::where('role', 'Staff-Secretary')->where('status', 'Active')->get();
                    $get_offcials = App\Models\Official::where('status', 'Active')->where('role', 'Kagawad')->get();
                    $get_treasurer = App\Models\Official::where('status', 'Active')->where('role', 'Treasurer')->get();
                    @endphp


                    @foreach ($get_punong_barangay as $item_get_punong_barangay)
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="width:15%; margin:auto; border:1px solid rgb(79, 79, 79); border-radius:10px; padding:10px">

                                    @php
                                    $get_user_profile_exist = App\Models\UserIdPic::where('user_id', $item_get_punong_barangay->id)->count();
                                    $get_user_profile = App\Models\UserIdPic::where('user_id', $item_get_punong_barangay->id)->get();
                                    @endphp

                                    @if ($get_user_profile_exist)
                                    @foreach ($get_user_profile as $item_get_user_profile)
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.$item_get_user_profile->path) }}" alt="User profile picture">
                                    @endforeach

                                    @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user_icon.png') }}" alt="User profile picture">
                                    @endif

                                    <p>
                                        <b>
                                            {{ $item_get_punong_barangay->complete_name }}
                                        </b>
                                        <br>
                                        Punong Barangay
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="row mt-2">
                        @foreach ($get_offcials as $item_get_offcials)
                            <div class="col-sm-3 mt-2">
                                <div style="width:100%; margin:auto; border:1px solid rgb(79, 79, 79); border-radius:10px; padding:10px">

                                    @php
                                    $get_user_profile_exist = App\Models\OfficialIdPic::where('user_id', $item_get_offcials->id)->count();
                                    $get_user_profile = App\Models\OfficialIdPic::where('user_id', $item_get_offcials->id)->get();
                                    @endphp

                                    @if ($get_user_profile_exist)
                                    @foreach ($get_user_profile as $item_get_user_profile)
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.$item_get_user_profile->path) }}" alt="User profile picture">
                                    @endforeach

                                    @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user_icon.png') }}" alt="User profile picture">
                                    @endif

                                    <p>
                                        <b>
                                            {{ $item_get_offcials->complete_name }}
                                        </b>
                                        <br>
                                        {{ $item_get_offcials->roles }}
                                        {{ $item_get_offcials->fields }}
                                    </p>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    @foreach ($get_treasurer as $item_get_treasurer)
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div style="width:15%; margin:auto; border:1px solid rgb(79, 79, 79); border-radius:10px; padding:10px">

                                    @php
                                    $get_user_profile_exist = App\Models\OfficialIdPic::where('user_id', $item_get_treasurer->id)->count();
                                    $get_user_profile = App\Models\OfficialIdPic::where('user_id', $item_get_treasurer->id)->get();
                                    @endphp

                                    @if ($get_user_profile_exist)
                                    @foreach ($get_user_profile as $item_get_user_profile)
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.$item_get_user_profile->path) }}" alt="User profile picture">
                                    @endforeach

                                    @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user_icon.png') }}" alt="User profile picture">
                                    @endif

                                    <p>
                                        <b>
                                            {{ $item_get_treasurer->complete_name }}
                                        </b>
                                        <br>
                                        Barangay Treasurer
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($get_secretary as $item_get_secretary)
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div style="width:15%; margin:auto; border:1px solid rgb(79, 79, 79); border-radius:10px; padding:10px">

                                    @php
                                    $get_user_profile_exist = App\Models\UserIdPic::where('user_id', $item_get_secretary->id)->count();
                                    $get_user_profile = App\Models\UserIdPic::where('user_id', $item_get_secretary->id)->get();
                                    @endphp

                                    @if ($get_user_profile_exist)
                                    @foreach ($get_user_profile as $item_get_user_profile)
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.$item_get_user_profile->path) }}" alt="User profile picture">
                                    @endforeach

                                    @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user_icon.png') }}" alt="User profile picture">
                                    @endif

                                    <p>
                                        <b>
                                            {{ $item_get_secretary->complete_name }}
                                        </b>
                                        <br>
                                        Barangay Secretary
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </center>
            </div>
        </div>


    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
