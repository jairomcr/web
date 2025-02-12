@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
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
<!-- CKEditor 5 con defer -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js" defer></script>

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

<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!"); 
</script>
@stop