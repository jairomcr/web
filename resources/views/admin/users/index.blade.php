@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Listado de Usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('alert', function(message) {
                Swal.fire({
                    title: "¡Buen trabajo!",
                    text: message,
                    icon: "success"
                });
            })
            Livewire.on('deleteUser', userId => {
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto.!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, borrarlo",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleted', {
                            userId: userId
                        });
                        Livewire.on('alert',function(message){
                            Swal.fire({
                            title: "¡Eliminar!",
                            text: message,
                            icon: "success",
                            confirmButtonText: "Continuar",
                            });
                        });  
                    }
                });
            });
    </script>
@stop