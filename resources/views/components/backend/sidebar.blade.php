<!-- Page Body Start-->
 <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('') }}" alt="" style="max-width: 20% !important;"></a>
		  	<a href="{{ route('admin.dashboard') }}">
				<img class="img-fluid" src="{{ asset('admin/assets/images/logo/Bhojwani-Logo.webp') }}" alt="" style="max-width: 65% !important;">
			</a>  
		  <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/') }}" alt="" ></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/favicon_bhoj.png') }}" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
             
                <li class="sidebar-list {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="margin-top: 55px;">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                    </svg>
                    <span class="lan-3">Dashboard</span>
                  </a>
                </li>

                 <li class="sidebar-list {{ request()->routeIs('banner-details.index','description-details','information-details','growth-sustainability-details','testimonials-details','footer') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                    </svg>
                    <span>Home page</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('banner-details.index') }}" class="{{ request()->routeIs('banner-details.index') ? 'active' : '' }}">Banner Details</a></li>
                    <li><a href="{{ route('description-details.index') }}" class="{{ request()->routeIs('description-details.index') ? 'active' : '' }}">Description Details</a></li>
                    <li><a href="{{ route('information-details.index') }}" class="{{ request()->routeIs('information-details.index') ? 'active' : '' }}">Information Details</a></li>
                    <li><a href="{{ route('growth-sustainability-details.index') }}" class="{{ request()->routeIs('growth-sustainability-details.index.index') ? 'active' : '' }}">Growth/Sustainability Details</a></li>
                    <li><a href="{{ route('testimonials-details.index') }}" class="{{ request()->routeIs('testimonials-details.index') ? 'active' : '' }}">Testimonials Details</a></li>
                    <li><a href="{{ route('footer.index') }}" class="{{ request()->routeIs('footer.index') ? 'active' : '' }}">Footer Details</a></li>

                  </ul>
                </li>

  <li class="sidebar-list {{ request()->routeIs('ourprojectcategory-details.index') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-icons') }}"></use>
                    </svg>
                    <span>Our Project</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('ourprojectcategory-details.index') }}" class="{{ request()->routeIs('ourprojectcategory-details.index') ? 'active' : '' }}">Our Project Category Details</a></li>
                    <li><a href="{{ route('ourproject-details.index') }}" class="{{ request()->routeIs('ourproject-details.index') ? 'active' : '' }}">Our Project Details</a></li>
                    <li><a href="{{ route('projectinformation-details.index') }}" class="{{ request()->routeIs('projectinformation-details.index') ? 'active' : '' }}">Our Project Information</a></li>
                    <li><a href="{{ route('projectamenity-details.index') }}" class="{{ request()->routeIs('projectamenity-details.index') ? 'active' : '' }}">Our Project Amenity</a></li>

                  </ul>
                </li>

               

               
              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>


        