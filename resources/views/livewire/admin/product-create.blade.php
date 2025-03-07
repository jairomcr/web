<div class="modal fade show" id="exampleModalXl" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-modal="true" role="dialog" style="display: block;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="exampleModalXlLabel">Extra large modal</h5>
        <button type="button" class="btn btn-danger" aria-label="Close" wire:click="closeCreateProduct">
            <span class="fas fa-times"></span>
        </button>
      </div>
      <div class="modal-body" style="overflow-y: scroll; height: 80vh;">
        <livewire:admin.product-form  mode="create" :product_id="$product_id"/>
      </div>
    </div>
  </div>
</div>