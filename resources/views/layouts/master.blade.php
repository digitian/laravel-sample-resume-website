<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
  @yield('seo')

  <!-- color of address bar in mobile browser -->
  <meta name="theme-color" content="#2B2B35">
  @vite(['resources/css/app.css'])

  <title>@yield('title', 'Hüseyin Emeci') - {{ __('main.website_title') }}</title>

  <style>
    .art-info-bar .art-header .art-avatar .art-lamp-light .art-available-lamp:after {
      content: "{{ __('main.freelance_available') }}" !important;
    }
  </style>

  <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "Person",
          "@@id": "https://huseyinemeci.com/#person",
          "name": "Hüseyin Emeci",
          "url": "https://huseyinemeci.com",
          "image": "{{ asset('assets/images/huseyin-emeci.jpg') }}"
        },
        {
          "@@type": "WebSite",
          "@@id": "https://huseyinemeci.com/#website",
          "url": "https://huseyinemeci.com",
          "name": "Hüseyin Emeci",
          "inLanguage": "tr-TR",
          "publisher": { "@@id": "https://huseyinemeci.com/#person" }
        }
      ]
    }
  </script>
  @yield('schema')
  {!! RecaptchaV3::initJs() !!}
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
  <!-- isotope js -->
  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <!-- fancybox js -->
  <script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
  <!-- swup js -->
  <script src="{{ asset('assets/js/swup.min.js') }}"></script>
  <!-- swup head js -->
  <script src="{{ asset('assets/js/swup-head.js') }}"></script>
  <!-- main js -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
