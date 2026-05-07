@extends('layouts.master')

@section('seo')
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ __('portfolio.port_desc') }}">

    <meta property="og:title" content="{{ __('main.portfolio') }} - {{ __('main.website_title') }}">
    <meta property="og:description" content="{{ __('portfolio.port_desc') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    <meta property="og:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ config('app.full_name') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('main.portfolio') }} - {{ __('main.website_title') }}">
    <meta name="twitter:description" content="{{ __('portfolio.port_desc') }}">
    <meta name="twitter:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">

    <link rel="alternate" hreflang="tr" href="{{ route('tr.portfolio') }}">
    <link rel="alternate" hreflang="en" href="{{ route('en.portfolio') }}">
    <link rel="alternate" hreflang="de" href="{{ route('de.portfolio') }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('tr.portfolio') }}">
@endsection

@section('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "CollectionPage",
        "@@id": "{{ route(app()->getLocale() . '.portfolio') }}#portfolio-collection",
        "url": "{{ route(app()->getLocale() . '.portfolio') }}",
        "name": "{{ __('main.portfolio') }}",
        "inLanguage": "{{ app()->getLocale() === 'tr' ? 'tr-TR' : (app()->getLocale()==='de' ? 'de-DE' : 'en-US') }}",
        "isPartOf": { "@@id": "https://huseyinemeci.com/#website" },
        "hasPart": {
            "@@type": "ItemList",
            "itemListElement": [
            @foreach($portfolios as $key => $portfolio)
            {
                "@@type": "ListItem",
                "position": {{ $key+1 }},
                "url": "{{ route(app()->getLocale() . '.portfolio.view', $portfolio->slug) }}",
                "name": "{{ $portfolio->title }}"
            }@if(!$loop->last),@endif
            @endforeach
            ]
        }
    }
</script>
@endsection

@section('title', __('main.portfolio'))

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

                            <!-- filter -->
                            <div class="art-filter mb-30">
                                <!-- filter link -->
                                <a href="#" data-filter="*" class="art-link art-current">{{ __('portfolio.all_cat') }}</a>
                                <!-- filter link -->
                                <a href="#" data-filter=".project" class="art-link">{{ __('portfolio.projects') }}</a>
                                <!-- filter link -->
                                <a href="#" data-filter=".web-template" class="art-link">{{ __('portfolio.web_templates') }}</a>
                                <!-- filter link -->
                                <a href="#" data-filter=".ui" class="art-link">UI Elements</a>
                            </div>
                            <!-- filter end -->

                        </div>
                        <!-- col end -->

                        <div class="art-grid art-grid-3-col art-gallery">

                            @forelse ($portfolios as $portfolio)
                                <!-- grid item -->
                                <div class="art-grid-item {{ $portfolio->category }}">
                                    <!-- grid item frame -->
                                    <a data-fancybox="gallery" data-no-swup href="{{ Storage::url($portfolio->images[0]) }}"
                                        class="art-a art-portfolio-item-frame art-square">
                                        <!-- img -->
                                        <img src="{{ Storage::url($portfolio->images[0]) }}" alt="{{ $portfolio->title }}">
                                        <!-- zoom icon -->
                                        <span class="art-item-hover"><i class="fas fa-expand"></i></span>
                                    </a>
                                    <!-- grid item frame end -->
                                    <!-- description -->
                                    <div class="art-item-description">
                                        <!-- title -->
                                        <h5 class="mb-15">{{ $portfolio->title }}</h5>
                                        <div class="mb-15">{{ $portfolio->description }}</div>
                                        <!-- button -->
                                        <a href="{{ route(app()->getLocale() . '.portfolio.view', $portfolio->slug) }}" class="art-link art-color-link art-w-chevron">{{ __('portfolio.read_more') }}</a>
                                    </div>
                                    <!-- description end -->

                                </div>
                                <!-- grid item end -->
                            @empty
                                <!-- No data -->
                            @endforelse

                        </div>

                    </div>
                    <!-- row end -->

                </div>
                
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
