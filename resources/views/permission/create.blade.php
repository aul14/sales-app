@extends('layouts.global')
@section('title')
    Tambah Permission
@endsection

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card card-warning">
            <div class="card-body">
                <h5 class="form-header text-uppercase">
                    <i class="icon-social-pinterest icons"></i>
                     Tambah Permission
                  </h5>
                  <hr>
                  {!! Form::open(['url' => route('permission.store'), 'class' => 'form-horizontal']) !!}
                    <div class="form-group row">
                        <label class="col-4 col-form-label" for="example-input-normal">Key Permission</label>
                        <div class="col-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Permission'])!!}
                        </div>
                    </div>
                    @include('permission.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection
