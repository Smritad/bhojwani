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

@foreach($projectsbannner as $banner)
<section class="page-header">
    <div class="page-header__bg" style="background-image: url('{{ asset('bhojwani/home/banner/' . $banner->banner_image) }}');"></div>
    <div class="container">
        <ul class="wallpi-breadcrumb list-unstyled">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><span>{{ $banner->banner_heading }}</span></li>
        </ul>
        <h2 class="page-header__title">{{ $banner->banner_heading }}</h2>
    </div>
</section>
@endforeach
        <section class="project-one project-one--two project-one--page">
            <div class="container">
                <div class="row project-one__row">
              @foreach($projects as $project)
    <div class="col-xl-4 col-lg-6">
        <div class="project-one__item wow fadeInUp" data-wow-delay="300ms">
            <div class="project-one__item__image">
                <img src="{{ asset('/bhojwani/project/project_images/' . $project->project_image) }}" alt="project">
            </div>
            <div class="project-one__item__info">
                <div class="project-one__item__bg">
                    <h4 class="project-one__item__heading">
                        <a href="{{ route('project.details', ['category_slug' => $project->category_slug, 'project_slug' => $project->slug]) }}">
                            {{ $project->project_heading }}
                        </a>
                    </h4>
                    <strong class="project-one__item__text">
                        {{ $project->title }} <span>Location: {{ $project->location }}</span>
                    </strong>
                    <a href="{{ url('portfolio-details/' . $project->id) }}" class="project-one__item__right-arrow">
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
