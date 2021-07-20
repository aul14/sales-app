@extends('layouts.global')
@section('title')
    Reset Password
@endsection

@section('content')
<div class="row">
    <div class="col-6">
            <div class="card card-warning">
                <div class="card-body">
                    <div class="icon-user-follow float-right">
                        <i class="fas fa-question-circle font-24 mt-2 text-primary"></i>
                    </div>
                    <h5 class="icon-question"> Ganti Password</h5>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Nama User</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Email User</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Hak Akses</td>
                                <td>{{$user->display_name}}</td>
                            </tr>
                        </table>
                        <hr>
                        {!! Form::model($user, ['url' => route('update.password', $user->id), 'method' => 'post']) !!}
                            <div class="form-group xs-pt-10 {{ $errors->has('password') ? ' has-error' : ''}}">
                                {!! Form::label('password', 'Masukan Password Baru', ['class' => 'control-label'])!!}
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukan Password'])!!}
                                {!! $errors->first('password', '<p class="text-danger">:message</p>')!!}
                            </div>
                            <div class="form-footer">
                                <a href="{{ route('user.index') }}" class="btn btn-danger"><i class="fa fa-hand-o-left"></i> KEMBALI</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection