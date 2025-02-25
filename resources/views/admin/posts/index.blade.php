@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Listado de Posts</h1>
@stop

@section('content')
   
   @livewire('admin.posts-index')
@stop

@section('css')

@stop

@section('js')
<!-- CKEditor 5 con defer -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        Livewire.on('deletePost', postId => {
            Swal.fire({
                title: "¿Estas seguro?",
                text: "¡No podrás revertir esto.!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrarlo",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleted', {
                        postId: postId
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

<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!"); 
</script>
@stop