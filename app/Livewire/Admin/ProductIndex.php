<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ProductIndex extends Component
{
    use WithPagination;
    public string $paginationTheme = "bootstrap";

    public string $currentSearchProduct;

    public bool $isCreating= false;
    public bool $isEditing = false;

    #[Computed]
    public function filteredProducts() {
        if (empty($this->currentSearchProduct)) return Product::where('user_id', auth()->user()->id)->latest('id')->paginate(3);

        $filProducts = Product::where('name','like', '%' . $this->currentSearchProduct . '%')->latest('id')->paginate(3);
        return $filProducts;
    }

    public function showCreateForm() {
        $this->isCreating = true;
    }

    public function render()
    {
        return view('livewire.admin.product-index', [
            'products' => Product::paginate(3)
        ]);
    }
}
