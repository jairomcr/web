<div>
    @if (session()->has('message'))
    <div>
       <x-adminlte-alert theme="success" title="{{ session('message') }}" dismissable></x-adminlte-alert>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form wire:submit.prevent="saveRole" class="mb-3">
        <div class="form-group">
            <label for="name">Nombre del rol:</label>
            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Nombre del rol">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear Rol</button>
    </form>

    <h2>Roles Existentes</h2>
    <ul class="list-group">
        @foreach($roles as $role)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $role->name }}
            <div>
                <button wire:click="editRole({{ $role->id }})" class="btn btn-sm btn-outline-secondary"><i class="fa fa-lg fa-fw fa-pen"></i></button>
                <button wire:click="confirmDelete({{ $role->id }})" class="btn btn-sm btn-danger"><i class="fa fa-lg fa-fw fa-trash"></i></button>
            </div>
        </li>
        @endforeach
    </ul>

    @if($selectedRoleId)
    <h2 class="mt-4">Editar Rol</h2>
    <form wire:submit.prevent="updateRole" class="mt-3">
        <div class="form-group">
            <label for="editName">Nombre del rol:</label>
            <input type="text" class="form-control" id="editName" wire:model="name" placeholder="Nombre del rol">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Permisos:</label><br>
            @foreach($permissions as $permission)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" wire:model="selectedPermissions"
                    value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->description }}</label>
            </div>
            @endforeach
            @error('selectedPermissions') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
    </form>
    @endif

    <!-- Modal de Confirmación -->
    @if ($roleIdToDelete)
    <div class="modal fade show" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="close" wire:click="$set('roleIdToDelete', null)" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar este rol?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        wire:click="$set('roleIdToDelete', null)">Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteRole">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>