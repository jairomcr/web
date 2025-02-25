<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoriesEdit extends Component
{
    public $open = false;
    public $category;
    public $categoryName;
    public $categorySlug;

    protected function rules()
    {
        return [
            'categoryName' => 'required|min:3',
            'categorySlug' => 'required|unique:categories,slug,' . ($this->category->id ?? 'NULL'), 
        ];
    }

    protected function messages()
    {
        return [
            'categoryName.required' => 'El nombre de la categoría es obligatorio.',
            'categoryName.min' => 'El nombre de la categoría debe tener al menos :min caracteres.',
            'categorySlug.required' => 'El slug de la categoría es obligatorio.',
            'categorySlug.unique' => 'El slug ya está en uso. Por favor, elige otro.',
        ];
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->categoryName = $category->name;
        $this->categorySlug = $category->slug;
    }

    public function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug); // Reemplaza caracteres no alfanuméricos
        $slug = preg_replace('/(^-|-$)/', '', $slug); // Elimina guiones al principio y al final
        $this->categorySlug = $slug;
    }

    public function updatedCategoryName($value)
    {
        $this->generateSlug($value);
    }

    public function save()
    {
        $this->validate();

        // Actualiza las propiedades de la categoría
        $this->category->name = $this->categoryName;
        $this->category->slug = $this->categorySlug;

        // Guarda la categoría
        $this->category->save();

        // Reset the fields
        $this->reset(['open']);

        //Broadcast events
        $this->dispatch('refresh');
        $this->dispatch('alert', 'Sea  actualizado la caregotía correctamente');
    }

    public function closeModal()
    {
        $this->open = false;

        // Resetea la validación
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.categories-edit');
    }
}
