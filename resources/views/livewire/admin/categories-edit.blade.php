<div>
    <a wire:click="$set('open', true)" class="btn btn-xs btn-default text-secondary mx-1 shadow edit-button">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </a>

    @if ($open)
    <div class="modal fade show"  tabindex="-1" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar categoría</h5>
                    <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" wire:model="categoryName" wire:input="generateSlug($event.target.value)">

                            @error('categoryName')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Slug:</label>
                            <input type="text" class="form-control" wire:model="categorySlug" readonly>

                            @error('categorySlug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>
