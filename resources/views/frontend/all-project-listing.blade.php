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
            @foreach ($amenitiesData as $amenity)

            <div class="container">
                <p class="text-center">{!! $amenity['description'] !!}</p>
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
                    @foreach (array_chunk($amenity['pairs'], 2) as $chunk)
    <div class="item">
        @foreach ($chunk as $pair)
            <div class="service-block">
                <div class="inner-box wow fadeIn" data-wow-delay="100ms">
                    <div class="icon-box wow fadeInUp">
                        <img src="{{ asset('uploads/amenity/thumbnail/' . $pair['image']) }}" alt="{{ $pair['title'] }}" />
                    </div>
                    <div class="content-box">
                        <h4 class="title">{{ $pair['title'] }}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

                   
                </div>
            </div>
                    @endforeach

        </section>
        <!-- Service End -->

       <section class="portfolio-details">
    <div class="container">
        <div class="row">
            <div class="portfolio-details__content">
                <div class="bg1">
                    <div class="sec-title">
                        
                        <h2 class="sec-title__title">{{ $skyHigh->heading ?? '' }}</h2>
                    </div>
                    <p>{!! $skyHigh->description ?? '' !!}</p>
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
                            "0": { "items": 1 },
                            "992": { "items": 2, "margin": 15 },
                            "1200": { "items": 3, "margin": 30 }
                        }
                    }'>
                        @foreach(array_chunk($svgPairs, 4) as $chunk)
                            <div class="item">
                                @foreach($chunk as $pair)
                                    <div class="list-box">
                                        <div class="icon">
                                            <img src="{{ asset('uploads/skyhighluxury/' . $pair['image']) }}" alt="{{ $pair['title'] }}" />
                                        </div>
                                        <div class="text">
                                            <p>{{ $pair['title'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <!-- Empty column as per original -->
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
            <h2 class="sec-title__title">Walkthrough</h2>
        </div>
        <div class="row">
            <div class="bg1">
                <div class="space32"></div>
                <div class="vide-images">
                    <div class="img1">
                        <img src="{{ asset('uploads/projectwalkthrough/' . $backgroundImage) }}" alt="housebox">
                    </div>
                    @if(!empty($videoUrl))
                        <a href="{{ $videoUrl }}" class="popup-youtube">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6 20.1957V3.80421C6 3.01878 6.86395 2.53993 7.53 2.95621L20.6432 11.152C21.2699 11.5436 21.2699 12.4563 20.6432 12.848L7.53 21.0437C6.86395 21.46 6 20.9812 6 20.1957Z"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

       <section class="pdf-sec">
    <div class="container">
        <div class="row">
            @foreach($pdfData as $item)
                <div class="col-lg-3">
                    <div class="download-box">
                        <h3>{{ $item['heading'] }}</h3>
                        <div class="space28"></div>
                        <div class="download">
                            <a href="{{ asset('uploads/projectwalkthrough/' . $item['pdf']) }}" target="_blank">
                                <span>
                                    <img src="https://housebox-html-demo.vercel.app/assets/img/icons/pdf1.svg" alt="pdf-icon">
                                </span>
                                Download Now
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="cs_page_heading cs_primary_bg cs_bg_filed cs_center"
         data-src="{{ asset('uploads/projectwalkthrough/' . $backgroundImage) }}">
</section>

        <section class="about-three">
    <div class="about-two__shapeleft" style="background-image: url('assets/images/shapes/about-shape2-3.png');"></div>
    <div class="about-two__shaperight" style="background-image: url('assets/images/shapes/about-shape2-4.webp');"></div>
    <div class="container">
        <div class="sec-title">
            <h2 class="sec-title__title">{{ $connectivityData['section1_heading'] }}</h2>
        </div>
        <p>{{ $connectivityData['section1_description'] }}</p>

        <div class="row">
            @foreach($connectivityData['section2_headings'] as $index => $heading)
                @php
                    $icon = $connectivityData['section2_icons'][$index] ?? '';
                    $titles = explode(',', $connectivityData['section2_project_titles'][$index] ?? '');
                    $matters = explode(',', $connectivityData['section2_project_matters'][$index] ?? '');
                @endphp

                <div class="col-md-4 service-details__feature__col">
                    <div class="service-details__feature__titlewrap d-flex align-items-center">
                        <img src="{{ asset('uploads/connectivity/' . $icon) }}" alt="icon" class="me-2" style="width: 40px;" />
                        <h6 class="service-details__feature__title">{{ $heading }}</h6>
                    </div>

                    <ul class="list-unstyled service-details__featurelist">
                        @foreach($titles as $i => $title)
                            <li>{{ trim($title) }} –
                                <b>{{ trim($matters[$i] ?? '') }}</b>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

      <section class="slider">
    <div class="container">
        <div class="sec-title">
            <h2 class="sec-title__title">{{ $galleryEntry->section1_heading ?? '' }}</h2>
        </div>
        <div class="property-details-slider owl-carousel">
            @foreach ($galleryImages as $img)
                <div class="img1">
                    <img src="{{ $img }}" alt="Gallery Image">
                </div>
            @endforeach
        </div>
    </div>
</section>


       <section class="location">
    <div class="container">
        <div class="row">
            <div class="bg1">
                <h3>{{ $mapData->heading ?? '' }}</h3>
                <div class="space32"></div>
                <div class="map-section">
                    <iframe src="{{ $mapData->map_url ?? '' }}"
                        width="100%" height="350" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="space12"></div>
                    <div class="list">
                        <ul>
                            <li>
                                <span>Site Address:</span>
                                <div>{{ $mapData->site_title ?? '' }}</div>
                            </li>
                        </ul>
                        <ul class="m-0">
                            <li>
                                <span>Corporate Address:</span>
                                <div>{{ $mapData->site_address ?? '' }}</div>
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
