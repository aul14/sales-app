@extends('layouts.global')
@section('title')
    Edit Pengguna
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-warning">
            <div class="card-body">
                <h5 class="form-header text-uppercase">
                    <i class="fa fa-user-circle-o"></i>
                     Edit User
                  </h5>
                  <hr>
                {!! Form::model($user, ['route' => ['user.update', $user->id], 'method'=>'put', 'class' => 'form-horizontal', 'id' => 'basic-form']) !!}
                    @include('user.form-edit')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection