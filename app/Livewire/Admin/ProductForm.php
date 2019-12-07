<?php

namespace App\Livewire\Admin;


use App\Models\Product;
use App\Services\ProductService;
use InvalidArgumentException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductForm extends Component
{

    use WithFileUploads;

    public string $mode;

    public int $product_id = -1;

    #[Validate('required')]
    public string $name = '';


    #[Validate('required|min:1')]
    public $price = 0;

    public $img;

    #[Validate('required')]
    public string $info = '';

    #[Validate('required')]
    public string $desc = '';

    public function save(ProductService $service)
    {
        $this->validate();
        
        match ($this->mode) {
            'create' => $this->validate([
                'img' => 'required|image|max:2028'
            ]),
            'edit' => $this->validate([
                'img' => 'nullable|image|max:2028'
            ]),
            default => throw new InvalidArgumentException(
                "Property mode can only have the following states 'create|update'"
            )
        };

        match ($this->mode) {
            'create' => $service->store(
                collect($this->only(['name', 'price', 'info', 'desc', 'img']))
            ),
            
            'edit' => $service->update(
                $this->product_id,
                collect($this->only(['name', 'price', 'info', 'desc', 'img']))
            ),

            default => throw new InvalidArgumentException(
                "Property mode can only have the following states 'create|update'"
            )
        };
        
        $this->redirectRoute('admin.products.index');
    }


    public function mount(ProductService $service) {
        if ($this->product_id != -1) {
            $this->fill(
                $service->find($this->product_id)
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.product-form');
    }
}
