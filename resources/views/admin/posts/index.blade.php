@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.posts.create') }}">Nuevo artículo</a>
<h1>Listado de Posts</h1>
@stop

@section('content')
   
   @livewire('admin.posts-index')
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