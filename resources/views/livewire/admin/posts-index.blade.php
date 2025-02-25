<div>
    <!-- Mensaje de alerta -->
    <div>
        @if (session()->has('message'))
        <x-adminlte-alert theme="success" title="{{ session('message') }}" dismissable></x-adminlte-alert>
        @endif
    </div>
    
    <div class="d-flex flex-column flex-md-row align-items-center mb-3">
        <!-- Botón -->
        <div class="col mb-md-0 me-md-3 mb-2">
            <!-- Margen inferior en móviles y margen derecho en desktop -->
            <button wire:click="toggleCreateForm" class="btn btn-primary btn-sm" style="width: 150px; height: 40px;">
                {{ $isCreating ? 'Listado Artículos' : 'Crear Nuevo Artículos' }}
            </button>
        </div>
    
        <!-- Input con ícono de búsqueda -->
        @if (!$isCreating)
        <div class="w-100 w-md-auto">
            <div class="input-group">
                <input type="text" wire:model.live="search" class="form-control"
                    placeholder="Buscar nombre del artículo...">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        @endif
    </div>

    <!-- Formulario de creación -->
    @if ($isCreating)
        <div class="card mb-3">
            <div class="card-body">
                <form wire:submit.prevent="{{ $postId ? 'updatePost' : 'createPost' }}">
                    @csrf
                    <div class="row" x-data="{ slug: '' }" x-init="slug = @js($slug)">
                        <div class="col">
                            <!-- Campo "name" -->
                            <x-adminlte-input name="name" type="text" wire:model="name" label="Título:"
                                placeholder="Ingrese el título del artículo..." fgroup-class="col-md-12"
                                disable-feedback
                                x-on:input.debounce.500ms="
                                $wire.set('name', $event.target.value);
                                $wire.generateSlug($event.target.value);
                            " />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <!-- Campo "slug" -->
                            <x-adminlte-input name="slug" type="text" wire:model="slug" label="Slug:"
                                placeholder="Ingrese el slug del artículo..." fgroup-class="col-md-12" disable-feedback
                                disabled x-model="slug" />
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        @error('selectedTags')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Estado:</label>
                        <div class="form-check">
                            <input type="radio" wire:model="status" class="form-check-input" id="status_published"
                                value="2">
                            <label class="form-check-label" for="status_published">
                                Publicado
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" wire:model="status" class="form-check-input" id="status_deleted"
                                value="1">
                            <label class="form-check-label" for="status_deleted">
                                Borrado
                            </label>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Imagen:</label>
                        <input type="file" wire:model="image" class="form-control" id="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <!-- Mostrar la imagen actual o la nueva imagen seleccionada -->
                        @if ($postId && $path_image && !$image)
                            <!-- Si hay una imagen existente, mostrarla -->
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $path_image) }}" alt="Imagen actual" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        @elseif ($image)
                            <!-- Si se ha seleccionado una nueva imagen, mostrar la vista previa -->
                            <div class="mt-2">
                                <img src="{{ $image->temporaryUrl() }}" alt="Imagen seleccionada" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="extract">Extracto:</label>
                        <textarea wire:model="extract" class="form-control" id="extract" rows="3"></textarea>
                        @error('extract')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el cuerpo del artículo con CKEditor 5 y Alpine.js -->
                    <div class="form-group" >
                        <label for="body">Cuerpo:</label>
                        <div wire:ignore x-data="{ ckeditor: null }" x-init="// Inicializar CKEditor al cargar el componente
                        (function() {
                            if (typeof ClassicEditor !== 'undefined') {
                                ClassicEditor.create(document.querySelector('#editor'), {
                                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload', 'undo', 'redo']
                                    })
                                    .then(editor => {
                                        ckeditor = editor;
                                        editor.setData(@js($body)); // Establecer el contenido inicial
                                        editor.model.document.on('change:data', () => {
                                            $wire.set('body', editor.getData());
                                        });
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            }
                        })();
                        
                        // Escuchar el evento de Livewire para actualizar CKEditor
                        Livewire.on('updateCKEditor', (content) => {
                            if (ckeditor) {
                                ckeditor.setData(content); // Actualizar el contenido de CKEditor
                            }
                        });
                        
                        // Escuchar el evento de Livewire para limpiar CKEditor
                        Livewire.on('resetCKEditor', () => {
                            if (ckeditor) {
                                ckeditor.setData(''); // Limpiar el contenido de CKEditor
                            }
                        });">
                            <textarea wire:model="body" id="editor" class="form-control" rows="3"></textarea>
                        </div>
                        @error('body')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" wire:click="resetForm(true)" class="btn btn-secondary">Cancelar</button>
                </form>
            </div>
        </div>
    @else
        <!-- List of posts -->
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body" wire:key="post-{{$post->id}}">
                            <h1 class="card-title">{{ $post->name }}</h1>
                            <p class="card-text">{{ Str::limit($post->extract, 100) }}</p>
                            <p class="card-text"><small class="text-muted">{{ $post->category->name }}</small></p>

                            {{-- Edit and delete buttons --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button wire:click="editPost({{ $post->id }})"
                                    class="btn- btn-primary btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="dispatch('deletePost',{ postId : {{$post->id}}})"
                                    class="btn- btn-danger btn-sm">
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
