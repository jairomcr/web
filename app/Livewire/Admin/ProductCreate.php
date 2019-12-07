<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\On;
use Livewire\Component;
use Storage;

class ProductCreate extends Component
{
    public int $product_id;

    public function closeCreateProduct() {
        $this->dispatch("close_create_product");
    }
    public function render()
    {
        return view('livewire.admin.product-create');
    }
}
