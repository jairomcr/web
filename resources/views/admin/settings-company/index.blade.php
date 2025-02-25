@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Configuración</h1>
@stop

@section('content')
@livewire('admin.settings-index')
@stop

@section('css')
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
        Livewire.on('deleteCategory', categoryId => {
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
                        categoryId: categoryId
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