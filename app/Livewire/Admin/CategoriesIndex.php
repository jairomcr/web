<?php

namespace App\Livewire\Admin;


use App\Services\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $name,$slug,$search="",$sort='id',$direction='desc';
    public $categoryId;
    //public $categories;
  
    protected $listeners = ['refresh' => '$refresh', 'deleted'];
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    

    public function render()
    {
        $categories = $this->categoryService->getPaginationCategories($this->search,$this->sort,$this->direction);
        return view('livewire.admin.categories-index',compact('categories'));
    }

    public function order($sort) {
        if ($this->sort == $sort) {

           if ($this->direction == 'desc') {
            $this->direction = 'asc';
           } else {
            $this->direction = 'desc';
           }
           
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    
    }
    public function deleted($categoryId): void
    {
        $this->categoryService->deleteCategory($categoryId);
        $this->dispatch('alert', 'Categoría eliminada correctamente.');
    }
      
}
