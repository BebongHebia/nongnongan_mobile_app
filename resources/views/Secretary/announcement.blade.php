@extends('Secretary.sidebar')
@section('sidebar')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Announcements</h1>
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
                <h5 class="text-start">Create Announcements</h5>
                <form id="add_announcement_form">
                    @csrf
                    <input type="hidden" name="added_by" value="{{ auth()->user()->id }}">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Details</label>
                    <textarea name="details" class="form-control"></textarea>
                    <button class="btn btn-success mt-2" onclick="add_announcement(event)">
                        <i class="fas fa-plus"></i> Add Announcement
                    </button>
                </form>
            </div>
        </div>



        <!-- Default box -->
        <div class="card card-solid mt-2">
            <div class="card-body pb-0">
                <div class="row" id="announcement_body">







                </div>
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.card -->



    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    display_announcemnt();
    function display_announcemnt() {
        $.ajax({
            type: "GET"
            , url: `{{ url('/fetch-announcement') }}`
            , success: function(data) {

                let rows = '';

                $.each(data, function(index, announcement) {
                    rows += `
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">

                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${announcement.title}</b></h2>
                                    <p class="text-muted text-sm">
                                        ${announcement.details.length > 30 ? announcement.details.substring(0, 200) + '...' : announcement.details}
                                    </p>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('images/announcement.png') }}" class="img-circle img-fluid" style="width:70%">
                                </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-start">
                                    <a href="{{ url('/admin-announcements/id=${announcement.id}') }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> View Announcement
                                    </a>

                                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit_ann_modal${announcement.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete_ann_modal${announcement.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete_ann_modal${announcement.id}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Announcement</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="delete_ann_form${announcement.id}">
                                                        @csrf

                                                        <input type="hidden" name="ann_id" value="${announcement.id}">

                                                        <h5 class="text-center">Are you sure you want to delete this announcement?</h5>
                                                    </form>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="delete_ann(event, ${announcement.id})" class="btn btn-danger">
                                                        <i class="fas fa-trash">
                                                            Delete
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->


                                    <div class="modal fade" id="edit_ann_modal${announcement.id}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Announcement</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="edit_ann_form${announcement.id}">
                                                        @csrf

                                                        <input type="hidden" name="ann_id" value="${announcement.id}">
                                                        <label>Title</label>
                                                        <input type="text" name="title" class="form-control" value="${announcement.title}">
                                                        <label>Details</label>
                                                        <textarea name="details" rows="10" cols="40" class="form-control">${announcement.details}</textarea>


                                                    </form>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="edit_ann(event, ${announcement.id})" class="btn btn-primary">
                                                        <i class="fas fa-save">
                                                            Save changes
                                                        </i>
                                                    </button>
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

                    `;
                });


                $('#announcement_body').html(rows);
            }
        });
    }

    function delete_ann(event, ann_id){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/delete-announcement') }}`,
            data: $('#edit_ann_form' + ann_id).serialize(),
            success: function (data) {
                $('#delete_ann_form' + ann_id)[0].reset();
                $('#delete_ann_modal' + ann_id).modal('hide');
                display_announcemnt();
                Swal.fire({
                    'title': 'Deleted'
                    , 'text': 'Announcement Edited Successfully'
                    , 'icon': 'warning'
                , });
            }
        });
    }

    function edit_ann(event, ann_id){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: `{{ url('/edit-announcement') }}`,
            data: $('#edit_ann_form' + ann_id).serialize(),
            success: function (data) {
                $('#edit_ann_form' + ann_id)[0].reset();
                $('#edit_ann_modal' + ann_id).modal('hide');
                display_announcemnt();
                Swal.fire({
                    'title': 'Edited'
                    , 'text': 'Announcement Edited Successfully'
                    , 'icon': 'success'
                , });
            }
        });
    }


    function add_announcement(event) {
        event.preventDefault();

        $.ajax({
            type: "POST"
            , url: `{{ url('/add-announcement') }}`
            , data: $('#add_announcement_form').serialize()
            , success: function(data) {
                $('#add_announcement_form')[0].reset();

                display_announcemnt();

                Swal.fire({
                    'title': 'Added'
                    , 'text': 'Announcement Added Successfully'
                    , 'icon': 'success'
                , });
            }
        });
    }

</script>
@endsection
