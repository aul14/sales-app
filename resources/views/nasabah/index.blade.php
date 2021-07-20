@extends('layouts.global')
@section('title')
    User
@endsection

@section('content')

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
