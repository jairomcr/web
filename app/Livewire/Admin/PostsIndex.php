<?php

namespace App\Livewire\Admin;


use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
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
    public $tags;  
    public $selectedTags = []; 
  
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
    public $post;

    protected $postServicie;

    public $listeners = ['deleted'=>'deleted'];

    public function __construct()
    {
        $this->postServicie = new PostService();
    }

    public function mount()
    {
        $this->categories = $this->postServicie->getCategories();
        $this->tags = $this->postServicie->getTags();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    // En tu componente Livewire
    public function generateSlug()
    {
        $this->slug = $this->postServicie->generateSlug($this->name);
    }

    // Método para alternar entre mostrar el formulario y la lista de posts
    public function toggleCreateForm()
    {
        $this->isCreating = !$this->isCreating;
        $this->resetForm(); // Limpiar el formulario al alternar
    }

    public function createPost()
    {
        $data = [
            'name' => $this->name,
            'slug'=> $this->slug,
            'status' => $this->status,
            'extract' => $this->extract,
            'body' => $this->body,
            'category_id'=> $this->category_id,
            'selectedTags'=> $this->selectedTags,
        ];

        if ($this->image) {
            $data['image'] = $this->image;
        }
        
        $this->postServicie->createOrUpdatePost($data, $this->postId, $this->image);
        session()->flash('message', 'Artículo creado exitosamente.');
        $this->redirectRoute('admin.posts.index');
        $this->resetForm();
    }

    public function updatePost()
    {
        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'extract' => $this->extract,
            'body' => $this->body,
            'category_id' => $this->category_id,
            'selectedTags' => $this->selectedTags,
        ];

        

        $this->postServicie->createOrUpdatePost($data, $this->postId, $this->image);
        session()->flash('message', 'Artículo actualizado exitosamente.');
        $this->redirectRoute('admin.posts.index');
        $this->resetForm();
    }

    /* private function handlePostOperation()
    {
        $postId = $this->postId ?? null;
        
        $rules = PostRequest::getRules($this->status, $postId);
        $this->validate($rules);

        $userId = auth()->id(); // Cache the authenticated user ID
        $imagePath = $this->image ? $this->image->store('posts', 'public') : null;
        
        // Use a transaction to ensure data integrity
        DB::transaction(function () use ($postId, $userId, $imagePath) {
    
            if ($postId) {
                // Update existing post
                $post = Post::findOrFail($postId);
                if ($imagePath) {
                    if ($post->image) {
                        Storage::delete('public/' . $post->image->url);
                        $post->image->delete();
                    }
                    $post->image()->create(['url' => $imagePath]);
                }
                $post->update($this->pull([
                    'name',
                    'slug',
                    'status',
                    'extract',
                    'body',
                    'category_id',
                ]));
            } else {
                // Create new post
                $post = Post::create([
                    ...$this->pull([
                        'name',
                        'slug',
                        'status',
                        'extract',
                        'body',
                        'category_id',
                    ]),
                    'user_id' => $userId,
                ]);
                if ($imagePath) {
                    $post->image()->create(['url' => $imagePath]);
                }
            }

            // Sync tags
            $post->tags()->sync($this->selectedTags);
        });

        $this->redirectRoute('admin.posts.index');
        $this->resetForm();
    } */

    // Método para cargar un post en el formulario de edición
    public function editPost($id)
    {
        $post = $this->postServicie->getPostForEdit($id);

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

    // Método para eliminar un post
    public function deleted($postId)
    {
        $this->postServicie->deletePost($postId);
        $this->dispatch('alert', 'Artículo eliminado exitosamente.');
        
    }

    // Método para resetear el formulario
    public function resetForm($resetIsCreating = false)
    {
        //Limpiar los campos del formulario
        $this->reset(['name','slug','status', 'path_image','body','category_id','extract','postId','selectedTags']);

        // Emitir evento para limpiar CKEditor
        $this->dispatch('resetCKEditor');

        $this->post = null;

        if ($resetIsCreating) {
            $this->isCreating = false;
        }
    }

    public function render()
    {
        $posts = $this->postServicie->getPaginationPosts($this->search);
        return view('livewire.admin.posts-index', compact('posts'));
    }
}
