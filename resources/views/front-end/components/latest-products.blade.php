<div>
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="section-title">
                <h2 data-aos="fade-up" class="aos-init aos-animate">Productos</h2>
            </div>


            <div class="row portfolio-container aos-init aos-animate" data-aos="fade-up" data-aos-delay="200"
                style="position: relative; height: 1251px;">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app"
                        style="position: absolute; left: 0px; top: 0px;">
                        <img src="{{ asset('storage/' . $product->image->url) }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ $product->info }}</p>
                            <div>
                                <a href="{{ asset('storage/' . $product->image->url) }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox preview-link" title="{{ $product->name }}">
                                    <i class="bx bx-plus"></i>
                                </a>
                                <a href="{{  route('products.detail', ['product' => $product->slug]) }}"
                                    class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>
</div>