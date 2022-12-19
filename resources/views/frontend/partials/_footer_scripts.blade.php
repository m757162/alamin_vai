<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>  
<script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Template Main JS File -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('backend/js/toastr.js') }}"></script>
@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif


<script src="{{ asset('frontend/assets/js/parsley.js') }}"></script>
@yield('footer_scripts')