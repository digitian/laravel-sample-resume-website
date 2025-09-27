<!doctype html>
<html lang="zxx">


<!-- Mirrored from miller.bslthemes.com/arter-demo/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Sep 2025 18:59:08 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- color of address bar in mobile browser -->
  <meta name="theme-color" content="#2B2B35">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- favicon  -->
  <link rel="shortcut icon" href="img/thumbnail.ico" type="image/x-icon">

  <title>Arter</title>
</head>

<body>

  <!-- app -->
  <div class="art-app">

    <!-- mobile top bar -->
    <div class="art-mobile-top-bar"></div>

    <!-- app wrapper -->
    <div class="art-app-wrapper">

      <!-- app container end -->
      <div class="art-app-container">

        <!-- info bar -->
        @include('layouts.left-sidebar')
        <!-- info bar end -->

        <!-- content -->
        @yield('content')
        <!-- content end -->

        <!-- menu bar -->
        @include('layouts.right-sidebar')
        <!-- menu bar end -->

      </div>
      <!-- app container end -->

    </div>
    <!-- app wrapper end -->

    <!-- preloader -->
    <div class="art-preloader">
      <!-- preloader content -->
      <div class="art-preloader-content">
        <!-- title -->
        <h4>Hüseyin Emeci</h4>
        <!-- progressbar -->
        <div id="preloader" class="art-preloader-load"></div>
      </div>
      <!-- preloader content end -->
    </div>
    <!-- preloader end -->

  </div>
  <!-- app end -->

  <!-- jquery js -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <!-- anime js -->
  <script src="{{ asset('assets/js/anime.min.js') }}"></script>
  <!-- swiper js -->
  <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
  <!-- progressbar js -->
  <script src="{{ asset('assets/js/progressbar.min.js') }}"></script>
  <!-- smooth scrollbar js -->
  <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>
  <!-- overscroll js -->
  <script src="{{ asset('assets/js/overscroll.min.js') }}"></script>
  <!-- typing js -->
  <script src="{{ asset('assets/js/typing.min.js') }}"></script>
  <!-- isotope js -->
  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <!-- fancybox js -->
  <script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
  <!-- swup js -->
  <script src="{{ asset('assets/js/swup.min.js') }}"></script>

  <!-- main js -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      let modifiedStyle = document.createElement('style');
      modifiedStyle.innerHTML = ".art-info-bar .art-header .art-avatar .art-lamp-light .art-available-lamp:after {content: '{{ __('main.freelance_available') }}';}";
      document.head.appendChild(modifiedStyle);
    })
  </script>

</body>


<!-- Mirrored from miller.bslthemes.com/arter-demo/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Sep 2025 18:59:40 GMT -->
</html>
