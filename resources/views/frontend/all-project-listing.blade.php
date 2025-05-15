 <!DOCTYPE html>
<html lang="en">
<head>
    @include('components.frontend.head')
</head>

<body>
        <div class="preloader">
        <div class="preloader__image" style="background-image: url({{ asset('frontend/assets/images/Bhojwani-logo-white.png')}});"></div>
        </div>
@include('components.frontend.header')
 
 
 
 
 <div class="cs_height_100 cs_height_lg_80"></div>
        <!-- End Page Heading Section -->
        <!-- Start Page Heading Section -->
        <div class="cs_height_100 cs_height_lg_80"></div>
        <div class="position-relative cs_gallery_hover_show_nav">
            @if (!empty($project_info->banner_image))
    @php
        $images = json_decode($project_info->banner_image, true);
    @endphp

    @if(is_array($images))
        <div class="cs_gallery_slider_thumb_2 slick-slider">
            @foreach ($images as $image)
                <div class="cs_gallery_slider_thumb_item_2 cs_bg_filed" data-src="{{ asset('bhojwani/project_information/banner/' . trim($image)) }}"></div>
            @endforeach
        </div>
    @endif
@endif
            <div class="cs_gallery_slider_nav_2_wrap">
    <div class="container position-relative cs_gallery_slider_nav_2_in">
        <div>
            <h1 class="cs_white_color mb-0 cs_fs_67">{{ $project_info->banner_heading ?? 'No Heading' }}</h1>
            <p class="cs_price mb-0 cs_white_color cs_fs_38">
                {{ $project_info->banner_description ?? '' }}
            </p>
        </div>

      @if (!empty($project_info->banner_image))
    @php
        $images = json_decode($project_info->banner_image, true);
    @endphp

    @if(is_array($images))
        <div class="cs_gallery_slider_nav_2 slick-slider">
            @foreach ($images as $image)
                <div class="cs_gallery_slider_thumb_mini_2 cs_bg_filed" data-src="{{ asset('bhojwani/project_information/banner/' . trim($image)) }}"></div>
            @endforeach
        </div>
    @endif
@endif

    </div>
