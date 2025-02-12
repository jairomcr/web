<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;
    public string $paginationTheme = "bootstrap";

    public string $name = "YMS";
    public function render()
    {
        return view('livewire.admin.product-index', [
            'products' => Product::latest('id')->paginate(3)
        ]);
    }
}
