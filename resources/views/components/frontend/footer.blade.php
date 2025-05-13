@php
    use App\Models\FooterDetails;
    $footer = FooterDetails::first();
@endphp

<footer class="main-footer background-black-3">
    <div class="main-footer__top">
        <div class="container">
            <div class="row">
                <div class="footer-widget__col footer-widget__col--about">
                    <div class="footer-widget__col__content">
                        <a href="#" class="footer-widget__col__content__logo">
                            <img src="{{ asset('frontend/assets/images/Bhojwani-Logo.webp') }}" width="170" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="footer-widget__col footer-widget__col--post">
                    <div class="footer-widget__col__content">
                        <h5 class="footer-widget__col__content__title">Contact Us</h5>
                        <ul class="personal-info">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                {!! nl2br(e($footer->address ?? 'Address not available')) !!}
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:{{ $footer->email ?? '' }}">{{ $footer->email ?? 'Email not available' }}</a>
                            </li>
                            <li>
                                <i class="fa fa-phone-alt"></i>
                                <a href="tel:{{ $footer->phone ?? '' }}">+91 {{ $footer->contact_number ?? 'Phone not available' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-widget__col footer-widget__col--links">
                    <div class="footer-widget__col__content">
                        <h5 class="footer-widget__col__content__title">Links</h5>
                        <ul class="list-unstyled footer-widget__col__content__links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Projects</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.main-footer__top -->

    <div class="main-footer__bottom">
        <div class="container">
            <div class="main-footer__bottom__inner d-flex align-items-center justify-content-between">
                <p class="main-footer__copyright">
                    Copyright © <span class="dynamic-year"></span> Bhojwani Construction.
                    All rights reserved. Designed By 
                    <a target="_blank" href="https://www.matrixbricks.com/">Matrix Bricks</a>
                </p>
             <div class="main-footer__social">
    <span class="main-footer__socialtext">Social</span>

    @php
        $socialIcons = [
            1 => ['class' => 'facebook', 'icon' => 'fab fa-facebook', 'name' => 'Facebook'],
            2 => ['class' => 'twitter', 'icon' => 'fab fa-twitter', 'name' => 'Twitter'],
            3 => ['class' => 'instagram', 'icon' => 'fab fa-instagram', 'name' => 'Instagram'],
            4 => ['class' => 'linkedin', 'icon' => 'fab fa-linkedin', 'name' => 'LinkedIn'],
            5 => ['class' => 'youtube', 'icon' => 'fab fa-youtube', 'name' => 'YouTube'],
            6 => ['class' => 'pinterest', 'icon' => 'fab fa-pinterest', 'name' => 'Pinterest'],
        ];

        $socialMediaList = $footer->social_media ?? [];
    @endphp

    @foreach ($socialMediaList as $item)
        @php
            $platform = $socialIcons[$item['platform']] ?? null;
        @endphp

        @if ($platform)
            <a href="{{ $item['link'] }}" target="_blank" class="social-icon {{ $platform['class'] }}">
                <i class="{{ $platform['icon'] }}" aria-hidden="true"></i>
                <span class="sr-only">{{ $platform['name'] }}</span>
            </a>
        @endif
    @endforeach
</div>

            </div> <!-- /.main-footer__bottom__inner -->
        </div> <!-- /.container -->
    </div> <!-- /.main-footer__bottom -->
</footer>

</div> <!-- /.page-wrapper -->

<!-- WhatsApp Button -->
@if(!empty($footer->whatsapp))
    <a href="https://wa.me/{{ $footer->whatsapp }}" target="_blank" id="whatsapp-icon">
        <img src="{{ asset('frontend/assets/images/whatsapp_733585.svg') }}" alt="Chat with us on WhatsApp">
    </a>
@endif

<!-- Mobile Navigation -->
<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box">
            <a href="#" aria-label="logo image">
                <img src="{{ asset('frontend/assets/images/Bhojwani-logo.png') }}" width="155" alt="">
            </a>
        </div>
        <div class="mobile-nav__container"></div>
        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fas fa-envelope"></i>
                <a href="mailto:{{ $footer->email ?? '' }}">{{ $footer->email ?? 'Email not available' }}</a>
            </li>
            <li>
                <i class="fas fa-phone-alt"></i>
                <a href="tel:{{ $footer->phone ?? '' }}">+91 {{ $footer->contact_number ?? 'Phone not available' }}</a>
            </li>
        </ul>
      <div class="mobile-nav__social">
    @foreach ($socialMediaList as $item)
        @php
            $platform = $socialIcons[$item['platform']] ?? null;
        @endphp

        @if ($platform)
            <a href="{{ $item['link'] }}" target="_blank">
                <i class="{{ $platform['icon'] }}" aria-hidden="true"></i>
                <span class="sr-only">{{ $platform['name'] }}</span>
            </a>
        @endif
    @endforeach
</div>

    </div>
</div>