</div>

            <div class="cs_left_arrow_gallery_2 cs_center cs_mobile_hide">
                <svg width="56" height="16" viewBox="0 0 56 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.292893 7.29289C-0.0976311 7.68342 -0.0976311 8.31658 0.292893 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928932C7.68054 0.538408 7.04738 0.538408 6.65685 0.928932L0.292893 7.29289ZM56 7L1 7V9L56 9V7Z"
                    fill="currentColor"></path>
                </svg>
            </div>
            <div class="cs_right_arrow_gallery_2 cs_center cs_mobile_hide">
                <svg width="56" height="16" viewBox="0 0 56 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M55.7071 8.70711C56.0976 8.31659 56.0976 7.68342 55.7071 7.2929L49.3431 0.928937C48.9526 0.538412 48.3195 0.538412 47.9289 0.928936C47.5384 1.31946 47.5384 1.95263 47.9289 2.34315L53.5858 8L47.9289 13.6569C47.5384 14.0474 47.5384 14.6805 47.9289 15.0711C48.3195 15.4616 48.9526 15.4616 49.3431 15.0711L55.7071 8.70711ZM-8.74228e-08 9L55 9L55 7L8.74228e-08 7L-8.74228e-08 9Z"
                    fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!-- End Page Heading Section -->
        <!-- main-slider-start -->

        <!-- main-slider-end -->
        <section class="project-hallmark">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="sec-title">
                            <h2 class="sec-title__title"></h2>
                        </div>
                        <p>{!!$project_info->description ?? 'No description' !!}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="portfolio-details__content__colimg">
                            <img src="{{ asset('bhojwani/project_information/project_image/' . $project_info->description_image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
                <section class="project-hallmark horizontal-sec-detail">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="sec-title text-center">
                            <h2 class="sec-title__title">{!!$project_info->heading ?? 'No description' !!}</h2>
                        </div>
                        <p>{!!$project_info->more_description ?? 'No description' !!}</p>
                                                <div class="portfolio-details__content__colimg-hor">
                            <img src="{{ asset('bhojwani/project_information/project_image/' . $project_info->more_image) }}" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Service Start -->
        <section class="service-one service-one--three service-one--page2">
            <div class="container">
                <p class="text-center">Rooftop retreats, designed for sophisticated gatherings and serene escapes, set a new standard for luxurious living in Pune.</p>
                <div class="aminities-sec wallpi-owl__carousel wallpi-owl__carousel--with-shadow wallpi-owl__carousel--basic-nav owl-carousel" data-owl-options='{
            "items": 1,
            "margin": 0,
            "loop": true,
            "smartSpeed": 700,
            "nav": true,
            "navText": ["<span class=\"icon-left-arrow1\"></span>","<span class=\"icon-right-arrow1\"></span>"],
            "dots": true,
            "autoplay": false,
            "responsive": {
                "0": {
                    "items": 1
                },
                "992": {
                    "items": 2,
                    "margin": 15
                },
                "1200": {
                    "items": 3,
                    "margin": 30
                }
            }
        }'>
                    <div class="item">
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/parking.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">6 floor parking + 24 floors residences</h4>
                                </div>
                            </div>
                        </div>
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/apartment.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">3 and 4 bhk luxe apartments</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/rooftop.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Rooftop retreat</h4>
                                </div>
                            </div>
                        </div>
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/park.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Access to Linear garden</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/network.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Great connectivity</h4>
                                </div>
                            </div>
                        </div>
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/elevator.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Designer lobby with lifts </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/parking.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">6 floor parking + 24 floors residences</h4>
                                </div>
                            </div>
                        </div>
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/apartment.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">3 and 4 bhk luxe apartments</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/rooftop.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Rooftop retreat</h4>
                                </div>
                            </div>
                        </div>
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/network.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Great connectivity</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/park.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Access to Linear garden</h4>
                                </div>
                            </div>
                        </div>
                        <div class="service-block">
                            <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                                <div class="icon-box wow fadeInUp"><img src="assets/images/icon/network.svg" /></div>
                                <div class="content-box">
                                    <h4 class="title">Great connectivity</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.item -->
                </div>
            </div>
        </section>
        <!-- Service End -->

        <section class="portfolio-details">
            <div class="container">
                <div class="row">

                    <div class="portfolio-details__content">
                        <div class="bg1">
                            <div class="sec-title">
                                <h2 class="sec-title__title">Sky High Luxury</h2>
                            </div>
                            <p>A world of leisure and entertainment at The Westford Luxe's rooftop oasis. From sunset cocktails to stargazing nights, every experience is elevated to new heights.  </p>
                            <div class="space12"></div>
                            <div class="aminities-sec wallpi-owl__carousel wallpi-owl__carousel--with-shadow wallpi-owl__carousel--basic-nav owl-carousel" data-owl-options='{
            "items": 1,
            "margin": 0,
            "loop": true,
            "smartSpeed": 700,
            "nav": true,
            "navText": ["<span class=\"icon-left-arrow1\"></span>","<span class=\"icon-right-arrow1\"></span>"],
            "dots": true,
            "autoplay": false,
            "responsive": {
                "0": {
                    "items": 1
                },
                "992": {
                    "items": 2,
                    "margin": 15
                },
                "1200": {
                    "items": 3,
                    "margin": 30
                }
            }
        }'>
                    <div class="item">
                                     <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/toboggan.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Children Play Area</p>
                                        </div>
                                    </div>

                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/swimming-pool.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Swimming Pool  </p>
                                        </div>
                                    </div>
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/trees.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Garden  </p>
                                        </div>
                                    </div>
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/billiard.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Multi-Purpose Indoor Games Room  </p>
                                        </div>
                                    </div>
                    </div>
                                        <div class="item">
                                                                         <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/development.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Coworking Space  </p>
                                        </div>
                                    </div>
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/gym.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Gym</p>
                                        </div>
                                    </div>
                                                                        <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/coffee.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Coffee House  </p>
                                        </div>
                                    </div>
                                                                        <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/television.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Entertainment Lounge  </p>
                                        </div>
                                    </div>
                    </div>
                                                        <div class="item">
                                                                 <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/open-book.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Library </p>
                                        </div>
                                    </div>      
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/kitchen.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Indoor & Outdoor Function area with Kitchen</p>
                                        </div>
                                    </div>  
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/mace.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Multi-purpose Court</p>
                                        </div>
                                    </div> 
                                     <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/old-man.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Senior Citizen Area  </p>
                                        </div>
                                    </div>
                    </div>
                                                                            <div class="item">
                                                                 <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/open-book.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Library </p>
                                        </div>
                                    </div>      
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/kitchen.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Indoor & Outdoor Function area with Kitchen</p>
                                        </div>
                                    </div>  
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/mace.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Multi-purpose Court</p>
                                        </div>
                                    </div> 
                                     <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/old-man.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Senior Citizen Area  </p>
                                        </div>
                                    </div>
                    </div>
                                                                            <div class="item">
                                                                 <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/open-book.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Library </p>
                                        </div>
                                    </div>      
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/kitchen.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Indoor & Outdoor Function area with Kitchen</p>
                                        </div>
                                    </div>  
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/mace.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Multi-purpose Court</p>
                                        </div>
                                    </div> 
                                     <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/old-man.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Senior Citizen Area  </p>
                                        </div>
                                    </div>
                    </div>
                                                                            <div class="item">
                                                                 <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/open-book.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Library </p>
                                        </div>
                                    </div>      
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/kitchen.svg" />

                                        </div>
                                        <div class="text">
                                            <p>Indoor & Outdoor Function area with Kitchen</p>
                                        </div>
                                    </div>  
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/mace.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Multi-purpose Court</p>
                                        </div>
                                    </div> 
                                     <div class="list-box">
                                        <div class="icon">
                                            <img src="assets/images/icon/old-man.svg" />
                                        </div>
                                        <div class="text">
                                            <p>Senior Citizen Area  </p>
                                        </div>
                                    </div>
                    </div>
                </div>
                            <div class="row">
                              
                                <div class="col-lg-4 col-md-4">

                                   
                                    
                                    
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="video">
            <div class="container">
                <div class="sec-title">
                    <h2 class="sec-title__title">Walkthrough </h2>
                </div>
                <div class="row">
                    <div class="bg1">
                        <div class="space32"></div>
                        <div class="vide-images">
                            <div class="img1">
                                <img src="assets/images/projects/gallery/1.webp" alt="housebox">
                            </div>
                            <a href="https://www.youtube.com/watch?v=HwaaVa8-Cw0" class="popup-youtube">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6 20.1957V3.80421C6 3.01878 6.86395 2.53993 7.53 2.95621L20.6432 11.152C21.2699 11.5436 21.2699 12.4563 20.6432 12.848L7.53 21.0437C6.86395 21.46 6 20.9812 6 20.1957Z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pdf-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="download-box">
                            <h3>Floor Plan</h3>
                            <div class="space28"></div>
                            <div class="download">
                                <a href="assets/images/pdf/floor-plan.pdf" target="_blank"><span><img src="https://housebox-html-demo.vercel.app/assets/img/icons/pdf1.svg" alt="housebox"></span>Download Now <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path>
          </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="download-box">
                            <h3>Brochure</h3>
                            <div class="space28"></div>
                            <div class="download">
                                <a href="assets/images/pdf/Brochure.pdf" target="_blank"><span><img src="https://housebox-html-demo.vercel.app/assets/img/icons/pdf1.svg" alt="housebox"></span>Download Now <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path>
          </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="download-box">
                            <h3>Plans</h3>
                            <div class="space28"></div>
                            <div class="download">
                                <a href="#" target="_blank"><span><img src="https://housebox-html-demo.vercel.app/assets/img/icons/pdf1.svg" alt="housebox"></span>Download Now <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path>
          </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="download-box">
                            <h3>Isometrics</h3>
                            <div class="space28"></div>
                            <div class="download">
                                <a href="#" target="_blank"><span><img src="https://housebox-html-demo.vercel.app/assets/img/icons/pdf1.svg" alt="housebox"></span>Download Now <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path>
          </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cs_page_heading cs_primary_bg cs_bg_filed cs_center" data-src="assets/images/projects/p4.webp">
        </section>
        <section class="about-three">
            <div class="about-two__shapeleft" style="background-image: url('assets/images/shapes/about-shape2-3.png');"></div>
            <div class="about-two__shaperight" style="background-image: url('assets/images/shapes/about-shape2-4.webp');"></div>
            <div class="container">
                <div class="sec-title">
                    <h2 class="sec-title__title">Connectivity </h2>
                </div>
                <p>The Westford Luxe in Pimple Saudagar offers unparalleled connectivity to Pune's finest attractions, including shopping centers,  restaurants, schools, and hospitals. Live life to the fullest, with everything you need just moments away.
                    </p>
                <div class="row">

                    <div class="col-md-4 service-details__feature__col">
                        <div class="service-details__feature__titlewrap d-flex align-items-center">
                            <img src="assets/images/icon/health-insurance.svg" />
                            <h6 class="service-details__feature__title">Healthcare</h6>
                        </div>
                        <ul class="list-unstyled service-details__featurelist">
                            <li>Lotus Multispeciality Hospital – <b>86m</b></li>
                            <li>Jeevan Jyoti Super Speciality Hospital – <b>270m</b></li>
                            <li>ONP Leela Hospital – <b>600m</b></li>
                            <li>Cloudnine Hospital – <b>600m</b></li>
                            <li>Jupiter Hospital – <b>6.5km</b></li>
                        </ul>
                    </div>

                    <div class="col-md-4 service-details__feature__col">
                        <div class="service-details__feature__titlewrap d-flex align-items-center">
                            <img src="assets/images/icon/graduation-cap.svg" />
                            <h6 class="service-details__feature__title">Education</h6>
                        </div>
                        <ul class="list-unstyled service-details__featurelist">
                            <li>Challenger Public School - <b>140m </b></li>
                            <li> G. K. Gurukul - <b>750m </b></li>
                            <li>VIBGYOR Rise CBSE School - <b>1.3km </b></li>

                            <li>Wisdom World School - <b>1.5km </b></li>
                            <li>Symbiosis, Lavale - <b> 9.8km </b></li>
                        </ul>
                    </div>
                    <div class="col-md-4 service-details__feature__col">
                        <div class="service-details__feature__titlewrap d-flex align-items-center">
                            <img src="assets/images/icon/shopping-cart.svg" />
                            <h6 class="service-details__feature__title">Retail & Entertainment  </h6>
                        </div>
                        <ul class="list-unstyled service-details__featurelist">
                            <li>Spot18 – <b>1km</b></li>

                            <li>Westend Mall – <b>6km</b></li>

                            <li>Phoenix Mall of the Millennium – <b>6.4km</b></li>

                            <li>Balewadi High Street – <b>8km</b></li>

                            <li>The Pavilion Mall – <b>11km</b></li>
                        </ul>
                    </div>
                    <div class="col-md-4 service-details__feature__col">
                        <div class="service-details__feature__titlewrap d-flex align-items-center">
                            <img src="assets/images/icon/shopping-cart-1.svg" />
                            <h6 class="service-details__feature__title">Supermarkets   </h6>
                        </div>
                        <ul class="list-unstyled service-details__featurelist">
                            <li>StarBazaar – <b>1.4km</b></li>

                            <li>eliance SMART – <b>1.5km</b>
                                <li>

                                    <li>Nature’s Basket – <b>6km</b></li>
                        </ul>
                    </div>
                    <div class="col-md-4 service-details__feature__col">
                        <div class="service-details__feature__titlewrap d-flex align-items-center">
                            <img src="assets/images/icon/connections.svg" />
                            <h6 class="service-details__feature__title">Connectivity  </h6>
                        </div>
                        <ul class="list-unstyled service-details__featurelist">
                            <li>Chinchwad Railway Station – <b>5.6km</b></li>

                            <li>Pune-Mumbai Expressway – <b>5km</b></li>

                            <li>Pune International Airport – <b>12km</b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="slider">
            <div class="container">
                <div class="sec-title">
                    <h2 class="sec-title__title">Gallery</h2>
                </div>
                <div class="property-details-slider owl-carousel">
                    <div class="img1">
                        <img src="assets/images/projects/gallery/1-1.webp" alt="housebox">
                    </div>
                    <div class="img1">
                        <img src="assets/images/projects/gallery/2.webp" alt="housebox">
                    </div>
                    <div class="img1">
                        <img src="assets/images/projects/gallery/3_11zon.webp" alt="housebox">
                    </div>
                    <div class="img1">
                        <img src="assets/images/projects/gallery/4_11zon.webp" alt="housebox">
                    </div>
                    <div class="img1">
                        <img src="assets/images/projects/gallery/5_11zon.webp" alt="housebox">
                    </div>

                </div>
            </div>
        </section>
        <section class="location">
            <div class="container">
                <div class="row">
                    <div class="bg1">
                        <h3>Map Locations</h3>
                        <div class="space32"></div>
                        <div class="map-section">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3781.444574955317!2d73.79173147519357!3d18.599063082509808!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2b91e0701ce81%3A0x6499f7f8d8cdf224!2sLotus%20Multi-specialty%20Hospital!5e0!3m2!1smr!2sin!4v1744020416113!5m2!1smr!2sin"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <div class="space12"></div>
                            <div class="list">
                                <ul>
                                    <li>
                                        <span>Site Address:</span>
                                        <div>Sr. No. 163/1/2, Shiv Sai Lane, Near Lotus Hospital, Pimple Saudagar, Pune - 411 027, Maharashtra, INDIA. </div>
                                    </li>

                                </ul>
                                <ul class="m-0 ">
                                    <li>
                                        <span>Corporate Address:</span>
                                        <div>Office No. 1 & 2, The Westford, Pimple Saudagar, Pune - 411 027, Maharashtra, INDIA.  </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

            @include('components.frontend.footer')
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">


      <!-- Modal body -->
