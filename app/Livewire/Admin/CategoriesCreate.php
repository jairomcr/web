<?php

namespace App\Livewire\Admin;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Livewire\Component;

class CategoriesCreate extends Component
{
    public $open = false;
    public $name, $slug;
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }
    public function generateSlug()
    {
        $this->slug = $this->categoryService->generateSlug($this->name);
    }

    public function closeModal()
    {
        // Resetear las propiedades
        $this->reset(['open', 'name', 'slug']);

        // Resetear la validación
        $this->resetValidation();
    }

    public function save()
    {
        // Personalized messages
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.unique' => 'El slug ya está en uso.',
        ];
        
        // Validate the data
        $this->validate(CategoryRequest::rules(), $messages);

        //Save categories
        $this->categoryService->createCategory($this->name, $this->slug);

        // Reset the fields
        $this->reset(['open','name','slug']);

        //Broadcast events
        $this->dispatch('refresh');
        $this->dispatch('alert', 'Sea creado una nueva caregotía');
    }
    public function render()
    {
        return view('livewire.admin.categories-create');
    }
}
