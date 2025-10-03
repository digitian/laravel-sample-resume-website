@extends('layouts.master')

@section('seo')
<meta name="robots" content="index,follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{{ __('main.desc_home') }}">

  <meta property="og:title" content="{{ __('main.homepage') }} - {{ __('main.website_title') }}">
  <meta property="og:description" content="{{ __('main.desc_home') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:locale" content="{{ app()->getLocale() }}">

  <meta property="og:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Hüseyin Emeci">

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
                  <h1 class="mb-15">{{ __('main.welcome_text_1') }}<br>{{ __('main.welcome_text_2') }}!</h1>
                  <!-- suptitle -->
                  <div class="art-lg-text art-code mb-25">&lt;<i>code</i>&gt;<span class="txt-rotate" data-period="2000"
                      data-rotate='[ "{{ __('main.top_text_1') }}.", "{{ __('main.top_text_2') }}.", "{{ __('main.top_text_3') }}.", "{{ __('main.top_text_4') }}." ]'></span>&lt;/<i>code</i>&gt;</div>
                  <div class="art-buttons-frame">
                    <!-- button -->
                    <a href="portfolio-3-col-masonry.html" class="art-btn art-btn-md"><span>{{ __('main.explore_now') }}</span></a>
                  </div>
                </div>
                <!-- main title end -->
                <!-- photo -->
                <img src="img/face-2.png" class="art-banner-photo" alt="Hüseyin Emeci">
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

      <!-- container -->
      <div class="container-fluid">

        <!-- row -->
        <div class="row">

          <!-- col -->
          <div class="col-lg-12">

            <!-- section title -->
            <div class="art-section-title">
              <!-- title frame -->
              <div class="art-title-frame">
                <!-- title -->
                <h4>{{ __('main.references') }}</h4>
              </div>
              <!-- title frame end -->
            </div>
            <!-- section title end -->

          </div>
          <!-- col end -->

          <!-- col -->
          <div class="col-lg-12">

            <!-- slider container -->
            <div class="swiper-container art-testimonial-slider" style="overflow: visible">
              <!-- slider wrapper -->
              <div class="swiper-wrapper">
                <!-- slide -->
                <div class="swiper-slide">

                  <!-- testimonial -->
                  <div class="art-a art-testimonial">
                    <!-- testimonial body -->
                    <div class="testimonial-body">
                      <!-- photo -->
                      <img class="art-testimonial-face" src="img/testimonials/face-1.jpg" alt="face">
                      <!-- name -->
                      <h5>Paul Trueman</h5>
                      <div class="art-el-suptitle mb-15">Template author</div>
                      <!-- text -->
                      <div class="mb-15">Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn't ask for better support. Thank you Artur!
                        This is easily a 5 star freelancer.</div>
                    </div>
                    <!-- testimonial body end -->
                    <!-- testimonial footer -->
                    <div class="art-testimonial-footer">
                      <div class="art-left-side">
                        <!-- star rate -->
                        <ul class="art-star-rate">
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                        </ul>
                        <!-- star rate end -->
                      </div>
                      <div class="art-right-side">

                      </div>
                    </div>
                    <!-- testimonial footer end -->
                  </div>
                  <!-- testimonial end -->

                </div>
                <!-- slide end -->

                <!-- slide -->
                <div class="swiper-slide">

                  <!-- testimonial -->
                  <div class="art-a art-testimonial">
                    <!-- testimonial body -->
                    <div class="testimonial-body">
                      <!-- photo -->
                      <img class="art-testimonial-face" src="img/testimonials/face-2.jpg" alt="face">
                      <!-- name -->
                      <h5>Paul Trueman</h5>
                      <div class="art-el-suptitle mb-15">Template author</div>
                      <!-- text -->
                      <div class="mb-15">Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn't ask for better support. Thank you Artur!
                        This is easily a 5 star freelancer.</div>
                    </div>
                    <!-- testimonial body end -->
                    <!-- testimonial footer -->
                    <div class="art-testimonial-footer">
                      <div class="art-left-side">
                        <!-- star rate -->
                        <ul class="art-star-rate">
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li class="art-empty-item"><i class="fas fa-star"></i></li>
                        </ul>
                        <!-- star rate end -->
                      </div>
                      <div class="art-right-side">

                      </div>
                    </div>
                    <!-- testimonial footer end -->
                  </div>
                  <!-- testimonial end -->

                </div>
                <!-- slide end -->

                <!-- slide -->
                <div class="swiper-slide">

                  <!-- testimonial -->
                  <div class="art-a art-testimonial">
                    <!-- testimonial body -->
                    <div class="testimonial-body">
                      <!-- photo -->
                      <img class="art-testimonial-face" src="img/testimonials/face-3.jpg" alt="face">
                      <!-- name -->
                      <h5>Paul Trueman</h5>
                      <div class="art-el-suptitle mb-15">Template author</div>
                      <!-- text -->
                      <div class="mb-15">Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn't ask for better support. Thank you Artur!
                        This is easily a 5 star freelancer.</div>
                    </div>
                    <!-- testimonial body end -->
                    <!-- testimonial footer -->
                    <div class="art-testimonial-footer">
                      <div class="art-left-side">
                        <!-- star rate -->
                        <ul class="art-star-rate">
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                        </ul>
                        <!-- star rate end -->
                      </div>
                      <div class="art-right-side">

                      </div>
                    </div>
                    <!-- testimonial footer end -->
                  </div>
                  <!-- testimonial end -->

                </div>
                <!-- slide end -->

                <!-- slide -->
                <div class="swiper-slide">

                  <!-- testimonial -->
                  <div class="art-a art-testimonial">
                    <!-- testimonial body -->
                    <div class="testimonial-body">
                      <!-- photo -->
                      <img class="art-testimonial-face" src="img/testimonials/face-4.jpg" alt="face">
                      <!-- name -->
                      <h5>Paul Trueman</h5>
                      <div class="art-el-suptitle mb-15">Template author</div>
                      <!-- text -->
                      <div class="mb-15">Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn't ask for better support. Thank you Artur!
                        This is easily a 5 star freelancer.</div>
                    </div>
                    <!-- testimonial body end -->
                    <!-- testimonial footer -->
                    <div class="art-testimonial-footer">
                      <div class="art-left-side">
                        <!-- star rate -->
                        <ul class="art-star-rate">
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                          <li><i class="fas fa-star"></i></li>
                        </ul>
                        <!-- star rate end -->
                      </div>
                      <div class="art-right-side">

                      </div>
                    </div>
                    <!-- testimonial footer end -->
                  </div>
                  <!-- testimonial end -->

                </div>
                <!-- slide end -->

              </div>
              <!-- slider wrapper end -->
            </div>
            <!-- slider container end -->

          </div>
          <!-- col end -->

          <!-- col -->
          <div class="col-lg-12">

            <!-- slider navigation -->
            <div class="art-slider-navigation">

              <!-- left side -->
              <div class="art-sn-left">

                <!-- slider pagination -->
                <div class="swiper-pagination"></div>

              </div>
              <!-- left side end -->

              <!-- right side -->
              <div class="art-sn-right">

                <!-- slider navigation -->
                <div class="art-slider-nav-frame">
                  <!-- prev -->
                  <div class="art-slider-nav art-testi-swiper-prev"><i class="fas fa-chevron-left"></i></div>
                  <!-- next -->
                  <div class="art-slider-nav art-testi-swiper-next"><i class="fas fa-chevron-right"></i></div>
                </div>
                <!-- slider navigation -->

              </div>
              <!-- right side end -->

            </div>
            <!-- slider navigation end -->

          </div>
          <!-- col end -->

        </div>
        <!-- row end -->

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