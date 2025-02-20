<?php

namespace App\Livewire\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Livewire\Component;

class CategoriesCreate extends Component
{
    public $open = false;
    public $name,$slug;

    public function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug); // Replace non-alphanumeric characters
        $slug = preg_replace('/(^-|-$)/', '', $slug); // Remove beginning and end dashes
        $this->slug = $slug;
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
        $request = $this->validate(CategoryRequest::rules(), $messages);

        //Save categories
        Category::create([ 
            "name"=> $request,
            "slug"=> $request,
        ]);

        // Reset the fields
        $this->reset(['open','name','slug']);

        //Broadcast events
        $this->dispatch('categories-index','render');
        $this->dispatch('alert', 'Sea creado una nueva caregotía');
    }
    public function render()
    {
        return view('livewire.admin.categories-create');
    }
}
