@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de categorías</h1>
@stop

@section('content')
   @livewire('admin.categories-index')
@stop

@section('css')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('alert',function(message){
            Swal.fire({
            title:"Buen trabajo!",
            text: message,
            icon: "success"
            });
        })    
    </script> 
@stop
