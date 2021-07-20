@extends('layouts.global')
@section('title')
    Role
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                @permission('create-role')
                    <a href="{{ route('role.create') }}"><button type="button" class="btn btn-light">
                        <i class="icon-organization icons"></i> Tambah</button>
                    </a>
                @endpermission()
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="role" class="table table-bordered order-column table-sm" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nama Role</th>
                            {{-- <th>Hak Akses</th> --}}
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
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
            $('#role').removeAttr('width').DataTable({
                processing: true,
                serverSide: true,
                scrollY:        "150px",
                columnDefs: [
                    { width: 2, targets: 0 }
                ],
                fixedColumns: true,
                ajax: '{{ route('role.index')}}',
                columns: [
                            { data: 'display_name', name: 'display_name' },
                            // { data: 'permission_role.', name: 'display_name', searchable: false, orderable: false },
                            { data: 'action', name: 'action', orderable: false, searchable: false },
                        ],
                order: [[ 0, 'desc' ]]
        });
    });

    </script>
@endsection
