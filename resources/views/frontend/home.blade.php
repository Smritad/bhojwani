<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.frontend.head')
</head>


<body>
    <div class="preloader">
        <div class="preloader__image" style="background-image: url({{ asset('frontend/assets/images/Bhojwani-logo-white.png')}});"></div>
    </div>
    <!-- /.preloader -->
    <div class="page-wrapper">
@include('components.frontend.header')


 <!-- main-slider-start -->
<!-- main-slider-start -->
        <section class="main-slider-one">
            <div class="main-slider-one__carousel wallpi-owl__carousel owl-carousel" data-owl-options='{
        "loop": true,
        "animateOut": "fadeOut",
        "animateIn": "fadeIn",
        "items": 1,
        "autoplay": false,
        "autoplayTimeout": 7000,
        "smartSpeed": 1000,
        "nav": false,
        "navText": ["<span class=\"icon-left-arrow1\"></span>","<span class=\"icon-right-arrow1\"></span>"],
        "dots": true,
        "margin": 0
        }'>

        
        @foreach($banners as $banner)
            <div class="item">
                <div class="main-slider-one__item">
                    <div class="main-slider-one__bg" style="background-image: url('{{ asset('/bhojwani/home/banner/'. $banner->banner_images) }}');"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="main-slider-one__content">
                                    <h1 class="main-slider-one__title">{{ $banner->banner_heading }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


            
            </div>
        </section>
       
     <section class="popular-project-one">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec-title">
                    <h2 class="sec-title__title">{{ $description->title ?? 'Default Title' }}</h2>
                </div><!-- /.sec-title -->
                <div class="popular-project-one__info">
                    <p class="popular-project-one__text">
                        {!! $description->description ?? 'Default description text here...' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- Feature End -->
                <section class="project-one project-one--two">
            <div class="container">
                <div class="row project-one__row">
                    <div class="col-md-12">
                        <div class="sec-title">


                            <!-- <span class="sec-title__tagline">Latest Projects</span> -->

                            <h2 class="sec-title__title">Our Projects</h2><!-- /.sec-title__title -->

                        </div><!-- /.sec-title -->
                    </div>
                </div>
                <div class="project-one__carousel wallpi-owl__carousel wallpi-owl__carousel--with-shadow wallpi-owl__carousel--basic-nav owl-carousel" data-owl-options='{
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
                    @foreach($projectdetails as $project)
                        <div class="item">
                            <div class="project-one__item">
                                <div class="project-one__item__image">
                                    <img src="{{ asset('bhojwani/project/project_images/' . $project->project_image) }}" alt="project">
                                </div>
                                <div class="project-one__item__info">
                                    <div class="project-one__item__bg">
                                        <h4 class="project-one__item__heading">
                                               <a href="{{ route('project.details', ['category_slug' => $project->category_slug, 'project_slug' => $project->slug]) }}">
                                                    {{ $project->project_heading }}
                                                </a>            
                                            </h4>                 
                                        <strong class="project-one__item__text">
                                            {{ $project->title ?? 'Default Title' }}
                                            <span>Location: {{ $project->location ?? 'Default Title' }}</span>
                                        </strong>
                                            <a href="{{ route('project.details', ['category_slug' => $project->category_slug, 'project_slug' => $project->slug]) }}" class="project-one__item__right-arrow">
                                                <i class="icon-arrow-small-right"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                     

                </div>
            </div>
        </section>
        <!-- main-slider-end -->


        <section class="about-two">
            <div class="about-two__shapeleft" style="background-image: url('assets/images/shapes/about-shape2-3.png');"></div>
            <div class="about-two__shaperight" style="background-image: url('assets/images/shapes/about-shape2-4.webp');"></div>
            <div class="container">
                <div class="row about-two__row align-items-center">

                    <div class="wow fadeInLeft" data-wow-delay="300ms">
                        <div class="sec-title">
<h2 class="sec-title__title">{{ $intoduction->title ?? 'Default Title' }}</h2>
                        </div>

<p class="about-two__contentcol__text">{!! $intoduction->description ?? 'Default Title' !!}</p>

                        <div class="about-two__contentcol__btnwrap">
                            <a href="#" class="wallpi-btn about-one--btn"><span>Explore more</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-two End -->
 <section class="funfact-one">
            <div class="container">
                <div class="funfact-one__bg" style="background-image: url('assets/images/backgrounds/funfact-bg1-1.jpg');"></div>
                <ul class="list-unstyled funfact-one__list">
@php
    $headings = json_decode($GrowthSustainability->heading ?? '[]', true);
    $titles = json_decode($GrowthSustainability->title ?? '[]', true);
    $count = min(count($headings), count($titles));
@endphp

@for($i = 0; $i < $count; $i++)
    <li class="funfact-one__item count-box">
        <div class="funfact-one__content text-center">
            <i class="funfact-one__icon icon-img-box"></i>
            <div class="funfact-one__count-wrap">
                <strong class="funfact-one__count count-text" data-stop="{{ preg_replace('/[^0-9]/', '', $headings[$i]) }}" data-speed="1500"></strong>
                <span class="funfact-one__counter-num">{{ preg_replace('/[0-9]/', '', $headings[$i]) }}</span>
            </div>
            <h4 class="funfact-one__text">{{ $titles[$i] }}</h4>
        </div>
    </li>
@endfor

                </ul>
            </div>
        </section>
<!--FAQ One Start-->
        <section class="faq-one">
            <div class="container">
                <div class="faq-one__inner">
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="faq-one__left">
                                <div class="sec-title">



                            <h2 class="sec-title__title">{{$GrowthSustainability->sustainability_title ?? 'Default Title' }}</h2>
                        </div><!-- /.sec-title -->
                                 <p class="about-two__contentcol__text">{!! $GrowthSustainability->sustainability_description ?? 'Default Title' !!}
</p>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="faq-one__right wow fadeInRight" data-wow-delay="100ms">
                                <div class="faq-one__img">
                    @if(!empty($GrowthSustainability->sustainability_image))
                        <img src="{{ asset('bhojwani/home/sustainability/' . $GrowthSustainability->sustainability_image) }}" alt="Sustainability Image">
                    @endif                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--FAQ One End-->

      <section class="testimonials-one testimonials-one--two">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title">
                    <h2 class="sec-title__title">{{ $testimonials->first()->title ?? 'Testimonials' }}</h2>
                </div>
            </div>
        </div>

        <div class="testimonials-one__carousel wallpi-owl__carousel wallpi-owl__carousel--with-shadow wallpi-owl__carousel--basic-nav owl-carousel" data-owl-options='{
            "items": 1,
            "margin": 0,
            "loop": true,
            "smartSpeed": 700,
            "nav": true,
            "navText": ["<span class=\"icon-left-arrow1\"></span>","<span class=\"icon-right-arrow1\"></span>"],
            "dots": true,
            "autoplay": false,
            "responsive": {
                "0": {"items": 1},
                "992": {"items": 2, "margin": 15},
                "1200": {"items": 3, "margin": 30}
            }
        }'>

            @foreach($testimonials as $testimonial)
                <div class="item">
                    <div class="testimonials-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='{{ $loop->iteration * 100 }}ms'>
                        <div class="testimonials-card__inner">
                            <div class="testimonials-card__top d-flex align-items-center justify-content-between">
                                <i class="icon-quote testimonials-card__quote"></i>
                                <div class="testimonials-card__rating">
                                    @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="testimonials-card__content">
                                {{ $testimonial->description }}
                            </div>
                            <div class="testimonials-card__athour-wrap d-flex align-items-center">
                                <div class="testimonials-card__athour-name">
                                    <h5 class="testimonials-card__name">{{ $testimonial->person_name }}</h5>
                                    <p class="testimonials-card__designation">{{ $testimonial->designation }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!-- /.testimonials-one__carousel -->
    </div><!-- /.container -->
</section>


        @include('components.frontend.footer')
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

    </body>
</html>