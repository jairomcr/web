<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Livewire\Component;

class CategoriesEdit extends Component
{
    public $open = false;
    public $category;
    public $categoryName;
    public $categorySlug;
    protected $categoryService;

    public function __construct(){
        $this->categoryService = app(CategoryService::class);
    }

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
        $this->categorySlug = $this->categoryService->generateSlug($title);
    }
    public function updatedCategoryName($value)
    {
       $this->categoryService->generateSlug($value);
    }

    public function save()
    {
        $this->validate();

        // Actualiza las propiedades de la categoría
        $this->categoryService->updateCategory(
            $this->category,
            $this->categoryName,
            $this->categorySlug,
        );

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
