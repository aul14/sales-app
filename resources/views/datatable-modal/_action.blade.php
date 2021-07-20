@permission($can_edit)
<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row_id}}" data-original-title="Edit" class="edit btn btn-light">
<i class="fa fa-pencil"></i></a>
@endpermission
@permission($can_delete)
<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$row_id}}" data-original-title="Delete" class="btn btn-light delete">
<i class="fa fa-trash"></i> </a>
@endpermission
