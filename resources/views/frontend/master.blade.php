<!DOCTYPE html>
<html lang="en">

<head>
  @include('frontend.partials._header_css')
</head>

<body>

  <!-- ======= Header ======= -->
  @include('frontend.partials._topbar')
  <!-- End Top Bar -->

  <!-- Start Header -->
  @include('frontend.partials._header_menu')
  <!-- End Header -->  

  <main id="main">

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('frontend.partials._footer')
  <!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  @include('frontend.partials._footer_scripts')

</body>

</html>