<div class="consultation-one__contentwrap">
                        <div class="consultation-one__contentwrap__bg" style="background-image: url('assets/images/backgrounds/consultation-bg1-1.png');"></div>
                        <div class="consultation-one__contentwrap__content">
                                                                <h2 class="sec-title__title">Get In Touch</h2><!-- /.sec-title__title -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            <form class="contact__form contact-form-validated" action="#" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="consultation-one__contentwrap__content__input-box">
                                            <input type="text" placeholder="Full Name" name="name">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="consultation-one__contentwrap__content__input-box">
                                            <input type="email" placeholder="Email Address" name="email">
                                        </div>
                                    </div>
<div class="col-md-4">
                                        <div class="consultation-one__contentwrap__content__input-box">
                                            <input type="text" placeholder="Phone No" name="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="consultation-one__contentwrap__content__input-box">
                                            <input type="text" placeholder="Country" name="Country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="consultation-one__contentwrap__content__input-box">
                                            <input type="text" placeholder="City" name="City">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="consultation-one__contentwrap__content__input-box text-message-box">
                                            <textarea name="message" placeholder="Message Details"></textarea>
                                        </div>

                                        <div class="consultation-one__contentwrap__content__btn-box">
                                            <button type="submit" class="wallpi-btn wallpi-btn--submit"><span>Send Request</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

    </div>
  </div>
