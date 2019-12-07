<div class="col">
    <div class="card bg-dark border-b-white mb-0">
        <div class="card-body row row-cols-2 p-1" x-data="{ editing: false, name: '{{ $tag->name }}' }">
            <div class="col-9 pt-1">
                <input id="tag-name" x-ref="tag" x-show="editing" @keyup.enter="editing = false; $wire.save(name)"  style="height: 90%; font-size: 1.5" class="form-control" x-model="name">
                <b x-show="!editing" class="h6 ml-2">{{ $tag->name }}</b>
            </div>
            
            <div class="btn-group absolute left-0 col-3" style="height: 39px; margin-bottom: auto;">
                <button class="btn btn-primary" x-show="!editing" @click="editing = true; $refs.tag.focus()">
                    <span class="fas fa-edit" ></span>
                </button>
                <button class="btn btn-primary" x-show="editing" @click="editing = false; $wire.save(name)">
                    <span class="fas fa-check" ></span>
                </button>
                <button class="btn btn-danger" wire:click="delete">
                    <span class="fas fa-trash"></span>
                </button>
            </div>
        </div>
    </div>
</div>