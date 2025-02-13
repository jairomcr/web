<div>
    <x-adminlte-input name="name" label="Nombre" label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-user text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>


    <x-adminlte-input name="price" label="Precio" label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-money-bill text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-textarea name="info" label="Información" rows=5 label-class="text-lightblue"
        igroup-size="sm" placeholder="Insertar información...">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-lg fa-file-alt text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-textarea>

    <x-adminlte-textarea name="desc" label="Descripción" rows=5 label-class="text-lightblue"
        igroup-size="sm" placeholder="Insertar descripción...">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-lg fa-file-alt text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-textarea>
</div>
