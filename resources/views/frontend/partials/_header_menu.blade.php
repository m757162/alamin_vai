
<div  class="">
<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Easy Bangladesh<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          @auth
            @if(auth()->user()->user_type == 'freelancer')
              <li><a href="{{ route('user.gigs.create') }}" class="btn secondary-hover text-white">Create Gig</a></li>
            @endif 
          @endauth
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ route('find.gigs') }}">Find Gig</a></li>
          @guest 
            <li><a href="{{ route('user.login') }}">Sign In</a></li>
            <li><a href="{{ route('user.register') }}">Join</a></li>
          @endguest          
          
          @auth
            <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>

                <li>
                  <div class="profile-name px-2 d-flex justify-content-center content-align-center">
                      <div class="img">
                        @if(auth()->user()->image != NULL)
                            <img src="{{ asset('storage/'.auth()->user()->image) }}" class="img-round img-border primary-border-color mt-3" width="50" height="50" alt="{{ auth()->user()->name }}">
                        @else                             
                            <img src="{{ asset('placeholder.jpg') }}" class="img-round img-border primary-border-color" width="50" height="50" alt="Profile">
                        @endif
                        
                      </div>
                    <!-- 
                      <div class="name ">
                        <p href="#" class="text-gray m-0 primary-text-color">{{ auth()->user()->name }}</p>
                        <p href="#" class="text-gray m-0 primary-text-color text-truncate overflow-auto">{{ auth()->user()->email }}</p>
                      </div> -->
                  </div>
                </li>           
                <hr>          
                <li><a href="{{ route('user.profile') }}">Profile</a></li>           
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('freelancer.buyer-request') }}">Buyer Requests</a></li>                     
                <li><a href="{{ route('freelancer.refer.program') }}">Refer Friend</a></li>                     
                <li><a href="{{ route('user.logout') }}">Logout</a></li>
              </ul>
            </li>            
          @endauth
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
  </header>

  <!-- Categoty start-->
  @isset($allCategories)
<div class="container-fluid d-sm-none d-md-block catemain">
  <div class="row ">
    <div class="col  d-flex justify-content-center align-items-center catecol">
      <nav class="navberq">
        <ul class="cateul">
        @foreach($allCategories as $key => $category)
          <li><a href="{{ route('find.gigs', ['category_name' => $category->name ]) }}">{{ $category->name }}</a>
            <ul class="sub">
            @foreach($category->subcategory as $key => $subcategory)
              <li><a  href="{{ route('find.gigs', ['subcategory_name' => $subcategory->name ]) }}">{{ $subcategory->name }}</a>
              @foreach($subcategory->subsubcategory as $key => $subsubcategory)
                <ul class="subsub">
                  <li><a href="{{ route('find.gigs', ['subsubcategory_name' => $subsubcategory->name ]) }}">{{ $subsubcategory->name}}</a>
                </ul>
                @endforeach
              </li>  
              @endforeach
            </ul>
          <li> 
        @endforeach  
        </ul>
      </nav>
    </div>
  </div>
</div>
@endisset
  <!--end  categoty-->
</div>


