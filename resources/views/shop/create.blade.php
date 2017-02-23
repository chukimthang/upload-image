@extends('layouts.app')

@section('content')
<div class="col-lg-7 col-md-offset-2">
    <h2 class="page-header" align="center">Create Shop</h2>

    <div class="form-error" style="color: red;"></div>
        
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('address', 'Address') !!}
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('avatar', 'Avatar') !!}
        {!! Form::file('avatar', ['id' => 'photo', 'accept' => 'image/*']) !!}
        {!! Form::submit('Upload', ['id' => 'upload']) !!}
        <div id="process" style="display: none">Process...</div>
        <p id="image-display"></p>
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script type="text/javascript" src="/js/upload-photo.js"></script>
<script>
    var upload = new uploadPhoto('{!! route('shop.uploadImage') !!}');
    upload.init();
</script>
@stop
