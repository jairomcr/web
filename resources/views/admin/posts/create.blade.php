@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Crear un nuevo post</h1>
@stop

@section('content')
   <div class="card">
    <div class="card-body">
        {!! html()->form('POST', route('admin.posts.store'))->open() !!}
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="name" label="Título:" placeholder="Ingrese el título del artículo..."
                        fgroup-class="col-md-12"  disable-feedback />
                </div>

                <div class="col">
                    <x-adminlte-input name="slug" type="text" label="Slug:" 
                        placeholder="Ingrese el slug del artículo..." fgroup-class="col-md-12" wire:model="name"
                        disable-feedback disabled />
                </div>
                <div class="col-lg-3">
                    {!! html()->label('Categoria:','category_id') !!}
                    {!! html()->select('category_id', $categories)->class('form-control') !!}
                </div>
            </div>
            <x-adminlte-button label="Guardar" theme="primary" />
        {!! html()->form()->close() !!}
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!"); 
</script>
@stop