<div class="col">
    <div class="card  border-b-white mb-0 mt-2">
        <div class="card-body row row-cols-2 p-1" x-data="{ editing: false, name: '{{ $tag->name }}' }">
            <div class="col-9 pt-1">
                <input id="tag-name" x-ref="tag" x-show="editing" @keyup.enter="editing = false; $wire.save(name)"  style="height: 90%; font-size: 1.5" class="form-control" x-model="name">
                <b x-show="!editing" class="h6 ml-2">{{ $tag->name }}</b>
            </div>
            
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 39px;">
                @can('admin.tags.edit')
                    <button class="btn btn-secondary" x-show="!editing" @click="editing = true; $refs.tag.focus()">
                        <span class="fas fa-ms fa-edit"></span>
                    </button>
                    <button class="btn btn-xs btn-default text-secondary mx-1 shadow edit-button" x-show="editing"
                        @click="editing = false; $wire.save(name)">
                        <i class="fa fa-ms fa-fw fa-pen"></i>
                    </button>
                @endcan
                @can('admin.tags.destroy')
                    <button class="btn  btn-default text-danger mx-1 shadow edit-button" wire:click="delete">
                        <span class="fas fa-lg fa-fw fa-trash"></span>
                    </button>
                @endcan 
            </div>
        </div>
    </div>
</div>