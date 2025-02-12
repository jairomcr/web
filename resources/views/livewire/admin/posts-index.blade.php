<div>
    <!-- Botón para alternar entre crear y ver posts -->
    <button wire:click="toggleCreateForm" class="btn btn-primary mb-3">
        {{ $isCreating ? 'Listado Artículos' : 'Crear Nuevo Artículos' }}
    </button>

    <!-- Formulario de creación -->
    @if ($isCreating)
    
    <div class="card mb-3">
        <div class="card-body">
            <form wire:submit.prevent="{{ $postId ? 'updatePost' : 'createPost' }}">
                <div class="row">
                    <div class="col">
                        <x-adminlte-input name="name" type="text" wire:model="name" label="Título:"
                            placeholder="Ingrese el título del artículo..." fgroup-class="col-md-12" disable-feedback />
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="col">
                        <x-adminlte-input name="slug" type="text" wire:model="slug" label="Slug:"
                            placeholder="Ingrese el slug del artículo..." fgroup-class="col-md-12" disable-feedback
                            disabled />
                        @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="category_id">Categoría</label>
                    <select wire:model="category_id" class="form-control" id="category_id">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
    
                <!-- Campo para seleccionar tags con checkboxes -->
                <div class="form-group">
                    <label>Tags:</label>
                    <div class="row">
                        @foreach ($tags as $tag)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}"
                                    id="tag_{{ $tag->id }}" class="form-check-input">
                                <label for="tag_{{ $tag->id }}" class="form-check-label">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('selectedTags') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
    
                <div class="form-group">
                    <label for="extract">Extracto:</label>
                    <textarea wire:model="extract" class="form-control" id="extract" rows="3"></textarea>
                    @error('extract') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
    
                <!-- Campo para el cuerpo del artículo con CKEditor 5 y Alpine.js -->
                <div class="form-group">
                    <label for="body">Cuerpo:</label>
                    <div x-data="{ ckeditor: null }" x-init="
                        let interval = setInterval(() => {
                            if (typeof ClassicEditor !== 'undefined') {
                                clearInterval(interval); // Detener el intervalo
                                ClassicEditor
                                    .create(document.querySelector('#editor'), {
                                        toolbar: [
                                            'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload', 'undo', 'redo'
                                        ]
                                    })
                                    .then(editor => {
                                        ckeditor = editor;
                                        editor.model.document.on('change:data', () => {
                                            $wire.set('body', editor.getData());
                                        });
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            }
                        }, 100);
                    ">
                        <textarea wire:model="body" id="editor" class="form-control" rows="3"></textarea>
                    </div>
                    @error('body') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
    
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>
    </div>
    @else
    '{{--  --}}
    <!-- List of posts -->
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->name }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <p class="card-text"><small class="text-muted">{{ $post->category->name }}</small></p>

                    {{-- Edit and delete buttons --}}
                    <div class="d-flex justify-content-end mt-3">
                        <button wire:click="editPost({{$post->id}})" class="btn- btn-primary btn-sm mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="deletePost({{$post->id}})" class="btn- btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{ $posts->links() }}
    @endif
    
</div>

{{-- <div class="card">

    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre de un artículos">
    </div>
    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Creado por</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->user->name}}</td>
                        <td width="10px">
                            <a href="{{route('admin.posts.edit',$post)}}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow edit-button">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                        </td>
                        <td width="10px">
                            {{-- Deleting the posts --}}
                            {{-- {!! html()->form('POST', route('admin.posts.destroy', $post))->open() !!}
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                onclick="confirmation(event)">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                            {!! html()->form()->close() !!} --}}
                       {{--  </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
        <div class="footer px-3">
            {{$posts->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún artículo con ese nombre ....</strong>
        </div>
        
    @endif
</div> --}}


