<?php namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search = "";
    public $categories;
    public $tags;  //Listados de todos los tags disponibles
    public $selectedTags = []; // Tags seleccionados en el formulario

    // Propiedades para el formulario de creación y edición
    public $name;
    public $slug;
    public $extract;
    public $body;
    public $category_id;
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

    // Método para alternar entre mostrar el formulario y la lista de posts
    public function toggleCreateForm()
    {
        $this->isCreating = !$this->isCreating;
        $this->resetForm(); // Limpiar el formulario al alternar
    }

    // Método para crear un nuevo post
    public function createPost()
    {
        $this->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'extract' => $this->extract,
            'body'    => $this->body,  
            'category_id' => $this->category_id,
            'user_id' => auth()->user()->id,
        ]);

        //Asignar los tags seleccionados al formulario
        $post->tags()->sync($this->selectedTags);

        // Limpiar el formulario
        $this->resetForm();

        // Mostrar un mensaje de éxito
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
        $this->extract = $post->extract;
        $this->body    = $post->body;
        $this->category_id = $post->category_id;
        $this->selectedTags = $post->tags->pluck('id'); //Cargar Tags seleccionados

        // Mostrar el formulario de edición
        $this->isCreating = true;
    }

    // Método para actualizar un post
    public function updatePost()
    {
        $this->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::findOrFail($this->postId);

        $post->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'extract' => $this->extract,
            'body'    => $this->body,
            'category_id' => $this->category_id,
        ]);

        //Asignar los tags seleccionados al formulario
        $post->tags()->sync($this->selectedTags);

        // Limpiar el formulario
        $this->resetForm();

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
    public function resetForm()
    {
        $this->reset(['name', 'slug', 'category_id', 'body','extract', 'postId', 'selectedTags']);
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
