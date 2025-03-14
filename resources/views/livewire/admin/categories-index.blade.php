<div>
    <div  class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="col">
                    @can('admin.categories.create')
                        @livewire('admin.categories-create')
                    @endcan
                </div>
                <div class="col-md-10">
                    <div class="input-group">
                        <input wire:model.live="search" class="form-control"
                            placeholder="Ingrese el nombre de la categoria....">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($categories->count())
            <div  class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th wire:click="order('id')" class="cursor-pointer w-24" style="cursor: pointer;">
                            #
                            {{-- Sort --}}
                            @if ($sort == 'id')
                            @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                            @endif
                            @else
                            <i class="fas fa-sort mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('name')" class="cursor-pointer" style="cursor: pointer;">
                            Name
                            {{-- Sort --}}
                            @if ($sort == 'name')
                            @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif
                            @else
                            <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('slug')" class="cursor-pointer" style="cursor: pointer;">
                            Slug
                            {{-- Sort --}}
                            @if ($sort == 'slug')
                            @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif
                            @else
                            <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr wire:key="category-{{$category->id}}">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td width="10px">
                            @can('admin.categories.edit')
                                @livewire('admin.categories-edit', ['category' => $category], key( $category->id))
                            @endcan
                        </td>
                        <td width="10px">
                            @can('admin.categories.destroy')
                                <a wire:click="dispatch('deleteCategory',{ categoryId : {{$category->id}}})"
                                    class="btn btn-xs btn-default text-danger mx-1 shadow edit-button">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </a>
                            @endcan 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @else
            <strong>No hay ninguna categoria con este nombre...</strong>
            @endif
        </div>
    </div>
    <!-- Pagination -->
    {{ $categories->links() }}
</div>
