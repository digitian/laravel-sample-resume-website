@extends('layouts.master')

@section('seo')
<meta name="robots" content="index,follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{{ __('blog.blog_desc') }}">

  <meta property="og:title" content="{{ __('main.blog') }} - {{ __('main.website_title') }}">
  <meta property="og:description" content="{{ __('blog.blog_desc') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:locale" content="{{ app()->getLocale() }}">

  <meta property="og:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Hüseyin Emeci">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ __('main.blog') }} - {{ __('main.website_title') }}">
  <meta name="twitter:description" content="{{ __('blog.blog_desc') }}">
  <meta name="twitter:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">

  <link rel="alternate" hreflang="tr" href="{{ route('tr.blog') }}">
  <link rel="alternate" hreflang="en" href="{{ route('en.blog') }}">
  <link rel="alternate" hreflang="de" href="{{ route('de.blog') }}">
  <link rel="alternate" hreflang="x-default" href="{{ route('tr.blog') }}">
@endsection

@section('schema')
<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "CollectionPage",
        "@@id": "{{ route(app()->getLocale() . '.blog') }}#blog-collection",
        "url": "{{ route(app()->getLocale() . '.blog') }}",
        "name": "{{ __('main.blog') }}",
        "inLanguage": "{{ app()->getLocale() === 'tr' ? 'tr-TR' : (app()->getLocale()==='de' ? 'de-DE' : 'en-US') }}",
        "isPartOf": { "@@id": "https://huseyinemeci.com/#website" },
        "hasPart": {
            "@@type": "ItemList",
            "itemListElement": [
            @foreach($posts as $key => $post)
            {
                "@@type": "ListItem",
                "position": {{ $key+1 }},
                "url": "{{ route(app()->getLocale() . '.blog.view', $post->slug) }}",
                "name": "{{ $post->title }}"
            }@if(!$loop->last),@endif
            @endforeach
            ]
        }
    }
</script>
@endsection

@section('title', __('main.blog'))

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
            <div class="row align-items-stretch p-30-0">

                <!-- col -->
                <div class="col-lg-12">

                <!-- section title -->
                <div class="art-section-title">
                    <!-- title frame -->
                    <div class="art-title-frame">
                    <!-- title -->
                    <h4>{{ __('blog.blog_posts') }}</h4>
                    </div>
                    <!-- title frame end -->
                </div>
                <!-- section title end -->

                </div>
                <!-- col end -->
                @foreach ($posts as $post)
                    <!-- col -->
                    <div class="col-lg-6">

                        <!-- blog post card -->
                        <div class="art-a art-blog-card">
                            <!-- post cover -->
                            <a href="{{ route(app()->getLocale() . '.blog.view', $post->slug) }}" class="art-port-cover">
                            <!-- img -->
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
                            </a>
                            <!-- post cover end -->
                            <!-- post description -->
                            <div class="art-post-description">
                            <!-- title -->
                            <a href="blog-post.html">
                                <h5 class="mb-15">{{ $post->title }}</h5>
                            </a>
                            <!-- text -->
                            <div class="mb-15">{{ $post->description }}</div>
                            <!-- link -->
                            <a href="{{ route(app()->getLocale() . '.blog.view', $post->slug) }}" class="art-link art-color-link art-w-chevron">{{ __('blog.read_more') }}</a>
                            </div>
                            <!-- post description end -->
                        </div>
                        <!-- blog post card end -->

                    </div>
                    <!-- col end -->
                @endforeach

            </div>
            <!-- row end -->

            </div>
            <!-- container end -->

            {{ $posts->links('layouts.paginator') }}

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
