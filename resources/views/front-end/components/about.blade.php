<section id="about" class="about section-bg">
    <div class="container">

        <div class="row">
            <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative"
                data-aos="fade-right">
                @if (isset($settings->video))
                    <a href=<?= Storage::url($settings->video) ?> class="glightbox play-btn mb-4"></a>
                @endif
            </div>

            <div
                class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                <h4 data-aos="fade-up">Sobre nosotros</h4>
                <h3 data-aos="fade-up"><?= $settings->title ?? 'Titulo default' ?></h3>
                <p data-aos="fade-up">{{$settings->description ?? ''}}</p>
            </div>
        </div>

    </div>
</section>