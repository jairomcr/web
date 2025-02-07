@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Crear categorias</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! html()->form('POST', route('admin.categories.store'))->open() !!}
        {!! csrf_field() !!}

        <div class="form-group">
           {!! html()->label('name', 'Nombre') !!}
           {!! html()->input('text', 'name')->class('form-control')->placeholder('Ingrese el nombre de la categoría') !!}

            @error('name')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! html()->label('slug', 'Slug') !!}
            {!! html()->input('text', 'slug')->class('form-control')->attribute('readonly', 'readonly') !!}
            @error('slug')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! html()->button('Crear categoría')->class('btn btn-primary') !!}
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
<script>
    $(document).ready( function() {
    $("#name").stringToSlug({
    setEvents: 'keyup keydown blur',
    getPut: '#slug',
    space: '-'
    });
    });
</script>
@stop