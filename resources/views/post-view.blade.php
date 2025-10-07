@extends('layouts.master')

@section('seo')
<meta name="robots" content="index,follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{{ $post->description }}">

  <meta property="og:title" content="{{ $post->title }} - {{ __('main.website_title') }}">
  <meta property="og:description" content="{{ $post->description }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:locale" content="{{ app()->getLocale() }}">

  <meta property="og:image" content="{{ Storage::url($post->image) }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="{{ $post->title }}">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $post->title }} - {{ __('main.website_title') }}">
  <meta name="twitter:description" content="{{ $post->description }}">
  <meta name="twitter:image" content="{{ Storage::url($post->image) }}">

  <link rel="alternate" hreflang="tr" href="{{ route('tr.blog.view', $postTrSlug) }}">
  <link rel="alternate" hreflang="en" href="{{ route('en.blog.view', $postEnSlug) }}">
  <link rel="alternate" hreflang="de" href="{{ route('de.blog.view', $postDeSlug) }}">
  <link rel="alternate" hreflang="x-default" href="{{ route('tr.blog.view', $postTrSlug) }}">
@endsection

@section('schema')
<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "BlogPosting",
        "@@id": "{{ route(app()->getLocale() . '.blog.view', $post->slug) }}#article",
        "mainEntityOfPage": { "@@id": "{{ route(app()->getLocale() . '.blog.view', $post->slug) }}#webpage" },
        "headline": "{{ $post->title }}",
        "description": "{{ Str::limit(strip_tags($post->description ?? $post->content), 180) }}",
        "image": [ "{{ $post->image }}" ],
        "datePublished": "{{ optional($post->created_at)->toIso8601String() }}",
        "dateModified": "{{ $post->updated_at->toIso8601String() }}",
        "inLanguage": "{{ app()->getLocale()==='tr' ? 'tr-TR' : (app()->getLocale()==='de' ? 'de-DE' : 'en-US') }}",
        "author": { "@@id": "https://huseyinemeci.com/#person" },
        "publisher": { "@@id": "https://huseyinemeci.com/#person" }
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
                <div class="row p-30-0">

                  <!-- col -->
                  <div class="col-lg-12">

                    <!-- section title -->
                    <div class="art-section-title">
                      <!-- title frame -->
                      <div class="art-title-frame">
                        <!-- title -->
                        <h4>{{ $post->title }}</h4>
                      </div>
                      <!-- title frame end -->
                      <!-- right frame -->
                      @if ($post->keywords)
                      <div class="art-right-frame">
                        <div class="art-project-category">{{ $post->keywords }}</div>
                      </div>
                      @endif
                      <!-- right frame end -->
                    </div>
                    <!-- section title end -->

                  </div>
                  <!-- col end -->

                  <!-- col -->
                  <div class="col-lg-12">

                    <!-- project cover -->
                    <div class="art-a art-project-cover">
                      <!-- item frame -->
                      <a data-fancybox="gallery" data-no-swup href="{{ Storage::url($post->image) }}" class="art-portfolio-item-frame art-horizontal">
                        <!-- img -->
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
                        <!-- zoom icon -->
                        <span class="art-item-hover"><i class="fas fa-expand"></i></span>
                      </a>
                      <!-- item end -->
                    </div>
                    <!-- project cover nd -->

                  </div>
                  <!-- col end -->

                  <!-- col -->
                  <div class="col-lg-8">

                    <!-- post text -->
                    <div class="art-a art-card blog-card">
                      {!! $post->content !!}
                    </div>
                    <!-- post text end -->

                  </div>
                  <!-- col end -->

                  <!-- col -->
                  <div class="col-lg-4">

                    <div class="art-a art-card" style="height: auto !important;">
                      <!-- table -->
                      <div class="art-table p-15-15">
                        <ul>
                          <li>
                            <h6>{{ __('blog.date') }}:</h6><span>{{ $post->created_at->translatedFormat('j M Y') }}</span>
                          </li>
                          <li>
                            <h6>{{ __('blog.author') }}:</h6><span>Hüseyin Emeci</span>
                          </li>
                          @if ($post->category)
                          <li>
                            <h6>Category:</h6><span>{{ $post->category }}</span>
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

              <!-- container -->
              <div class="container-fluid">

                <!-- row -->
                <div class="row">

                  <!-- col -->
                  <div class="col-lg-12">

                    <!-- pagination -->
                    <div class="art-a art-pagination">
                      <!-- button -->
                      @if ($prevPostSlug !== '')
                        <a href="{{ route(app()->getLocale() . '.blog.view', $prevPostSlug) }}" class="art-link art-color-link art-w-chevron art-left-link"><span>{{ __('blog.prev_post') }}</span></a>
                      @else
                        <a href="javascript:;" class="art-link art-w-chevron art-left-link"><span>{{ __('blog.prev_post') }}</span></a>
                      @endif
                      <div class="art-pagination-center art-m-hidden">
                        <a class="art-link" href="{{ route(app()->getLocale() . '.blog') }}">{{ __('blog.all_pub') }}</a>
                      </div>
                      <!-- button -->
                      @if ($nextPostSlug !== '')
                        <a href="{{ route(app()->getLocale() . '.blog.view', $nextPostSlug) }}" class="art-link art-color-link art-w-chevron"><span>{{ __('blog.next_post') }}</span></a>
                      @else
                        <a href="javascript:;" class="art-link art-w-chevron"><span>{{ __('blog.next_post') }}</span></a>
                      @endif
                    </div>
                    <!-- pagination end -->

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
                        <h4>{{ __('blog.similar_posts') }}</h4>
                      </div>
                      <!-- title frame end -->
                    </div>
                    <!-- section title end -->

                  </div>
                  <!-- col end -->

                  <!-- col -->
                  <div class="col-lg-12">
                    
                    <!-- slider container -->
                    <div class="swiper-container art-blog-slider" style="overflow: visible">
                      <!-- slider wrapper -->
                      <div class="swiper-wrapper">
                        @forelse ($similarPosts as $sPost)
                           <!-- slide -->
                        <div class="swiper-slide">

                          <!-- blog post card -->
                          <div class="art-a art-blog-card">
                            <!-- post cover -->
                            <a href="{{ route(app()->getLocale() . '.blog.view', $sPost->slug) }}" class="art-port-cover">
                              <!-- img -->
                              <img src="{{ Storage::url($sPost->image) }}" alt="{{ $sPost->title }}">
                            </a>
                            <!-- post cover end -->
                            <!-- post description -->
                            <div class="art-post-description">
                              <!-- title -->
                              <a href="{{ route(app()->getLocale() . '.blog.view', $sPost->slug) }}">
                                <h5 class="mb-15">{{ $sPost->title }}</h5>
                              </a>
                              <!-- text -->
                              <div class="mb-15">{{ $sPost->description }}</div>
                              <!-- link -->
                              <a href="{{ route(app()->getLocale() . '.blog.view', $sPost->slug) }}" class="art-link art-color-link art-w-chevron">{{ __('blog.read_more') }}</a>
                            </div>
                            <!-- post description end -->
                          </div>
                          <!-- blog post card end -->

                        </div>
                        <!-- slide end --> 
                        @empty
                            
                        @endforelse
                        
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
                          <div class="art-slider-nav art-blog-swiper-prev"><i class="fas fa-chevron-left"></i></div>
                          <!-- next -->
                          <div class="art-slider-nav art-blog-swiper-next"><i class="fas fa-chevron-right"></i></div>
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
        <!-- content end -->
@endsection
