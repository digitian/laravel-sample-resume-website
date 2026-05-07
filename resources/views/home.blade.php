@extends('layouts.master')

@section('seo')
<meta name="robots" content="index,follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{{ __('main.desc_home') }}">

  <meta property="og:title" content="{{ __('main.homepage') }} - {{ __('main.website_title') }}">
  <meta property="og:description" content="{{ __('main.desc_home') }}">

  <meta property="og:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="{{ config('app.full_name') }}">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ __('main.homepage') }} - {{ __('main.website_title') }}">
  <meta name="twitter:description" content="{{ __('main.desc_home') }}">
  <meta name="twitter:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">

  <link rel="alternate" hreflang="tr" href="{{ route('tr.home') }}">
  <link rel="alternate" hreflang="en" href="{{ route('en.home') }}">
  <link rel="alternate" hreflang="de" href="{{ route('de.home') }}">
  <link rel="alternate" hreflang="x-default" href="{{ route('tr.home') }}">
@endsection

@section('schema')
    <script type="application/ld+json">
      {
        "@@context": "https://schema.org",
        "@@type": "WebPage",
        "@@id": "https://huseyinemeci.com/#homepage",
        "url": "{{ route(app()->getLocale() . '.home') }}",
        "name": "{{ __('main.homepage') }}",
        "inLanguage": "{{ app()->getLocale() }}-{{ strtoupper((app()->getLocale() === 'en' ? 'US' : app()->getLocale())) }}",
        "isPartOf": { "@@id": "https://huseyinemeci.com/#website" }
      }
    </script>
@endsection

@section('title', __('main.homepage'))

@section('content')
<div class="art-content">

  <!-- curtain -->
  <div class="art-curtain"></div>

  <!-- top background -->
  <div class="art-top-bg" style="background-image: url({{ asset('assets/images/background.webp') }})">
    <!-- overlay -->
    <div class="art-top-bg-overlay"></div>
    <!-- overlay end -->
  </div>
  <!-- top background end -->

  <!-- swup container -->
  <div class="transition-fade" id="swup">

    <!-- scroll frame -->
    <div id="scrollbar" class="art-scroll-frame">

      <!-- container -->
      <div class="container-fluid">

        <!-- row -->
        <div class="row p-60-0 p-lg-30-0 p-md-15-0">
          <!-- col -->
          <div class="col-lg-12">

            <!-- banner -->
            <div class="art-a art-banner" style="background-image: url({{ asset('assets/images/background.webp') }})">
              <!-- banner back -->
              <div class="art-banner-back"></div>
              <!-- banner dec -->
              <div class="art-banner-dec"></div>
              <!-- banner overlay -->
              <div class="art-banner-overlay">
                <!-- main title -->
                <div class="art-banner-title">
                  <!-- title -->
                  <h1 class="text-secondary">{{ config('app.full_name') }}</h1>
                  <h2 class="mb-15">{{ __('main.welcome_text_1') }}<br>{{ __('main.welcome_text_2') }}!</h2>
                  <!-- suptitle -->
                  <div class="art-lg-text art-code mb-25">&lt;<i>code</i>&gt;<span class="txt-rotate" data-period="2000"
                      data-rotate='[ "{{ __('main.top_text_1') }}.", "{{ __('main.top_text_2') }}.", "{{ __('main.top_text_3') }}.", "{{ __('main.top_text_4') }}." ]'></span>&lt;/<i>code</i>&gt;</div>
                  <div class="art-buttons-frame">
                    <!-- button -->
                    <a href="{{ route(app()->getLocale() . '.portfolio') }}" class="art-btn art-btn-md"><span>{{ __('main.explore_now') }}</span></a>
                  </div>
                </div>
                <!-- main title end -->
              </div>
              <!-- banner overlay end -->
            </div>
            <!-- banner end -->

          </div>
          <!-- col end -->
        </div>
        <!-- row end -->

      </div>
      <!-- container end -->

      <!-- achievements -->
      @include('layouts.achievements')
      <!-- achievements end -->

      <!-- container -->
      <div class="container-fluid">

        @if (!empty($services))
        <!-- row -->
        <div class="row">

          <!-- col -->
          <div class="col-lg-12">

            <!-- section title -->
            <div class="art-section-title">
              <!-- title frame -->
              <div class="art-title-frame">
                <!-- title -->
                <h4>{{ __('main.my_offers') }}</h4>
              </div>
              <!-- title frame end -->
            </div>
            <!-- section title end -->

          </div>
          <!-- col end -->
          
          @foreach ($services as $service)
          <!-- col -->
          <div class="col-lg-4 col-md-6">

            <!-- service -->
            <div class="art-a art-service-icon-box">
              <!-- service content -->
              <div class="art-service-ib-content">
                <!-- title -->
                <h5 class="mb-15">{{ $service->title }}</h5>
                <!-- text -->
                <div class="mb-15">{{ $service->content }}</div>
                <!-- button -->
                <div class="art-buttons-frame"><a href="{{ route(app()->getLocale() . '.contact')  }}" class="art-link art-color-link art-w-chevron">{{ __('contact.get_in_touch') }}</a></div>
              </div>
              <!-- service content end -->
            </div>
            <!-- service end -->

          </div>
          <!-- col end -->
          @endforeach

        </div>
        <!-- row end -->
        @endif

      </div>
      <!-- container end -->

      <!-- footer -->
      @include('layouts.footer')
      <!-- footer end -->

    </div>
    <!-- scroll frame end -->

  </div>
  <!-- swup container end -->

</div>

@endsection