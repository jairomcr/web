<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndexItem extends Component
{
    public Product $product;


    public function edit()
    {
        $this->dispatch("show_edit_modal", id: $this->product->id);
    }

    public function delete()
    {
        (new ProductService)->delete($this->product->id);
        $this->redirectRoute('admin.products.index');
    }

    public function toggle_activation()
    {
        // If it's active (2) then the new status will be inactive (1), and vice-versa
        $newStatus = $this->product->status == 2 ? 1 : 2;
        (new ProductService)->set_product_status($this->product->id, $newStatus);
        $this->redirectRoute('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.product-index-item');

    }


}
