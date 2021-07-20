@extends('layouts.global')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@section('css')
<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('title')
    {{__('Profile Account')}}
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Profile Account</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card card-warning">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="fa fa-user-o font-24 mt-2 text-primary"></i>
                        </div>
                        <div class="profile-sidebar">
                            <div class="portlet light profile-sidebar-portlet ">
                                <div class="profile-userpic">
                                    <img alt="image" src="{{(!empty($userDetail->avatar))? $profile.'/'.$userDetail->avatar : $profile.'/avatar.png'}}" class="img-responsive user-profile" class="img-responsive user-profile">
                                </div>
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name font-style text-primary"> {{$userDetail->name}}</div>
                                    {{-- <div class="profile-usertitle-job font-style"> {{$userDetail->type}}</div> --}}
                                    <div class="profile-usertitle-job text-primary"> {{$userDetail->email}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-usermenu">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card card-warning">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="fa fa-user-o font-24 mt-2 text-primary"></i>
                        </div>
                        <h5 class="text-primary">Manage Account</h5>
                        <div class="setting-tab">
                            <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#personal_info" role="tab" aria-controls="" aria-selected="true">{{__('Personal Info')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#change_password" role="tab" aria-controls="" aria-selected="false">{{__('Change Password')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="personal_info" role="tabpanel" aria-labelledby="home-tab3">
                                    {{Form::model($userDetail,array('route' => array('update.account'), 'method' => 'put', 'enctype' => "multipart/form-data"))}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('name',__('Name'),array('class'=>'form-control-label'))}}
                                                {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>_('Enter User Name')))}}
                                                @error('name')
                                                <span class="invalid-name" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            {{Form::label('email',__('Email'),array('class'=>'form-control-label'))}}
                                            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))}}
                                            @error('email')
                                            <span class="invalid-email" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""></div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                                <div>
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new"> {{__('Select image')}} </span>
                                                        <span class="fileinput-exists"> {{__('Change')}} </span>
                                                        <input type="hidden">
                                                        <input type="file" name="profile" id="logo">
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> {{__('Remove')}} </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            <a href="{{ route('home') }}" class="btn btn-danger">{{__('Cancel')}}</a>
                                            @permission('edit-account')
                                            {{Form::submit('Save Change',array('class'=>'btn btn-primary'))}}
                                            @endpermission
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                                <div class="tab-pane fade" id="change_password" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="company-setting-wrap">
                                        {{Form::model($userDetail,array('route' => array('update.password-profile',$userDetail->id), 'method' => 'put'))}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('current_password',__('Current Password'),array('class'=>'form-control-label'))}}
                                                    {{Form::password('current_password',null,array('class'=>'form-control','placeholder'=>_('Enter Current Password')))}}
                                                    @error('current_password')
                                                    <span class="invalid-current_password" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{Form::label('new_password',__('New Password'),array('class'=>'form-control-label'))}}
                                                {{Form::password('new_password',null,array('class'=>'form-control','placeholder'=>_('Enter New Password')))}}
                                                @error('new_password')
                                                <span class="invalid-new_password" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                {{Form::label('confirm_password',__('Re-type New Password'),array('class'=>'form-control-label'))}}
                                                {{Form::password('confirm_password',null,array('class'=>'form-control','placeholder'=>_('Enter Re-type New Password')))}}
                                                @error('confirm_password')
                                                <span class="invalid-confirm_password" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 text-right">
                                                <a href="{{ route('company.setting') }}" class="btn btn-danger">{{__('Cancel')}}</a>
                                                @permission('change-password-account')
                                                {{Form::submit('Save Change',array('class'=>'btn btn-primary'))}}
                                                @endpermission
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
