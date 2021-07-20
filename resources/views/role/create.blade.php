@extends('layouts.global')
@section('title')
    Tambah Role
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card card-warning">
            <div class="card-body">
                <h5 class="form-header text-uppercase">
                    <i class="icon-organization icons"></i>
                     Tambah Role
                  </h5>
                  <hr>
                {!! Form::open(['url' => route('role.store'), 'class' => 'form-horizontal']) !!}
                    @include('role.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
