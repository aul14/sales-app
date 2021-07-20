@extends('layouts.global')
@section('title')
    Module
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                @permission('create-module')
                    <a class="btn btn-light waves-effect waves-light" href="javascript:void(0)" id="createNewModule">
                    <i class="icon-plus"></i> Tambah</a>
                @endpermission()
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-sm module">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated rollIn">
                        <div class="modal-header border-light-2">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="moduleForm" name="moduletForm" class="form-horizontal">
                                        <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-8 control-label">Nama Module</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Module" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript">

    $(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

    var table = $('.module').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('module.index') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewModule').click(function () {
        $('#saveBtn').val("create-module");
        $('#id').val('');
        $('#moduleForm').trigger("reset");
        $('#modelHeading').html("Tambah Module");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.edit', function () {
      var id = $(this).data('id');
      $.get("{{ route('module.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Module");
          $('#saveBtn').val("edit-module");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#name').val(data.name);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<span class="spinner-grow spinner-grow-sm"></span> Loading . . .');

        $.ajax({
          data: $('#moduleForm').serialize(),
          url: "{{ route('module.store') }}",
          type: "POST",
          dataType: 'json',
            success: function(data) {
            toastr.success(data.success);
              $('#ajaxModel').modal('hide');
              table.draw();
          },
          error: function (err) {
           if (err.status == 422) {
                console.log(err.responseJSON);
                console.warn(err.responseJSON.errors);
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="'+i+'"]');
                    el.after($('<span style="color: red;">'+error[0]+'</span>'));
                });
            }
        }
      });
    });

    $('body').on('click', '.delete', function () {

        var id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('module.store') }}"+'/'+id,
            success: function(res) {
            toastr.success(res.success);
              table.draw();
            }
        });
    });

  });
</script>
@endsection