</div>
<div class="modal fade" id="myModal-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">


      <!-- Modal body -->
<div class="consultation-one__contentwrap">
                        <div class="consultation-one__contentwrap__bg" style="background-image: url('assets/images/backgrounds/consultation-bg1-1.png');"></div>
                        <div class="consultation-one__contentwrap__content disclaimer-sec">
                                                                <h4 class="sec-title__title">Disclaimer</h4><!-- /.sec-title__title -->
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit tempus purus, non laoreet nulla sodales elementum. Donec ipsum elit, bibendum ac molestie quis, sagittis in odio. Etiam aliquet pretium neque et vestibulum. Proin suscipit dolor a semper tincidunt. Mauris est orci, facilisis nec arcu a, efficitur efficitur nunc. Aliquam neque dui, varius vitae purus a, laoreet feugiat felis. Vestibulum volutpat neque eu rhoncus tincidunt. Suspendisse sed feugiat mauris, id scelerisque orci. Curabitur id lacinia ligula. Cras eu pharetra erat. Aenean felis nisl, consequat eu metus id, aliquam pharetra massa.</p>
                            <p>In tempor tortor vitae ipsum consequat pharetra. Morbi convallis diam in porttitor euismod. Mauris vitae dui a massa hendrerit porttitor. Donec consequat a leo sit amet molestie. Quisque felis lectus, tempor ut nibh vulputate, tristique consequat tortor. Suspendisse vel risus ex. Phasellus varius nibh et libero venenatis, in faucibus lacus eleifend. Duis sodales tempor molestie. Mauris sit amet massa et eros molestie posuere. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque facilisis nibh porta ante semper, et imperdiet lorem ultricies.</p>
                        </div>
                    </div>

    </div>
  </div>
</div>
    <div class="buttn" data-bs-toggle="modal" data-bs-target="#myModal">
      <p class="vertical-text"> Enquiry Now </p>
    </div>
     <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__text">back top</span>
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
    </a>
        @include('components.frontend.main-js')
