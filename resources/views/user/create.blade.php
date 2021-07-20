@extends('layouts.global')
@section('title')
    Tambah User
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-warning">
            <div class="card-body">
                <h5 class="form-header text-uppercase">
                    <i class="fa fa-user-circle-o"></i>
                     Tambah User
                  </h5>
                  <hr>
                {!! Form::open(['url' => route('user.store'), 'class' => 'form-horizontal']) !!}
                    @include('user.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection