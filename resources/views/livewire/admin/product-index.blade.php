<div>
    <div class="row container-fluid">
        <button class="btn btn-primary col-2" data-toggle="modal" data-target="#createModal">Nuevo</button>
        <input id="search" name="search" value="" class="form-control col-sm" type="text"
            placeholder="Buscar producto" wire:model.live="currentSearchProduct">
    </div>

    <livewire:admin.product-create />
    <livewire:admin.product-edit />

    <hr>
    @if (empty($currentSearchProduct))
        <div class="row">
            @foreach ($products as $product)
                <livewire:admin.product-index-item :product="$product" :key="$product->id">
            @endforeach
        </div>
        {{ $products->links() }}
    @else
        <div class="row">
            @foreach ($this->filteredProducts as $product)
                <livewire:admin.product-index-item :product="$product" :key="$product->id">
            @endforeach
        </div>
        {{ $this->filteredProducts->links() }}
    @endif
</div>
