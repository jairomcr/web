
<x-adminlte-card class="col-md-4" title="Precio {{$product->price}}" theme="primary" icon="fas fa-lg fa-shopping-basket">
    <h5>Nombre: {{$product->name}}</h5>
    <div class="accordion" id="accordionExample{{$product->id}}">
        
        <div class="card">
          <div class="card-header" id="heading{{$product->id}}-1">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$product->id}}-1" aria-expanded="false" aria-controls="collapse{{$product->id}}-1">
                Imagen Del Producto
              </button>
            </h5>
          </div>
      
          <div id="collapse{{$product->id}}-1" class="collapse" aria-labelledby="heading{{$product->id}}-1" data-parent="#accordionExample{{$product->id}}">
            <div class="card-body">
                <img
                class="img-fluid"
                src="{{ asset($product->image->url ?? 'assets/img/blog/blog-1.jpg') }}" 
                alt="Imagen del producto {{$product->name}}">
            </div>
          </div>
        </div>

        <!-- SEGUNDA SECCION -->
        <div class="card">
          <div class="card-header" id="heading{{$product->id}}-2">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$product->id}}-2" aria-expanded="false" aria-controls="collapse{{$product->id}}-2">
                Informacion Del Producto
              </button>
            </h5>
          </div>
          <div id="collapse{{$product->id}}-2" class="collapse" aria-labelledby="heading{{$product->id}}-2" data-parent="#accordionExample{{$product->id}}">
            <div class="card-body">
                {{ $product->info }}
            </div>
          </div>
        </div>

        <!-- TERCERA SECCION -->
        <div class="card">
            <div class="card-header" id="heading{{$product->id}}-3">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$product->id}}-3" aria-expanded="false" aria-controls="collapse{{$product->id}}-3">
                  Descipcion Del Producto
                </button>
              </h5>
            </div>

            <div id="collapse{{$product->id}}-3" class="collapse" aria-labelledby="heading{{$product->id}}-3" data-parent="#accordionExample{{$product->id}}">
              <div class="card-body">
                  {{ $product->desc }}
              </div>
            </div>
          </div>
    </div>
</x-adminlte-card>