@extends('layouts.app')

@section('content')
<div class="col-lg-7 col-md-offset-2">
    <h2 class="page-header" align="center">Create Product</h2>

    <div class="form-error" style="color: red;"></div>
        
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Price') !!}
        {!! Form::text('price', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', null, 
            ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Image') !!}
        {!! Form::file('image', [
            'id' => 'photo-product', 
            'accept' => 'image/*',
        ]) !!}
        <br>
        {!! Form::submit('Upload', [
            'id' => 'upload-product',
            'class' => 'btn btn-default'
        ]) !!}

        <div id="process-product" style="display: none">Process...</div>
        <p id="display-product"></p>
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script type="text/javascript" src="/js/product.js"></script>
<script>
    var product = new product();
    product.init();
</script>
@stop
