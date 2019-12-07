<div class="container" x-data="{ creating: false }">
    <div class="row">
        <input type="text" class="form-control col-10" wire:model.live="searchTag">
        <button class="btn btn-primary col ml-2" @click="creating = true">Crear</button>
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