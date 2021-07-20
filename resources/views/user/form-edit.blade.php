
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Nama Pengguna</label>
    <div class="col-8">
        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nama Pengguna']) !!}
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Email</label>
    <div class="col-8">
        {!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'user@gmail.com']) !!}
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">No Telpon</label>
    <div class="col-8">
        {!! Form::number('no_hp', null, ['class' => $errors->has('no_hp') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '012345678']) !!}
        @error('no_hp')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Hak Akses</label>
    <div class="col-8">
        {!! Form::select('role_id', [''=>'Hak Akses']+App\Role::whereNotIn('name', ['member'])->pluck('name','id')->all(), null, ['class' => 'form-control select2']) !!}
        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Jenis Kelamin</label>
    <div class="col-8">
        {!! Form::select('gender', [''=>'Jenis Kelamin']+['1'=>'Laki - Laki', '2'=>'Perempuan'], null, ['class' => 'form-control select2']) !!}
        @error('gender')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Alamat</label>
    <div class="col-8">
        {!! Form::textarea('alamat', null, ['class' => $errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Alamat']) !!}
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-footer">
    <a href="{{ route('user.index') }}" class="btn btn-danger"><i class="fa fa-hand-o-left"></i> KEMBALI</a>
    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
</div>
