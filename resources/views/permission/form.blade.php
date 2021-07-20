<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Module</label>
    <div class="col-8">
        {!! Form::select('module_id', [''=>'- Pilih Module -']+App\Module::pluck('name','id')->all(), null, ['class' => 'form-control select2']) !!}
        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Display Name</label>
    <div class="col-8">
        {!! Form::text('display_name', null, ['class' => $errors->has('display_name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Display Name'])!!}
        @error('display_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label" for="example-input-normal">Description</label>
    <div class="col-8">
        {!! Form::text('description', null, ['class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Deskripsi'])!!}
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-footer">
    <a href="{{ route('permission.index') }}" class="btn btn-danger"><i class="fa fa-hand-o-left"></i> KEMBALI</a>
    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
</div>
