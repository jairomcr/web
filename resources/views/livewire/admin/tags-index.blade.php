<div class="container-fluid" x-data="{ creating: false }">
    <div class="row">
        @can('admin.tags.create')
            <button class="btn btn-secondary col-auto mr-2 ml-2 mb-1" @click="creating = true">Crear</button>
        @endcan
        <input type="text" class="form-control  col-10" wire:model.live="searchTag"
            placeholder="Ingrese el nombre de la etiqueta">
    </div>
    <div class="mt-5 row row-cols-1 row-cols-md-2">
        @if ($searchTag)
            @foreach ($this->filteredTags as $tag)
                <livewire:admin.tags-index-item :tag="$tag" />
            @endforeach
        @else
            @foreach ($this->tags as $tag)
                <livewire:admin.tags-index-item :tag="$tag" />
            @endforeach
        @endif

    </div>

    <div x-show="creating">
        <livewire:admin.tag-create />
    </div>
</div>
