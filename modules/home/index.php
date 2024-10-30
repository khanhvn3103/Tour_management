<section>
    <div class="container-fluid px-0 position-relative top-0">
        <div id="carousel_home_banner" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel_home_banner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel_home_banner" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel_home_banner" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/Tour_management/asset/images/banner_02.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Find Your Dream Vacation Location</h1>
                        <p>Some representative placeholder content for the first slide.</p>

                        <form class="row">
                            <div class="col-3 ps-0">
                                <input
                                        name="name"
                                        type="text"
                                        class="form-control mr-2"
                                        placeholder="Where do you want to go?">
                            </div>
                            <div class="col-3 ps-0">
                                <input
                                        name="vehicle"
                                        type="text"
                                        class="form-control"
                                        placeholder="How do you go?">
                            </div>
                            <div class="col-2 ps-0">
                                <input
                                        name="date"
                                        type="date"
                                        class="form-control"
                                        placeholder="How do you go?">
                            </div>
                            <div class="col-2 ps-0">
                                <input
                                        name="date"
                                        type="date"
                                        class="form-control"
                                        placeholder="How do you go?">
                            </div>
                            <div class="col-2 ps-0">
                                <button class="btn btn-primary w-100 h-100">
                                    <i class="fas fa-search me-1"></i>
                                    Search
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="carousel-item">
                    <img src="/Tour_management/asset/images/banner_02.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Find Your Dream Vacation Location</h1>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/Tour_management/asset/images/banner_02.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Find Your Dream Vacation Location</h1>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include 'modules/home/list_tour.php';
        include 'modules/home/form_support.php';

    ?>
</section>