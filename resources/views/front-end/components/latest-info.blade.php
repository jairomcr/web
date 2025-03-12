@props([
    'last_post',
    'last_product',
])

<div class="icon-boxes d-flex flex-column justify-content-center">
    <div class="row">
        <div class="col-xl-3 d-flex align-items-stretct"></div>

        <!-- LATEST POST -->
        <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box mt-4 mt-xl-0">
                <i class="bx bx-receipt"></i>
                <div class="badge bg-warning">Post reciente</div>
                @if($last_post != null)
                    <h4>{{ $last_post->name }}</h4>
                    <p>{{ $last_post->extract }}</p>
                @endif
            </div>
        </div>

        <!-- LATEST PRODUCT -->
        <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box mt-4 mt-xl-0">
                <i class="bx bx-cube-alt"></i>
                <div class="badge bg-warning">Nuevo Producto</div>
                @if($last_product != null)
                    <h4>{{ $last_product->name }}</h4>
                    <p>{{ $last_product->info }}</p>
                @endif
            </div>
        </div>
    </div>
</div>