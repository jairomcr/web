<div class="row">
    @if ($img)
        <div class="accordion col-lg" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading-1">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-success" type="button" data-toggle="collapse"
                            data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                            Ver Imagen Del Producto
                        </button>
                    </h5>
                </div>

                <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                    <div class="card-body">
                        <img class="rounded bg-secondary img-fluid" alt="Imagen del Producto"
                            src="{{ $img->temporaryUrl() }}" data-holder-rendered="true">
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card col-lg">
            <div class="card-header" id="heading-1">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-danger" type="button" data-toggle="collapse"
                        data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                        Imagen Del Producto No Cargada
                    </button>
                    <div wire:loading wire:target="img" class="card">Cargando imagen del producto...</div>
                </h5>
            </div>
        </div>
    @endif

    <form wire:submit="save" class="col-lg">

        <button type="submit" class="btn btn-primary col-lg">{{ ucwords($mode) }}</button>

        <x-adminlte-input wire:model="name" name="name" label="Nombre" label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <div wire:ignore>
            <x-adminlte-input-file accept="image/*" wire:model="img" name="img" label="Imagen"
                label-class="text-lightblue" placeholder="Elegir imagen...">
                <x-slot name="prependSlot">
                    <div class="input-group-text text-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
        </div>
        <div>
            @error('img')
            <b class="text-danger">Imagen requerida</b>
            @enderror
        </div>

        <x-adminlte-input wire:model="price" name="price" label="Precio" label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-money-bill text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-textarea wire:model="info" name="info" label="Información" rows="5"
            label-class="text-lightblue" igroup-size="sm" placeholder="Insertar información...">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>

        <x-adminlte-textarea wire:model="desc" name="desc" label="Descripción" rows="5"
            label-class="text-lightblue" igroup-size="sm" placeholder="Insertar descripción...">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>

    </form>

</div>
