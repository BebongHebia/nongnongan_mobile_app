@extends('Admin.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Staff Secretary</h1>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#add_staff_sec_modal">
                    <i class="fas fa-plus"></i> Add Staff Secretary
                </button>

                <div class="modal fade" id="add_staff_sec_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Secretary</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add_staff_sec_form">
                                    @csrf

                                    <input type="hidden" name="role" class="form-control" value="Staff-Secretary">

                                    <label>Complete Name</label>
                                    <input type="text" name="complete_name" class="form-control" placeholder="Enter Complete Name">

                                    <label>Sex</label>
                                    <select class="form-select select2" name="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    <label>Date of birth</label>
                                    <input type="date" name="bday" class="form-control">

                                    <label>Place of Birth</label>
                                    <input type="text" name="place_of_birth" class="form-control" placeholder="Enter Place of Birth">

                                    <label>Civil Status</label>
                                    <select class="form-select select2" name="civil_status">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Divorce">Divorce</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>

                                    <label>Citizenships</label>
                                    <input type="text" name="citizenship" class="form-control" placeholder="Enter Citizenship">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Region</label>
                                            <select class="form-select select2" name="region">
                                                <option value="Region I - Ilocos Region">Region I - Ilocos Region</option>
                                                <option value="Region II - Cagayan Valley">Region II - Cagayan Valley</option>
                                                <option value="Region III - Central Luzon">Region III - Central Luzon</option>
                                                <option value="Region IV-A - CALABARZON">Region IV-A - CALABARZON</option>
                                                <option value="MIMAROPA Region">MIMAROPA Region</option>
                                                <option value="Region V - Bicol Region">Region V - Bicol Region</option>
                                                <option value="Region VI - Western Visayas">Region VI - Western Visayas</option>
                                                <option value="Region VI - Western Visayas">Region VI - Western Visayas</option>
                                                <option value="Region VII - Central Visayas">Region VII - Central Visayas</option>
                                                <option value="Region VIII - Eastern Visayas">Region VIII - Eastern Visayas</option>
                                                <option value="Region IX - Zamboanga Peninsula">Region IX - Zamboanga Peninsula</option>
                                                <option value="Region X - Northern Mindanao">Region X - Northern Mindanao</option>
                                                <option value="Region XI - Davao Region">Region XI - Davao Region</option>
                                                <option value="Region XII - SOCCSKSARGEN">Region XII - SOCCSKSARGEN</option>
                                                <option value="Region XIII - Caraga">Region XIII - Caraga</option>
                                                <option value="NCR - National Capital Region">NCR - National Capital Region</option>
                                                <option value="CAR">CAR</option>
                                                <option value="BARMM">BARMM</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Province</label>
                                            <input type="text" name="province" class="form-control" placeholder="Enter Place of Birth">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>City/Municipality</label>
                                            <input type="text" name="city_muni" class="form-control" placeholder="Enter Place of Birth">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Barangay</label>
                                            <input type="text" name="barangay" class="form-control" placeholder="Enter Place of Birth">
                                        </div>
                                    </div>

                                    <label>Proffession/Occupation</label>
                                    <input type="text" name="profession" class="form-control" placeholder="Enter Place of Birth">


                                    <label>Purok - Address</label>
                                    <input type="text" name="purok" class="form-control" placeholder="Enter Purok">

                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone">




                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" onclick="add_sec(event)" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-text">List of Secretary</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered" id="data_table">
                            <thead class="table-warning">
                                <th>Complete Name</th>
                                <th>Sex</th>
                                <th>Birthdate</th>
                                <th>Purok</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="user_table_body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>

    display_sec();

    function display_sec(){
        $.ajax({
            type: "GET",
            url: `{{ url('/get-staff-sec') }}`,
            success: function (data) {
                let rows = '';

                $.each(data, function(index, staff_sec){

                    let back_color, font_color;

                    if (staff_sec.status == "Active"){
                        back_color = "green";
                        font_color = "white";
                    }else if (staff_sec.status == "Suspended"){
                        back_color = "orange";
                        font_color = "black";
                    }else if (staff_sec.status == "Inactive"){
                        back_color = "red";
                        font_color = "white";
                    }

                    rows += `
                        <tr>
                            <td>${staff_sec.complete_name}</td>
                            <td>${staff_sec.sex}</td>
                            <td>${staff_sec.bday}</td>
                            <td>${staff_sec.purok}</td>
                            <td>${staff_sec.phone}</td>
                            <td><span style="background-color:${back_color}; color:${font_color}; padding:10px; border-radius:10px;">${staff_sec.status}</span></td>
                            <td>

                                <a href="{{ url('/view-user=${staff_sec.id}') }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button class="btn btn-primary" data-toggle="modal" data-target="#edit_staff_sec_modal${staff_sec.id}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger" data-toggle="modal" data-target="#delete_staff_sec_modal${staff_sec.id}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="delete_staff_sec_modal${staff_sec.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Secretary</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="delete_staff_sec_form${staff_sec.id}">
                                                    @csrf

                                                    <input type="hidden" name="user_id" value="${staff_sec.id}">

                                                   <h5 class="text-center">Are you sure you want to delete?</h5>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="delete_sec(event, ${staff_sec.id})" class="btn btn-danger">Confirm</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->


                                <div class="modal fade" id="edit_staff_sec_modal${staff_sec.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Secretary</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="edit_staff_sec_form${staff_sec.id}">
                                                    @csrf

                                                    <input type="hidden" name="user_id" value="${staff_sec.id}">

                                                    <label>Complete Name</label>
                                                    <input type="text" name="complete_name" value="${staff_sec.complete_name}" class="form-control">

                                                    <label>Sex</label>
                                                    <select class="form-select select2" name="sex">
                                                        <option value="${staff_sec.sex}" selected>${staff_sec.sex}</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>

                                                    <label>Date of birth</label>
                                                    <input type="date" name="bday" value="${staff_sec.bday}" class="form-control">

                                                    <label>Place of Birth</label>
                                                    <input type="text" name="place_of_birth" value="${staff_sec.place_of_birth}" class="form-control" placeholder="Enter Place of Birth">

                                                    <label>Civil Status</label>
                                                    <select class="form-select select2" name="civil_status">
                                                        <option value="${staff_sec.civil_status}">${staff_sec.civil_status}</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Separated">Separated</option>
                                                        <option value="Divorce">Divorce</option>
                                                        <option value="Widowed">Widowed</option>
                                                    </select>

                                                    <label>Citizenships</label>
                                                    <input type="text" name="citizenship"  value="${staff_sec.citizenship}" class="form-control" placeholder="Enter Citizenship">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Region</label>
                                                            <select class="form-select select2" name="region">
                                                                <option value="${staff_sec.region}">${staff_sec.region}</option>
                                                                <option value="Region I - Ilocos Region">Region I - Ilocos Region</option>
                                                                <option value="Region II - Cagayan Valley">Region II - Cagayan Valley</option>
                                                                <option value="Region III - Central Luzon">Region III - Central Luzon</option>
                                                                <option value="Region IV-A - CALABARZON">Region IV-A - CALABARZON</option>
                                                                <option value="MIMAROPA Region">MIMAROPA Region</option>
                                                                <option value="Region V - Bicol Region">Region V - Bicol Region</option>
                                                                <option value="Region VI - Western Visayas">Region VI - Western Visayas</option>
                                                                <option value="Region VI - Western Visayas">Region VI - Western Visayas</option>
                                                                <option value="Region VII - Central Visayas">Region VII - Central Visayas</option>
                                                                <option value="Region VIII - Eastern Visayas">Region VIII - Eastern Visayas</option>
                                                                <option value="Region IX - Zamboanga Peninsula">Region IX - Zamboanga Peninsula</option>
                                                                <option value="Region X - Northern Mindanao">Region X - Northern Mindanao</option>
                                                                <option value="Region XI - Davao Region">Region XI - Davao Region</option>
                                                                <option value="Region XII - SOCCSKSARGEN">Region XII - SOCCSKSARGEN</option>
                                                                <option value="Region XIII - Caraga">Region XIII - Caraga</option>
                                                                <option value="NCR - National Capital Region">NCR - National Capital Region</option>
                                                                <option value="CAR">CAR</option>
                                                                <option value="BARMM">BARMM</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Province</label>
                                                            <input type="text" name="province" value="${staff_sec.province}" class="form-control" placeholder="Enter Place of Birth">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>City/Municipality</label>
                                                            <input type="text" name="city_muni" value="${staff_sec.city_muni}" class="form-control" placeholder="Enter Place of Birth">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Barangay</label>
                                                            <input type="text" name="barangay"  value="${staff_sec.barangay}" class="form-control" placeholder="Enter Place of Birth">
                                                        </div>
                                                    </div>

                                                    <label>Proffession/Occupation</label>
                                                    <input type="text" name="profession" value="${staff_sec.profession}" class="form-control" placeholder="Enter Place of Birth">



                                                    <label>Purok - Address</label>
                                                    <input type="text" name="purok" value="${staff_sec.purok}" class="form-control" placeholder="Enter Purok">

                                                    <label>Phone</label>
                                                    <input type="text" name="phone" value="${staff_sec.phone}" class="form-control" placeholder="Enter Phone">

                                                    <label>Status</label>
                                                    <select class="form-select select2" name="status">
                                                        <option value="${staff_sec.status}">${staff_sec.status}</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="edit_sec(event, ${staff_sec.id})" class="btn btn-primary">Save changes</button>
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

                $('#user_table_body').html(rows);
                $('.select2').select2();

            }
        });
    }

    function delete_sec(event, user_id){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: `{{ url('/delete-user') }}`,
            data: $('#delete_staff_sec_form' + user_id).serialize(),
            success: function (data) {
                $('#delete_staff_sec_form' + user_id)[0].reset();
                $('#delete_staff_sec_modal' + user_id).modal('hide');
                display_sec();
                Swal.fire({
                    title: 'Deleted',
                    text: 'Staff Secretary Deleted Successfully',
                    icon: 'warning',
                });

            }
        });
    }


    function edit_sec(event, user_id){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: `{{ url('/edit-user') }}`,
            data: $('#edit_staff_sec_form' + user_id).serialize(),
            success: function (data) {
                $('#edit_staff_sec_form' + user_id)[0].reset();
                $('#edit_staff_sec_modal' + user_id).modal('hide');
                display_sec();
                Swal.fire({
                    title: 'Edited',
                    text: 'Staff Secretary Edited Successfully',
                    icon: 'success',
                });

            }
        });
    }

    function add_sec(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/add-user') }}`,
            data: $('#add_staff_sec_form').serialize(),
            success: function (data) {
                $('#add_staff_sec_form')[0].reset();
                $('#add_staff_sec_modal').modal('hide');
                display_sec();
                Swal.fire({
                    title: 'Added',
                    text: 'Staff Secretary Added Successfully',
                    icon: 'success',
                });

            }
        });
    }
</script>

@endsection
