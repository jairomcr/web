<section id="team" class="team section-bg">
    <div class="container">

        <div class="section-title">
            <h2 data-aos="fade-up">Principales Directivos</h2>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="member">
                    <div class="member-img">
                        <img src=<?=Storage::url($settings->executives[0]['photo']) ?> class="img-fluid" alt="">
                    </div>
                    <div class="member-info">
                        <h4>
                            <?=$settings->executives[0]['name']?>
                        </h4>
                        <span>
                            <?=$settings->executives[0]['position']?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                    <div class="member-img">
                        <img src=<?=Storage::url($settings->executives[1]['photo']) ?> class="img-fluid" alt="">
            
                    </div>
                    <div class="member-info">
                        <h4>
                            <?=$settings->executives[1]['name']?>
                        </h4>
                        <span>
                            <?=$settings->executives[1]['position']?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                    <div class="member-img">
                        <img src=<?=Storage::url($settings->executives[2]['photo']) ?> class="img-fluid" alt="">
            
                    </div>
                    <div class="member-info">
                        <h4>
                            <?=$settings->executives[2]['name']?>
                        </h4>
                        <span>
                            <?=$settings->executives[2]['position']?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <div class="member-img">
                        <img src=<?=Storage::url($settings->executives[3]['photo']) ?> class="img-fluid" alt="">
            
                    </div>
                    <div class="member-info">
                        <h4>
                            <?=$settings->executives[3]['name']?>
                        </h4>
                        <span>
                            <?=$settings->executives[3]['position']?>
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>