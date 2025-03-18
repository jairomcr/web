<section id="team" class="team section-bg">
    <div class="container">

        <div class="section-title">
            <h2 data-aos="fade-up">Principales Directivos</h2>
        </div>

        <div class="row">

            @foreach ($executives as $item)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{Storage::url($item['photo'])}}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>
                                {{$item['name']}}
                            </h4>
                            <span>
                                {{$item['position']}}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

            

        </div>

    </div>
</section>