 <header class="main-header main-header--two sticky-header sticky-header--normal">
            <div class="container">
                <div class="main-header__inner">
                    <div class="main-header__logo">
                        <a href="/">
<img src="{{ asset('frontend/assets/images/Bhojwani-Logo.webp') }}" alt="Bhojwani Logo">
                        </a>
                    </div><!-- /.main-header__logo -->

                    <nav class="main-header__right main-header__nav main-menu">
                        <ul class="main-menu__list">

                            <!-- <li>
                                <a href="#">Home</a>
                            </li> -->
<li>
                                <a href="#">About Us</a>
                            </li>


                            <li class="dropdown">
    <a href="{{ url('/project-listing') }}">Our Projects</a>
    <ul>
        @foreach($categories as $category)
            <li>
                <a href="{{ url('/project-listing/' . $category->slug) }}">
                    {{ $category->category_name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>

                            <li>
                                <a href="#">Blog</a>
                            </li>
                            <li>
                                <a href="#">Careers</a>
                            </li>
                            <li>
                                <a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </nav><!-- /.main-header__nav -->

                    <div class="main-header__right">
                        <div class="mobile-nav__btn mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- /.mobile-nav__toggler -->


<!--                         <a href="#" class="search-toggler d-flex align-items-center">
                            <div class="main-header__search">
                                <i class="icon-search-1" aria-hidden="true"></i>
                                <span class="sr-only">Search</span>
                            </div>
                        </a> -->

                        <!-- <a href="#" class="wallpi-btn main-header__btn">
                            <span>Enquire Now</span>
                        </a> -->
                    </div><!-- /.main-header__right -->
                </div><!-- /.main-header__inner -->
            </div><!-- /.container-fluid -->
        </header><!-- /.main-header -->