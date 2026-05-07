@extends('layouts.master')

@section('seo')
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $portfolio->description }}">

    <meta property="og:title" content="{{ $portfolio->title }} - {{ __('main.website_title') }}">
    <meta property="og:description" content="{{ $portfolio->description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    <meta property="og:image" content="{{ Storage::url($portfolio->images[0]) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ config('app.full_name') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $portfolio->title }} - {{ __('main.website_title') }}">
    <meta name="twitter:description" content="{{ $portfolio->description }}">
    <meta name="twitter:image" content="{{ Storage::url($portfolio->images[0]) }}">

    <link rel="alternate" hreflang="tr" href="{{ route('tr.portfolio.view', $portfolioTrSlug) }}">
    <link rel="alternate" hreflang="en" href="{{ route('en.portfolio.view', $portfolioEnSlug) }}">
    <link rel="alternate" hreflang="de" href="{{ route('de.portfolio.view', $portfolioDeSlug) }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('tr.portfolio.view', $portfolioTrSlug) }}">
@endsection

@section('schema')
<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "CaseStudy",
        "@@id": "{{ url()->current() }}#case",
        "mainEntityOfPage": { "@@id": "{{ url()->current() }}#webpage" },
        "name": "{{ $portfolio->title }}",
        "description": "{{ $portfolio->description }}",
        "image": [
            @foreach($portfolio->images as $img)
            "{{ Storage::url($img) }}"@if(!$loop->last),@endif
            @endforeach
        ],
        "datePublished": "{{ $portfolio->created_at->toIso8601String() }}",
        "dateModified": "{{ $portfolio->updated_at->toIso8601String() }}",
        "inLanguage": "{{ app()->getLocale()==='tr' ? 'tr-TR' : (app()->getLocale()==='de' ? 'de-DE' : 'en-US') }}",
        "url": "{{ url()->current() }}",
        "creator": { "@@id": "https://huseyinemeci.com/#person" }
    }
</script>
@endsection

@section('title', $portfolio->title)

