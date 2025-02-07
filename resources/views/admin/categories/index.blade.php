@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de categorías</h1>
@stop

@section('content')
   @if (session('success'))
       <x-adminlte-alert theme="success" title="{{session('success')}}" dismissable>
        </x-adminlte-alert>
   @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.categories.create') }}">Agregar categorías</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                                <a href="#" class="btn btn-xs btn-default text-primary mx-1 shadow edit-button"
                                    data-toggle="modal" data-target="#editModal" data-category-id="{{ $category->id }}"
                                    data-category-name="{{ $category->name }}" data-category-slug="{{ $category->slug }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            </td>
                            <td width="10px">
                                {{-- Deleting the categories --}} 
                                {{ html()->form('POST', route('admin.categories.destroy', $category))->open() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                    onclick="confirmation(event)">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                                {{ html()->form()->close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Edit Modal --}}
    <x-adminlte-modal id="editModal" title="Editar Categoría" theme="primary" icon="fas fa-pen" disable-animations>
        {!! html()->form('POST', route('admin.categories.update', $category))->open() !!}
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}

        {{-- This is to display a message --}}
        <div id="successMessage" class="alert alert-success mt-3" style="display: none;"></div>

        <div class="form-group">
            {!! html()->input('hidden', 'id')->class('form-control') !!}
        </div>

        <div class="form-group">
            {!! html()->label('name', 'Nombre') !!}
            {!! html()->input('text', 'name')->class('form-control')->placeholder('Ingrese el nombre de la categoría')->id('editCategoryName') !!}

            {{-- This is to show the name error --}}
            <div id="nameError" class="text-danger mt-2" style="display: none;"></div>
        </div>

        <div class="form-group">
            {!! html()->label('slug', 'Slug') !!}
            {!! html()->input('text', 'slug')->class('form-control')->attribute('readonly', 'readonly')->id('editCategorySlug') !!}

            {{-- This is to show the slug error --}}
            <div id="slugError" class="text-danger mt-2" style="display: none;"></div>
        </div>

        <div class="form-group">
            {!! html()->button('Guardar categoría')->class('btn btn-primary')->type('submit') !!}
        </div>
        {!! html()->form()->close() !!}
        
        {{-- Modal Footer --}}
        <x-slot name="footerSlot">
            <x-adminlte-button theme="secondary" label="Cerrar" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>

@stop

@section('css')
@stop

@section('js')
    {{-- Plugin to create the slug --}}
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    {{-- Library to use sweetalert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var form = ev.currentTarget.closest('form'); // Get the form closest to the button
    
            swal({
                title: "¿Estás seguro de eliminar esto?",
                text: "No podrás revertir esta acción",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit(); // Send the form if the user confirms
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#editModal').on('shown.bs.modal', function() {
                $("#editCategoryName").stringToSlug({
                    setEvents: 'keyup keydown blur',
                    getPut: '#editCategorySlug',
                    space: '-'
                });
            });

            var $editForm = $('#editModal form'); // Cache the selector

            $('.edit-button').on('click', function() {
                var categoryId = $(this).data('category-id');
                var categoryName = $(this).data('category-name');
                var categorySlug = $(this).data('category-slug');

                $('#editCategoryName').val(categoryName);
                $('#editCategorySlug').val(categorySlug);

                // Use backticks to interpolate the URL
                $editForm.attr('action', `/admin/categories/${categoryId}`);
            });

            $editForm.on('submit', function(e) {
                e.preventDefault(); // Avoid normal form submission

                // Get the form URL
                var url = $(this).attr('action');

                // Clear previous error messages
                $('#nameError').hide().text('');
                $('#slugError').hide().text('');

                // Send the request as POST with _method=PUT
                $.ajax({
                    url: url,
                    method: 'POST', // Switch to POST
                    data: $(this).serialize() + '&_method=PUT', // Add _method=PUT
                    success: function(response) {
                        // Show success message in modal
                        $('#successMessage').text('La categoría se ha actualizado correctamente.').fadeIn();
                        // Close the modal after 3 seconds
                        setTimeout(function() {
                            $('#editModal').modal('hide'); // Close the modal
                            window.location.reload(); // Reload the page
                        }, 3000); // 3 second delay
                    },
                    error: function(xhr) {
                        // Handle errors
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            // Show errors below the corresponding entries
                            if (errors.name) {
                                $('#nameError').text(errors.name[0]).show();
                            }
                            if (errors.slug) {
                                $('#slugError').html(errors.slug.join('<br>')).show();
                            }
                        } else {
                            // Show a generic message if there are no specific errors
                            alert('Ocurrió un error al actualizar la categoría.');
                        }
                    }
                });
            });
        });
    </script>
@stop
