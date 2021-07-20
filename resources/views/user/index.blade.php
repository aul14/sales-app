@extends('layouts.global')
@section('title')
    User
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card card-warning">
        <div class="card-header">
            @permission('create-user')
                <a href="{{ route('user.create') }}"><button type="button" class="btn btn-light">
                    <i class="icon-user-unfollow"></i> Tambah</button>
                </a>
            @endpermission()
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="user" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Hak Akses</th>
                    <th>No Telpon</th>
                    <th>Gender</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
  </div><!-- End Row-->
@endsection

@section('script')
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
<script>
    $(document).ready(function() {
      $('#user').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('user.index')}}',
        columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    { data: 'roles[0].display_name', name: 'roles[0].display_name', searchable: false, orderable: false },
                    {data: 'no_hp', name: 'no_hp'},
                    {data: 'gender', name: 'gender'},
                    {data: 'alamat', name: 'alamat'},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
        order: [[ 0, 'desc' ]],
      });
    });

   </script>
@endsection
