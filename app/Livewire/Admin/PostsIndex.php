<?php

namespace App\Livewire\Admin;

use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = "bootstrap";

    public $search = "";
    public $categories;
    public $tags;  //Listados de todos los tags disponibles
    public $selectedTags = []; // Tags seleccionados en el formulario

    // Propiedades para el formulario de creación y edición
    public $name = "";
    public $slug = "";
    public $extract = "";
    public $body = "";
    public $category_id;
    public $image;
    public $path_image = "";
    public $status =  1;
    public $isCreating = false;
    public $postId = null; // Para almacenar el ID del post que se está editando

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id');
        $this->tags = Tag::all(); //Obtener todos los tags
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    // En tu componente Livewire
    public function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug); // Reemplazar caracteres no alfanuméricos
        $slug = preg_replace('/(^-|-$)/', '', $slug); // Eliminar guiones al inicio y al final
        $this->slug = $slug;
    }

    // Método para alternar entre mostrar el formulario y la lista de posts
    public function toggleCreateForm()
    {
        $this->isCreating = !$this->isCreating;
        $this->resetForm(); // Limpiar el formulario al alternar
    }

    // Método para crear un nuevo post
    public function createPost()
    {
        //Obtener las reglas  de validacion
        $rules = CreatePostRequest::getRules($this->status);

        //Validar  los datos del formulario
        $this->validate($rules);


        // Guardar la imagen en el sistema de archivos
        $imagePath = $this->image ? $this->image->store('posts', 'public') : null; // Guardar en storage/app/public/posts

        // Crear el post
        $post = Post::create([
            ...$this->pull([
                'name',
                'slug',
                'status',
                'extract',
                'body',
                'category_id',
                'image'
            ]),
            'user_id' => auth()->user()->id,
        ]);


        // Guardar la imagen en la base de datos
        if ($imagePath) {
            $post->image()->create([
                'url' => $imagePath, // Guardar la ruta de la imagen
            ]);
        }

        // Asignar los tags seleccionados al post
        $post->tags()->sync($this->selectedTags);


        // Mostrar un mensaje de éxito
        $this->redirectRoute('admin.posts.index');
        session()->flash('message', 'Post creado exitosamente.');
    }

    // Método para cargar un post en el formulario de edición
    public function editPost($id)
    {
        $post = Post::findOrFail($id);

        // Asignar los valores del post al formulario
        $this->postId = $post->id;
        $this->name = $post->name;
        $this->slug = $post->slug;
        $this->status = $post->status;
        $this->extract = $post->extract;
        $this->body = $post->body;
        $this->category_id = $post->category_id;
        $this->selectedTags = $post->tags->pluck('id')->toArray();
        $this->path_image = $post->image ? $post->image->url : null; // Asignar la imagen actual del post

        // Mostrar el formulario de edición
        $this->isCreating = true;

        // Emitir el evento para reinicializar CKEditor
        $this->dispatch('reinitializeCKEditor');
    }

    // Método para actualizar un post
    public function updatePost()
    {
        //Obtener las reglas  de validacion
        $rules = CreatePostRequest::getRules($this->status);

        //Validar  los datos del formulario
        $this->validate($rules);


        $post = Post::findOrFail($this->postId);

        // Si se subió una nueva imagen, guardarla
        if ($this->image) {
            // Eliminar la imagen anterior si existe
            if ($post->image) {
                Storage::delete('public/' . $post->image->url);
                $post->image->delete();
            }

            // Guardar la nueva imagen en la carpeta storage/app/public/posts
            $imagePath = $this->image->store('posts', 'public');

            //Crear una nueva imagen en la base de datos con la relacion polimorfica
            $post->image()->create([
                'url' => $imagePath,
            ]);
        }

        $post->update([
            ...$this->pull([
                'name',
                'slug',
                'status',
                'extract',
                'body',
                'category_id',
                'image'
            ]),
        ]);

        // Asignar los tags seleccionados al post
        $post->tags()->sync($this->selectedTags);

        // Limpiar el formulario
        $this->resetForm();

        $this->redirectRoute('admin.posts.index');
        // Mostrar un mensaje de éxito
        session()->flash('message', 'Post actualizado exitosamente.');
    }

    // Método para eliminar un post
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        // Mostrar un mensaje de éxito
        session()->flash('message', 'Post eliminado exitosamente.');
    }

    // Método para resetear el formulario
    public function resetForm($resetIsCreating = false)
    {
        // Emitir evento para limpiar CKEditor
        $this->dispatch('resetCKEditor');

        if ($resetIsCreating) {
            $this->isCreating = false;
        }
    }

    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
