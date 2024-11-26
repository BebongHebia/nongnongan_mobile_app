@extends('Admin.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Punong Barangay</h1>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#add_staff_kap_modal">
                    <i class="fas fa-plus"></i> Add Staff Kapitan
                </button>

                <div class="modal fade" id="add_staff_kap_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Kapitan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add_staff_kap_form">
                                    @csrf

                                    <input type="hidden" name="role" class="form-control" value="Staff-Kapitan">

                                    <label>Complete Name</label>
                                    <input type="text" name="complete_name" class="form-control" placeholder="Enter Complete Name">

                                    <label>Sex</label>
                                    <select class="form-select select2" name="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    <label>Date of birth</label>
                                    <input type="date" name="bday" class="form-control">

                                    <label>Purok - Address</label>
                                    <input type="text" name="purok" class="form-control" placeholder="Enter Purok">

                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone">




                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" onclick="add_kap(event)" class="btn btn-primary">Submit</button>
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
                        <p class="card-text">List of Punong Barangay</p>
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

    display_kap();

    function display_kap(){
        $.ajax({
            type: "GET",
            url: `{{ url('/get-staff-kap') }}`,
            success: function (data) {
                let rows = '';

                $.each(data, function(index, staff_kap){

                    let color, font_color;

                    if (staff_kap.status == "Active"){
                        color = "green";
                        font_color = "white";
                    }else if (staff_kap.status == "Suspended"){
                        color = "orange";
                        font_color = "black";
                    }else if (staff_kap.status == "Inactive"){
                        color = "red";
                        font_color = "white";
                    }

                    rows += `
                        <tr>
                            <td>${staff_kap.complete_name}</td>
                            <td>${staff_kap.sex}</td>
                            <td>${staff_kap.bday}</td>
                            <td>${staff_kap.purok}</td>
                            <td>${staff_kap.phone}</td>
                            <td><span style="background-color:${color}; color:${font_color}; padding:10px; border-radius:10px;">${staff_kap.status}</span></td>
                            <td>
                                <a href="{{ url('/view-user=${staff_kap.id}') }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button class="btn btn-primary" data-toggle="modal" data-target="#edit_staff_kap_modal${staff_kap.id}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger" data-toggle="modal" data-target="#delete_staff_kap_modal${staff_kap.id}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="delete_staff_kap_modal${staff_kap.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Kapitan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="delete_staff_kap_form${staff_kap.id}">
                                                    @csrf

                                                    <input type="hidden" name="user_id" value="${staff_kap.id}">

                                                   <h5 class="text-center">Are you sure you want to delete?</h5>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="delete_kap(event, ${staff_kap.id})" class="btn btn-danger">Confirm</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->


                                <div class="modal fade" id="edit_staff_kap_modal${staff_kap.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Kapitan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="edit_staff_kap_form${staff_kap.id}">
                                                    @csrf

                                                    <input type="hidden" name="user_id" value="${staff_kap.id}">

                                                    <label>Complete Name</label>
                                                    <input type="text" name="complete_name" value="${staff_kap.complete_name}" class="form-control">

                                                    <label>Sex</label>
                                                    <select class="form-select select2" name="sex">
                                                        <option value="${staff_kap.sex}" selected>${staff_kap.sex}</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>

                                                    <label>Date of birth</label>
                                                    <input type="date" name="bday" value="${staff_kap.bday}" class="form-control">

                                                    <label>Purok - Address</label>
                                                    <input type="text" name="purok" value="${staff_kap.purok}" class="form-control" placeholder="Enter Purok">

                                                    <label>Phone</label>
                                                    <input type="text" name="phone" value="${staff_kap.phone}" class="form-control" placeholder="Enter Phone">

                                                    <label>Status</label>
                                                    <select class="form-select select2" name="status">
                                                        <option value="${staff_kap.status}">${staff_kap.status}</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="edit_kap(event, ${staff_kap.id})" class="btn btn-primary">Save changes</button>
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

    function delete_kap(event, user_id){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: `{{ url('/delete-user') }}`,
            data: $('#delete_staff_kap_form' + user_id).serialize(),
            success: function (data) {
                $('#delete_staff_kap_form' + user_id)[0].reset();
                $('#delete_staff_kap_modal' + user_id).modal('hide');
                display_kap();
                Swal.fire({
                    title: 'Deleted',
                    text: 'Staff Kap Deleted Successfully',
                    icon: 'warning',
                });

            }
        });
    }


    function edit_kap(event, user_id){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: `{{ url('/edit-user') }}`,
            data: $('#edit_staff_kap_form' + user_id).serialize(),
            success: function (data) {
                $('#edit_staff_kap_form' + user_id)[0].reset();
                $('#edit_staff_kap_modal' + user_id).modal('hide');
                display_kap();
                Swal.fire({
                    title: 'Edited',
                    text: 'Staff Kap Edited Successfully',
                    icon: 'success',
                });

            }
        });
    }

    function add_kap(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/add-user') }}`,
            data: $('#add_staff_kap_form').serialize(),
            success: function (data) {
                $('#add_staff_kap_form')[0].reset();
                $('#add_staff_kap_modal').modal('hide');
                display_kap();
                Swal.fire({
                    title: 'Added',
                    text: 'Staff Kap Added Successfully',
                    icon: 'success',
                });

            }
        });
    }
</script>

@endsection
