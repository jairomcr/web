<div wire:submit="save" class="modal fade show" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Crear Nueva Tag</h5>
                <button type="button" class="close" aria-label="Close" @click="creating = false">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" wire:model="name" placeholder="Nombre del tag" class="form-control">
                    @error('name')
                        <span class="text-danger">El nombre no puede estar vacio.</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer" type="submit">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
