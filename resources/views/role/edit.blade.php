@extends('layouts.global')
@section('title')
    Role Edit
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30 card-warning">
            <div class="card-body">
                <h5 class="form-header text-uppercase">
                    <i class="icon-organization icons"></i>
                     Edit Role
                  </h5>
                  <hr>
                {!! Form::model($role, ['route' => ['role.update', $role->id], 'method'=>'put', 'class' => 'form-horizontal']) !!}
                    @include('role.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-warning">
            <div class="card-body">
                <h4 class="mt-0 header-title">Role Management</h4>
                <p class="sub-title">Silahkan Pilih Module-module Role Untuk Mengatur Permission</p>
                    @php
                        $accordion = 0;
                    @endphp
                <div id="accordion">
                    @foreach ($module as $item)
                        <div class="card mb-2 border border-secondary">
                            <div class="card-header" id="headingOne{{$item->id}}">
                                <h5 class="mb-0 mt-0 font-14">
                                    <a data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseOne{{$item->id}}" aria-expanded="{{ ($accordion == 0) ? 'true' : 'false'}}"
                                        aria-controls="collapseOne{{$item->id}}" class="text-dark">
                                        {{ $item->name }}
                                    </a>
                                </h5>
                            </div>

                            <div id="collapseOne{{$item->id}}" class="collapse false{{ ($accordion == 0) ? 'show' : ''}}"
                                    aria-labelledby="headingOne{{$item->id}}" style="" data-parent="#accordion">
                                <div class="card-body">
                                    @foreach ($item->permission as $row)
                                        <div class="icheck-material-secondary icheck-inline">
                                            @php
                                                $permission_with_role = $row->permission_with_role($row->id, $role->id);
                                            @endphp
                                        </div>
                                        <div class="icheck-material-secondary icheck-inline">
                                            @if (!empty($permission_with_role))
                                                @if ($row->id == $permission_with_role->permission_id)
                                                    <input type="checkbox" id="inlineCheckbox{{$row->id}}" value="{{$row->id}}" checked="" data-permission="{{ $row->name }}">
                                                    <label for="inlineCheckbox{{$row->id}}"> {{ $row->display_name }} </label>
                                                @endif
                                            @else
                                                    <input type="checkbox" id="inlineCheckbox{{$row->id}}" value="option{{$row->id}}" data-permission="{{ $row->name }}">
                                                    <label for="inlineCheckbox{{$row->id}}"> {{ $row->display_name }} </label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @php
                            $accordion++;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
   $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', 'input[type=checkbox]', function(e){
                console.log($(this).data('permission'))
                if($(this).is(':checked')){
                    console.log("Checked")
                    $.ajax({
                        type:'POST',
                        url: '{{ route('permission.attach', $role->id) }}',
                        data: {
                            permission: $(this).data('permission')
                        },
                        success: function(data){
                            $.toast({
                                heading: 'Success !',
                                text: 'Telah Di Berikan Permission',
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 1
                            });
                        }
                    })
                } else {
                    $.ajax({
                        type:'POST',
                        url: '{{ route('permission.detach', $role->id) }}',
                        data: {
                            permission: $(this).data('permission')
                        },
                        success: function(data){
                            $.toast({
                                heading: 'Warning !',
                                text: 'Permission Telah Di Cabut',
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'warning',
                                hideAfter: 3000,
                                stack: 1
                            });
                        }
                    })
                }
            });
        })
</script>
@endsection
