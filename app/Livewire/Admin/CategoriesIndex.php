<?php

namespace App\Livewire\Admin;

use App\Models\Category;
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

    public function updatingSearch() {
        $this->resetPage();
    }
    

    public function render()
    {
        $categories = Category::where('name','like','%'. $this->search . '%')->orWhere('slug', 'like', '%' . $this->search . '%')->orderBy($this->sort,$this->direction)->paginate(6);

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
        $category = Category::find($categoryId)->first();
        if ($category) {
            $category->delete();
            $this->dispatch('alert', 'Categoría eliminada correctamente.');
        } else {
            $this->dispatch('alert', 'Categoría no encontrada.');
        }
        
    }
      
}
