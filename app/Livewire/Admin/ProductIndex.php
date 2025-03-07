<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Str;
use Livewire\Attributes\On; 

use App\Services\ProductService;

class ProductIndex extends Component
{
    use WithPagination;
    public string $paginationTheme = "bootstrap";

    public string $currentSearchProduct;

    public int $currentProductId = -1;

    public bool $isEditing = false;
    public bool $isCreating = false;

    #[Computed]
    public function filteredProducts()
    {
        $productService = app(ProductService::class);
        return $productService->getSimilarProductsBy('name', $this->currentSearchProduct)->paginate(3);
    }

    #[On('show_edit_modal')]
    public function onProductEdit(int $id) {
        $this->currentProductId = $id;
        $this->isEditing = true;
    }

    public function toggleCreateModal() {
        $this->isCreating = !$this->isCreating;
    }

    public function toggleEditModal() {
        $this->isEditing = !$this->isEditing;
    }

    public function render(ProductService $productService)
    {
        return view('livewire.admin.product-index', [
            'products' => $productService->latest()->paginate(3),
        ]);
    }
}
