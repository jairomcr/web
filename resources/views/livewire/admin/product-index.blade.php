<main>
    <div class="row">
        @foreach ($products as $product)
        <x-adminlte-card class="col-sm" title="Precio {{$product->price}}" theme="primary" icon="fas fa-lg fa-shopping-basket">
            <h2>Nombre: {{$product->name}}</h2>
            <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="heading{{$product->id}}-first">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$product->id}}-first" aria-expanded="false" aria-controls="collapse{{$product->id}}-first">
                        Informacion Breve Del Producto
                      </button>
                    </h5>
                  </div>
              
                  <div id="collapse{{$product->id}}-first" class="collapse" aria-labelledby="heading{{$product->id}}-first" data-parent="#accordionExample">
                    <div class="card-body">
                        {{ $product->info }}
                    </div>
                  </div>
                </div>
                <!-- SEGUNDA SECCION -->
                <div class="card">
                  <div class="card-header" id="heading{{$product->id}}-second">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$product->id}}-second" aria-expanded="false" aria-controls="collapse{{$product->id}}-second">
                        Descipcion Del Producto
                      </button>
                    </h5>
                  </div>
                  <div id="collapse{{$product->id}}-second" class="collapse" aria-labelledby="heading{{$product->id}}-second" data-parent="#accordionExample">
                    <div class="card-body">
                        {{ $product->desc }}
                    </div>
                  </div>
                </div>
              </div>
        </x-adminlte-card>
        @endforeach
        
    </div>
    {{$products->links()}}
</main>