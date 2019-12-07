<div wire:submit="save" class="modal fade show" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
    <div class="modal-dialog modal-md">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Crear Nueva Tag</h5>
                <button type="button" class="btn btn-danger" aria-label="Close" @click="creating = false">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y: scroll; height: 50vh;">


                <input type="text" wire:model="name" placeholder="Nombre del tag" class="form-control">
                @error('name')
                    <b class="text-danger">El nombre no puede estar vacio.</b>
                @enderror
            </div>
            <div class="modal-footer" type="submit">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>