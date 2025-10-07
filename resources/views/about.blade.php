@extends('layouts.master')

@section('seo')
<meta name="robots" content="index,follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{{ __('about.about_desc') }}">

  <meta property="og:title" content="{{ __('main.aboutme') }} - {{ __('main.website_title') }}">
  <meta property="og:description" content="{{ __('about.about_desc') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:locale" content="{{ app()->getLocale() }}">

  <meta property="og:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Hüseyin Emeci">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ __('main.aboutme') }} - {{ __('main.website_title') }}">
  <meta name="twitter:description" content="{{ __('about.about_desc') }}">
  <meta name="twitter:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">

  <link rel="alternate" hreflang="tr" href="{{ route('tr.about') }}">
  <link rel="alternate" hreflang="en" href="{{ route('en.about') }}">
  <link rel="alternate" hreflang="de" href="{{ route('de.about') }}">
  <link rel="alternate" hreflang="x-default" href="{{ route('tr.about') }}">
@endsection

@section('schema')
<script type="application/ld+json">
    {
    "@@context": "https://schema.org",
    "@@type": "AboutPage",
    "@@id": "{{ route(app()->getLocale() . '.about') }}#about",
    "url": "{{ route(app()->getLocale() . '.about') }}",
    "name": "{{ __('main.aboutme') }}",
    "inLanguage": "{{ app()->getLocale() }}-{{ strtoupper((app()->getLocale() === 'en' ? 'US' : app()->getLocale())) }}",
    "isPartOf": { "@@id": "https://huseyinemeci.com/#website" },
    "about": { "@@id": "https://huseyinemeci.com/#person" }
    }
</script>
@endsection

@section('title', __('main.aboutme'))

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
                    <div class="row p-30-0">

                        <div class="col-12">
                            <div class="art-a art-card">

                                <h4 class="art-lg-text art-white mb-3">{{ __('about.i_am_huseyin') }}</h4>

                                <p>{{ __('about.about_text_1') }}</p>

                                <p>{{ __('about.about_text_2') }}</p>

                                <p>{{ __('about.about_text_3') }}</p>

                            </div>
                        </div>

                        <!-- col -->
                        <div class="col-lg-6">

                            <!-- section title -->
                            <div class="art-section-title">
                                <!-- title frame -->
                                <div class="art-title-frame">
                                    <!-- title -->
                                    <h4>{{ __('about.education') }}</h4>
                                </div>
                                <!-- title frame end -->
                            </div>
                            <!-- section title end -->

                            <!-- timeline -->
                            <div class="art-timeline art-gallery">
                                <div class="art-timeline-item">
                                    <div class="art-timeline-mark-light"></div>
                                    <div class="art-timeline-mark"></div>

                                    <div class="art-a art-timeline-content">
                                        <div class="art-card-header">
                                            <div class="art-left-side">
                                                <h5>{{ __('about.anadolu_university') }}</h5>
                                                <div class="art-el-suptitle mb-15">{{ __('about.computer_prog') }}</div>
                                            </div>
                                            <div class="art-right-side">
                                                <span class="art-date">{{ __('about.oct') }} 2025</span>
                                            </div>
                                        </div>

                                        <p>{{ __('about.anadolu_desc') }}</p>
                                    </div>
                                </div>

                                <div class="art-timeline-item">
                                    <div class="art-timeline-mark-light"></div>
                                    <div class="art-timeline-mark"></div>

                                    <div class="art-a art-timeline-content">
                                        <div class="art-card-header">
                                            <div class="art-left-side">
                                                <h5>{{ __('about.ege_university') }}</h5>
                                                <div class="art-el-suptitle mb-15">{{ __('about.int_relations') }}</div>
                                            </div>
                                            <div class="art-right-side">
                                                <span class="art-date">{{ __('about.sep') }} 2015 - {{ __('about.jul') }} 2021</span>
                                            </div>
                                        </div>
                                        <p>
                                            {{ __('about.ege_desc') }}
                                        </p>
                                        <a data-fancybox="diplome" data-no-swup href="files/certificate.jpg"
                                            class="art-link art-color-link art-w-chevron">Diplome</a>
                                    </div>
                                </div>

                                <div class="art-timeline-item">
                                    <div class="art-timeline-mark-light"></div>
                                    <div class="art-timeline-mark"></div>

                                    <div class="art-a art-timeline-content">
                                        <div class="art-card-header">
                                            <div class="art-left-side">
                                                <h5>Akademia Sztuki Wojennej</h5>
                                                <div class="art-el-suptitle mb-15">{{ __('about.security_stud') }}</div>
                                            </div>
                                            <div class="art-right-side">
                                                <span class="art-date">{{ __('about.oct') }} 2018 - {{ __('about.feb') }} 2019</span>
                                            </div>
                                        </div>
                                        <p>{{ __('about.akademia_sztuki_desc') }}</p>
                                    </div>

                                </div>

                            </div>
                            <!-- timeline end -->

                        </div>
                        <div class="col-lg-6">

                            <!-- section title -->
                            <div class="art-section-title">
                                <!-- title frame -->
                                <div class="art-title-frame">
                                    <!-- title -->
                                    <h4>{{ __('about.work_experience') }}</h4>
                                </div>
                                <!-- title frame end -->
                            </div>
                            <!-- section title end -->

                            <!-- timeline -->
                            <div class="art-timeline">

                                <div class="art-timeline-item">
                                    <div class="art-timeline-mark-light"></div>
                                    <div class="art-timeline-mark"></div>


                                    <div class="art-a art-timeline-content">
                                        <div class="art-card-header">
                                            <div class="art-left-side">
                                                <h5>{{ __('about.deniz_web') }}</h5>
                                                <div class="art-el-suptitle mb-15">{{ __('main.job_definition') }}</div>
                                            </div>
                                            <div class="art-right-side">
                                                <span class="art-date">{{ __('about.aug') }} 2025 - {{ __('about.sep') }} 2025</span>
                                            </div>
                                        </div>
                                        <p>{{ __('about.deniz_web_desc') }}</p>
                                    </div>
                                </div>

                                <div class="art-timeline-item">
                                    <div class="art-timeline-mark-light"></div>
                                    <div class="art-timeline-mark"></div>


                                    <div class="art-a art-timeline-content">
                                        <div class="art-card-header">
                                            <div class="art-left-side">
                                                <h5>{{ __('about.mindlook_agency') }}</h5>
                                                <div class="art-el-suptitle mb-15">{{ __('about.remote_support') }}</div>
                                            </div>
                                            <div class="art-right-side">
                                                <span class="art-date">{{ __('about.jun') }} 2024 - {{ __('about.aug') }} 2025</span>
                                            </div>
                                        </div>
                                        <p>{{ __('about.mindlook_desc') }}</p>

                                    </div>

                                </div>

                            </div>
                            <!-- timeline end -->

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
