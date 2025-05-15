@php
    use App\Models\OurProjectCategory;
    $categories = App\Models\OurProjectCategory::get(); // if you want to exclude ID 4
@endphp

<header class="main-header main-header--two sticky-header sticky-header--normal">
    <div class="container">
        <div class="main-header__inner">
            <div class="main-header__logo">
                <a href="/">
                    <img src="{{ asset('frontend/assets/images/Bhojwani-Logo.webp') }}" alt="Bhojwani Logo">
                </a>
            </div>
            <nav class="main-header__right main-header__nav main-menu">
                <ul class="main-menu__list">
                    <li><a href="#">About Us</a></li> 
                    <li class="dropdown">
                        <a href="{{ route('project') }}">Our Projects</a>
                        <ul>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('our.project', ['slug' => $category->slug]) }}">
                                        {{ $category->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>

            <div class="main-header__right">
                <div class="mobile-nav__btn mobile-nav__toggler">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </div>
</header>
