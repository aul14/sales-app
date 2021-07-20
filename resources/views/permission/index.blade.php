@extends('layouts.global')
@section('title')
    Permission
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                @permission('create-permission')
                    <a href="{{ route('permission.create') }}"><button type="button" class="btn btn-light">
                        <i class="icon-plus"></i> Tambah</button>
                    </a>
                @endpermission()
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permission" class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Module</th>
                            <th>Key Permission</th>
                            <th>Display</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
    <script>
        $(document).ready(function(){
            $('#permission').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('permission.index')}}',
            columns: [
                  { data: 'id', name: 'id' },
                  { data: 'module.name', name: 'module.name' },
                  { data: 'name', name: 'name' },
                  { data: 'display_name', name: 'display_name' },
                  { data: 'description', name: 'description' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
               ],
            order: [[ 0, 'desc' ]],
        });
    });

    </script>
@endsection
