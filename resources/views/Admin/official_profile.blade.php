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
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">

                            @php
                                $get_user_profile_exist = App\Models\OfficialIdPic::where('user_id', $official_details->id)->count();
                                $get_user_profile = App\Models\OfficialIdPic::where('user_id', $official_details->id)->get();
                            @endphp

                            @if ($get_user_profile_exist)
                            @foreach ($get_user_profile as $item_get_user_profile)
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.$item_get_user_profile->path) }}" alt="User profile picture">
                            @endforeach

                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user_icon.png') }}" alt="User profile picture">
                            @endif

                            <form action="{{ url('/add-off-id') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $official_details->id }}">
                                <label>Upload/Change User Profile</label>
                                <input type="file" name="image" class="form-control">
                                <button class="btn btn-success btn-block mt-2">
                                    <i class="fas fa-arrow-alt-circle-up"></i> Upload
                                </button>
                            </form>

                        </div>


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
                            <li class="nav-item"><b>User Details</b></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">

                                <form action="{{ url('/update-official-profile') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="off_id" value="{{ $official_details->id }}">

                                    <label>Complete Name</label>
                                    <input type="text" name="complete_name" value="{{ $official_details->complete_name }}" class="form-control">

                                    <label>Sex</label>
                                    <select class="form-select select2" name="sex" style="width:100%">
                                        <option value="{{ $official_details->sex }}" selected>{{ $official_details->sex }}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    <label>Date of birth</label>
                                    <input type="date" name="bday" value="{{ $official_details->bday }}" class="form-control">

                                    <label>Purok - Address</label>
                                    <input type="text" name="address" value="{{ $official_details->address }}" class="form-control" placeholder="Enter Purok">

                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ $official_details->phone }}" class="form-control" placeholder="Enter Phone">


                                    <label>Role</label>
                                    <select class="form-select select2" name="role" style="width:100%">
                                        <option value="{{ $official_details->role }}" selected>{{ $official_details->role }}</option>
                                        <option value="Kagawad">Kagawad</option>
                                        <option value="SK Chairman">SK Chairman</option>
                                        <option value="Treasurer">Treasurer</option>
                                    </select>

                                    <label>Field</label>
                                    <input type="text" name="fields" value="{{ $official_details->fields }}" class="form-control">


                                    <label>Status</label>
                                    <select class="form-select select2" name="status" style="width:100%">
                                        <option value="{{ $official_details->status }}" selected>{{ $official_details->status }}</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>

                                    <button class="btn btn-primary mt-3">
                                        <i class="fas fa-save"></i> Save changes
                                    </button>
                                </form>
                            </div>


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
@endsection

