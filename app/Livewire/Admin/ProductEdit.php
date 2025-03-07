<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\Attributes\Computed;

class ProductEdit extends Component
{
    public int $product_id;

    public function closeEditProduct() {
        $this->dispatch("close_edit_product");
    }

    public function render()
    {
        return view('livewire.admin.product-edit');
    }
}
