<div>
    <div class="row container-fluid">
        <button class="btn btn-primary col-sm-2 mr-2" wire:click="toggleCreateModal">Nuevo</button>
        <input id="search" name="search" value="" class="form-control col" type="text" placeholder="Buscar producto"
            wire:model.live="currentSearchProduct">
    </div>

    @if ($isCreating)
    <livewire:admin.product-create @close_create_product="toggleCreateModal" :product_id="-1"/>
    @endif

    @if ($isEditing)
    <livewire:admin.product-edit @close_edit_product="toggleEditModal" :product_id="$currentProductId "/>
    @endif
    
    

    <hr>
    @if (empty($currentSearchProduct))
        <div class="row row-cols-1 row-cols-md-3">
            @foreach ($products as $product)
                <livewire:admin.product-index-item :product="$product" :key="$product->id">
            @endforeach
        </div>
        {{ $products->links() }}
    @else
        <div class="row row-cols-1 row-cols-md-3">
            @foreach ($this->filteredProducts as $product)
                <livewire:admin.product-index-item :product="$product" :key="$product->id">
            @endforeach
        </div>
        {{ $this->filteredProducts->links() }}
    @endif
</div>