@section('content')
    <!-- content -->
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

                        <!-- col -->
                        <div class="col-lg-12">

                            <!-- section title -->
                            <div class="art-section-title">
                                <!-- title frame -->
                                <div class="art-title-frame">
                                    <!-- title -->
                                    <h4>{{ $portfolio->title }}</h4>
                                </div>
                                <!-- title frame end -->
                                <!-- right frame -->
                                <div class="art-right-frame">
                                    <div class="art-project-category">{{ $category }}</div>
                                </div>
                                <!-- right frame end -->
                            </div>
                            <!-- section title end -->

                        </div>
                        <!-- col end -->

                        <!-- col -->
                        <div class="col-lg-12">

                            <!-- slider container -->
                            <div class="swiper-container art-works-slider" style="overflow: visible">
                                <!-- slider wrapper -->
                                <div class="swiper-wrapper">
                                    @foreach ($portfolio->images as $key => $image)
                                        <!-- slide -->
                                        <div class="swiper-slide">
                                            <!-- item frame -->
                                            <a data-fancybox="gallery" data-no-swup href="{{ Storage::url($image) }}"
                                                class="art-a art-portfolio-item-frame art-horizontal">
                                                <!-- img -->
                                                <img src="{{ Storage::url($image) }}" alt="{{ $portfolio->title }} {{ __('portfolio.image') }} {{ $key + 1 }}">
                                                <!-- zoom icon -->
                                                <span class="art-item-hover"><i class="fas fa-expand"></i></span>
                                            </a>
                                            <!-- item end -->
                                        </div>
                                        <!-- slide end -->
                                    @endforeach
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
                                        <div class="art-slider-nav art-works-swiper-prev"><i
                                                class="fas fa-chevron-left"></i></div>
                                        <!-- next -->
                                        <div class="art-slider-nav art-works-swiper-next"><i
                                                class="fas fa-chevron-right"></i></div>
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

                <!-- container -->
                <div class="container-fluid">

                    <!-- row -->
                    <div class="row p-30-0">

                        <!-- col -->
                        <div class="col-lg-12">

                            <!-- section title -->
                            <div class="art-section-title">
                                <!-- title frame -->
                                <div class="art-title-frame">
                                    <!-- title -->
                                    <h4>{{ __('portfolio.details') }}</h4>
                                </div>
                                <!-- title frame end -->
                            </div>
                            <!-- section title end -->

                        </div>
                        <!-- col end -->

                        <!-- col -->
                        <div class="col-lg-8">

                            <div class="art-a art-card art-fluid-card">
                                <h5 class="mb-15">{{ __('portfolio.description') }}</h5>
                                <div class="mb-15">{!! $portfolio->content !!}</div>
                                <div>
                                    <h5 class="mb-15">{{ __('portfolio.features') }}</h5>
                                    <ul class="art-custom-list">
                                        @foreach ($portfolio->features as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- col end -->

                        <!-- col -->
                        <div class="col-lg-4">

                            <div class="art-a art-card" style="height: auto !important;">
                                <!-- table -->
                                <div class="art-table p-15-15">
                                    <ul>
                                        <li>
                                            <h6>{{ __('portfolio.category') }}:</h6><span>{{ $category }}</span>
                                        </li>
                                        <li>
                                            <h6>{{ __('portfolio.status') }}:</h6>
                                            @switch($portfolio->stage)
                                                @case('completed')
                                                    <span style="color: #00ff00"><i class="far fa-check-circle me-1"></i> {{ __('portfolio.completed') }}</span>
                                                    @break

                                                @case('inprogress')
                                                    <span style="color: #ffcd39"><i class="fas fa-spinner me-1"></i> {{ __('portfolio.in_progress') }}</span>
                                                    @break

                                                @default
                                                    <span style="color: #ff6373"><i class="far fa-times-circle me-1"></i> {{ __('portfolio.canceled') }}</span>

                                            @endswitch
                                        </li>
                                        <li>
                                            <h6>{{ __('portfolio.date') }}:</h6><span>{{ $portfolio->created_at->translatedFormat('j M Y') }}</span>
                                        </li>
                                        <li>
                                            <h6>{{ __('portfolio.author') }}:</h6><span>{{ config('app.full_name') }}</span>
                                        </li>
                                        @if ($portfolio->github_link)
                                            <li>
                                                <h6>Github:</h6><span><a href="{{ $portfolio->github_link }}" target="_blank" data-no-swup><i class="fab fa-github mr-1"></i>github</a></span>
                                            </li>
                                        @endif
                                        @if ($portfolio->demo_link)
                                            <li>
                                                <h6>Demo:</h6><span><a href="{{ $portfolio->demo_link }}" target="_blank" data-no-swup><i class="fas fa-link mr-1"></i>demo</a></span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <!-- table end -->
                            </div>

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

                    <!-- row -->
                    <div class="row">

                        <!-- col -->
                        <div class="col-lg-12">

                            <!-- call to action -->
                            <div class="art-a art-banner" style="background-image: url({{ asset('assets/images/background.webp') }})">
                                <!-- overlay -->
                                <div class="art-banner-overlay">
                                    <!-- main title -->
                                    <div class="art-banner-title text-center">
                                        <!-- title -->
                                        <h1 class="mb-15">{{ __('portfolio.project_advertise_1') }}</h1>
                                        <!-- suptitle -->
                                        <div class="art-lg-text art-code mb-25">{{ __('portfolio.project_advertise_2') }}</div>
                                        <!-- button -->
                                        <a href="{{ route(app()->getLocale() . '.contact') }}" class="art-btn art-btn-md"><span>{{ __('portfolio.contact_me') }}</span></a>
                                    </div>
                                    <!-- main title end -->
                                </div>
                                <!-- overlay end -->
                            </div>
                            <!-- call to action end  -->

                            <!-- projects navigation -->
                            <div class="art-a art-pagination">
                                <!-- button -->
                                @if ($prevPortfolioSlug !== '')
                                    <a href="{{ route(app()->getLocale() . '.portfolio.view', $prevPortfolioSlug) }}" class="art-link art-color-link art-w-chevron art-left-link"><span>{{ __('portfolio.prev_portfolio') }}</span></a>
                                @else
                                    <a href="javascript:;" class="art-link art-w-chevron art-left-link"><span>{{ __('portfolio.prev_portfolio') }}</span></a>
                                @endif
                                <div class="art-pagination-center art-m-hidden">
                                    <a class="art-link" href="{{ route(app()->getLocale() . '.portfolio') }}">{{ __('portfolio.all_portfolios') }}</a>
                                </div>
                                <!-- button -->
                                @if ($nextPortfolioSlug !== '')
                                    <a href="{{ route(app()->getLocale() . '.portfolio.view', $nextPortfolioSlug) }}" class="art-link art-color-link art-w-chevron"><span>{{ __('portfolio.next_portfolio') }}</span></a>
                                @else
                                    <a href="javascript:;" class="art-link art-w-chevron"><span>{{ __('portfolio.next_portfolio') }}</span></a>
                                @endif
                            </div>
                            <!-- projects navigation end -->

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
    <!-- content end -->
@endsection