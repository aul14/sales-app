@extends('layouts.global')
@section('title')
    Setting
@endsection
@php
    $logo=asset(Storage::url('logo/'));
@endphp

@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card card-warning">
          <div class="card-body">
            <ul class="nav nav-pills nav-pills-secondary nav-justified top-icon" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#company"><i class="icon-home"></i> <span class="hidden-xs">Company Logo </span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#profile"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#setting"><i class="icon-settings icon"></i> <span class="hidden-xs">Setting</span></a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="company" class="container tab-pane active">
                    {{Form::model($settings,array('url'=>'systems','method'=>'POST','enctype' => "multipart/form-data"))}}
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5>{{__('Logo')}}</h5>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="height: 150px;">
                                            <img src="{{$logo.'/logo.png'}}" alt="">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file">
                                                <span class="fileinput-new"> {{__('Select image')}} </span>
                                                <span class="fileinput-exists"> {{__('Change')}} </span>
                                                <input type="hidden">
                                                <input type="file" name="logo" id="logo">
                                            </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> {{__('Remove')}} </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5>{{__('Favicon')}}</h5>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="height: 150px;">
                                            <img src="{{$logo.'/favicon.png'}}" alt="">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file">
                                                <span class="fileinput-new"> {{__('Select image')}} </span>
                                                <span class="fileinput-exists"> {{__('Change')}} </span>
                                                <input type="hidden">
                                                <input type="file" name="favicon" id="favicon">
                                            </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> {{__('Remove')}} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @error('logo')
                                <span class="invalid-logo" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row mt-20">
                                <div class="form-group col-md-6">
                                    {{Form::label('title_text',__('Title Text')) }}
                                    {{Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))}}
                                    @error('title_text')
                                    <span class="invalid-title_text" role="alert">
                                        <strong class="text-danger">{{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                    <small class="text-muted text-warning">Untuk mengubah nama title</small>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('style_theme',__('Style Theme')) }}
                                    {{Form::text('style_theme',null,array('class'=>'form-control','placeholder'=>__('Style Theme')))}}
                                    @error('style_theme')
                                    <span class="invalid-style_theme" role="alert">
                                        <strong class="text-danger">{{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                    <small class="text-muted text-warning">Untuk mengubah theme, silahkan ganti (angkanya saja) antara angka 1 s/d 15</small>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('company_name',__('Logo Name')) }}
                                    {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Logo Name')))}}
                                    @error('company_name')
                                    <span class="invalid-company_name" role="alert">
                                        <strong class="text-danger">{{ $message }}
                                        </strong>
                                    </span>
                                    @enderror
                                    <small class="text-muted text-warning">Untuk mengubah nama perusahaan atau logo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @permission('create-setting')
                    <div class="text-right">
                        {{Form::submit(__('Save Change'),array('class'=>'btn btn-primary'))}}
                    </div>
                    @endpermission
                    {{Form::close()}}
                </div>
                <div id="profile" class="container tab-pane fade">
                    <p>Silahkan Tambahkan Sesuai Kebutuhan ^_^</p>
                </div>
                <div id="setting" class="container tab-pane fade">
                    <p>Silahkan Tambahkan Sesuai Kebutuhan</p>
                </div>
            </div>
          </div>
       </div>
    </div>
</div>
@endsection
