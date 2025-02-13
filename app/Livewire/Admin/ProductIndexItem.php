<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndexItem extends Component
{
    public Product $product;
    public function render()
    {
        return view('livewire.admin.product-index-item');
    }
}
