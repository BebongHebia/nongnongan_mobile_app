@extends('Secretary.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Officials</h1>
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
                <button class="btn btn-success" data-toggle="modal" data-target="#add_officails_modal">
                    <i class="fas fa-plus"></i> Add Officials
                </button>

                <div class="modal fade" id="add_officails_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Officials</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add_officails_form">
                                    @csrf

                                    <label>Complete Name</label>
                                    <input type="text" name="complete_name" class="form-control" placeholder="Enter Complete Name">

                                    <label>Sex</label>
                                    <select class="form-select select2" name="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    <label>Date of birth</label>
                                    <input type="date" name="bday" class="form-control">

                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Purok">

                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone">

                                    <label>Role</label>
                                    <select class="form-select select2" name="role">
                                        <option value="Kagawad">Kagawad</option>
                                        <option value="SK Chairman">SK Chairman</option>
                                        <option value="Treasurer">Treasurer</option>
                                    </select>

                                    <label>Field</label>
                                    <input type="text" name="fields" class="form-control" placeholder="Enter Field">
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" onclick="add_off(event)" class="btn btn-primary">Submit</button>
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
                        <p class="card-text">Officials</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped" id="data_table">
                            <thead class="table-warning">
                                <th>Complete Name</th>
                                <th>Sex</th>
                                <th>Birthday</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Field</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="official_table_body">
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
    display_official();
    function display_official(){
        $.ajax({
            type: "GET",
            url: `{{ url('/fetch-official') }}`,
            success: function (data) {
                let rows = '';

                $.each(data, function (index, official) {

                    var back_color, font_color;

                    if (official.status == "Active"){
                        back_color = "green";
                        font_color = "white";
                    }else if (official.status == "Suspended"){
                        back_color = "orange";
                        font_color = "black";
                    }else if (official.status == "Inactive"){
                        back_color = "red";
                        font_color = "white";
                    }

                    rows += `
                        <tr>
                            <td>${official.complete_name}</td>
                            <td>${official.sex}</td>
                            <td>${official.bday}</td>
                            <td>${official.address}</td>
                            <td>${official.phone}</td>
                            <td>${official.role}</td>
                            <td>${official.fields}</td>
                            <td><span style="background-color:${back_color}; color:${font_color}; padding:10px; border-radius:10px;">${official.status}</span></td>
                            <td>

                                <a href="{{ url('/view-officials=${official.id}') }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button class="btn btn-primary" data-toggle="modal" data-target="#edit_officails_modal${official.id}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger" data-toggle="modal" data-target="#delete_officails_modal${official.id}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="delete_officails_modal${official.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Officials</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="delete_officails_form${official.id}">
                                                    @csrf

                                                    <input type="hidden" name="off_id" value="${official.id}">
                                                    <h4 class="text-center">Are you sure you want to delete?</h4>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="delete_off(event, ${official.id})" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <div class="modal fade" id="edit_officails_modal${official.id}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Officials</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="edit_officails_form${official.id}">
                                                    @csrf

                                                    <input type="hidden" name="off_id" value="${official.id}">

                                                    <label>Complete Name</label>
                                                    <input type="text" name="complete_name" class="form-control" value="${official.complete_name}">

                                                    <label>Sex</label>
                                                    <select class="form-select select2" name="sex">
                                                        <option value="${official.sex}">${official.sex} Current</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>

                                                    <label>Date of birth</label>
                                                    <input type="date" name="bday" class="form-control" value="${official.bday}">

                                                    <label>Address</label>
                                                    <input type="text" name="address" class="form-control" value="${official.address}">

                                                    <label>Phone</label>
                                                    <input type="text" name="phone" class="form-control" value="${official.phone}">

                                                    <label>Role</label>
                                                    <select class="form-select select2" name="role">
                                                        <option value="${official.role}">${official.role} Current</option>
                                                        <option value="Kagawad">Kagawad</option>
                                                        <option value="SK Chairman">SK Chairman</option>
                                                        <option value="Treasurer">Treasurer</option>
                                                    </select>

                                                    <label>Field</label>
                                                    <input type="text" name="fields" class="form-control" value="${official.fields}">

                                                    <label>Status</label>
                                                    <select class="form-select select2" name="status">
                                                        <option value="${official.status}">${official.status} Current</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="edit_off(event, ${official.id})" class="btn btn-primary">Save Changes</button>
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

                $('#official_table_body').html(rows);
                $('.select2').select2();
            }
        });
    }

    function delete_off(event, off_id){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/delete-official') }}`,
            data: $('#delete_officails_form' + off_id).serialize(),
            success: function (data) {
                $('#delete_officails_form' + off_id)[0].reset();
                $('#delete_officails_modal' + off_id).modal('hide');
                display_official();
                Swal.fire({
                    title: 'Deleted',
                    text: 'Official Deleted Successfully',
                    icon: 'warning',
                });
            }
        });
    }

    function edit_off(event, off_id){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/edit-official') }}`,
            data: $('#edit_officails_form' + off_id).serialize(),
            success: function (data) {
                $('#edit_officails_form' + off_id)[0].reset();
                $('#edit_officails_modal' + off_id).modal('hide');
                display_official();
                Swal.fire({
                    title: 'Edited',
                    text: 'Official Edited Successfully',
                    icon: 'success',
                });
            }
        });
    }

    function add_off(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/add-official') }}`,
            data: $('#add_officails_form').serialize(),
            success: function (data) {
                $('#add_officails_form')[0].reset();
                $('#add_officails_modal').modal('hide');
                display_official();
                Swal.fire({
                    title: 'Added',
                    text: 'Official Added Successfully',
                    icon: 'success',
                });
            }
        });
    }
</script>
@endsection

