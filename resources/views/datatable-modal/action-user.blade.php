
@permission('reset-password')
<a href="{{ $reset_url }}" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Ganti Password">
    <i class="fa fa-eye"></i></a>
@endpermission
@permission('edit-user')
<a href="{{ $edit_url }}" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-pencil"></i></a>
@endpermission
