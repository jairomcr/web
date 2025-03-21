<div class="col">
    <div class="card">
        <div class="card-header p-3 bg-{{ $product->status == 1 ? 'dark' : 'light' }}">
            <div class="row">
                <div class="col">
                    <span class="h4 align-middle">$ {{ $product->price }}</span>
                </div>
                <div class="btn-group">
                    @can('admin.products.edit')
                        <button wire:click="edit" class="btn  btn-secondary p-1"><i class="fa fa-ms fa-fw fa-pen"></i></button>
                    @endcan
                    @can('admin.products.destroy')
                        <button wire:click="delete" class="btn  btn-danger p-1"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                    @endcan
                    @can('admin.products.edit')
                    <button wire:click="toggle_activation" class="btn btn-warning  p-1">
                        {{ $product->status == 1 ? 'Activar' : 'Desactivar' }}
                    </button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body px-1">
            <h3 class="text-center"> {{ $product->name }}</h3>
            <div class="accordion" id="accordionExample{{ $product->id }}">

                <div class="card bg-transparent">
                    <div class="card-header p-0" id="heading{{ $product->id }}-1">
                        <h5 class="mb-0">
                            <button class="btn container-fluid  collapsed" type="button"
                                data-toggle="collapse" data-target="#collapse{{ $product->id }}-1" aria-expanded="false"
                                aria-controls="collapse{{ $product->id }}-1">
                                Imagen Del Producto
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $product->id }}-1" class="collapse"
                        aria-labelledby="heading{{ $product->id }}-1" data-parent="#accordionExample{{ $product->id }}">
                        <div class="card-body">
                            <img class="img-fluid" src="{{ Storage::url($product->image->url) }}"
                                alt="Imagen del producto {{ $product->name }}">
                        </div>
                    </div>
                </div>

                <!-- SEGUNDA SECCION -->
                <div class="card bg-transparent">
                    <div class="card-header p-0" id="heading{{ $product->id }}-2">
                        <h5 class="mb-0">
                            <button class="btn collapsed  container-fluid" type="button"
                                data-toggle="collapse" data-target="#collapse{{ $product->id }}-2" aria-expanded="false"
                                aria-controls="collapse{{ $product->id }}-2">
                                Informacion Del Producto
                            </button>
                        </h5>
                    </div>
                    <div id="collapse{{ $product->id }}-2" class="collapse"
                        aria-labelledby="heading{{ $product->id }}-2" data-parent="#accordionExample{{ $product->id }}">
                        <div class="card-body">
                            {{ $product->info }}
                        </div>
                    </div>
                </div>

                <!-- TERCERA SECCION -->
                <div class="card bg-transparent">
                    <div class="card-header p-0" id="heading{{ $product->id }}-3">
                        <h5 class="mb-0">
                            <button class="btn collapsed container-fluid " type="button"
                                data-toggle="collapse" data-target="#collapse{{ $product->id }}-3" aria-expanded="false"
                                aria-controls="collapse{{ $product->id }}-3">
                                Descipcion Del Producto
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $product->id }}-3" class="collapse"
                        aria-labelledby="heading{{ $product->id }}-3" data-parent="#accordionExample{{ $product->id }}">
                        <div class="card-body">
                            {{ $product->desc }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto text-center">
                User: {{ $product->user->name }}
            </div>
        </div>
    </div>
</div>