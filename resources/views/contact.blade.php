@extends('layouts.master')

@section('seo')
<meta name="robots" content="index,follow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="description" content="{{ __('contact.contact_desc') }}">

  <meta property="og:title" content="{{ __('main.contact') }} - {{ __('main.website_title') }}">
  <meta property="og:description" content="{{ __('contact.contact_desc') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:locale" content="{{ app()->getLocale() }}">

  <meta property="og:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Hüseyin Emeci">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ __('main.contact') }} - {{ __('main.website_title') }}">
  <meta name="twitter:description" content="{{ __('contact.contact_desc') }}">
  <meta name="twitter:image" content="{{ asset('assets/images/huseyin-emeci.jpg') }}">

  <link rel="alternate" hreflang="tr" href="{{ route('tr.contact') }}">
  <link rel="alternate" hreflang="en" href="{{ route('en.contact') }}">
  <link rel="alternate" hreflang="de" href="{{ route('de.contact') }}">
  <link rel="alternate" hreflang="x-default" href="{{ route('tr.contact') }}">
@endsection

@section('schema')
<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "ContactPage",
        "@@id": "{{ route(app()->getLocale() . '.contact') }}#contact",
        "url": "{{ route(app()->getLocale() . '.contact') }}",
        "name": "{{ __('main.contact') }}",
        "inLanguage": "{{ app()->getLocale() }}-{{ strtoupper((app()->getLocale() === 'en' ? 'US' : app()->getLocale())) }}",
        "isPartOf": { "@@id": "https://huseyinemeci.com/#website" },
        "about": { "@@id": "https://huseyinemeci.com/#person" }
    }
</script>
@endsection

@section('title', __('main.contact'))

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

                  <!-- col -->
                  <div class="col-lg-12">

                    <!-- section title -->
                    <div class="art-section-title">
                      <!-- title frame -->
                      <div class="art-title-frame">
                        <!-- title -->
                        <h4>{{ __('contact.contact_info') }}</h4>
                      </div>
                      <!-- title frame end -->
                    </div>
                    <!-- section title end -->

                  </div>
                  <!-- col end -->
                  <!-- col -->
                  <div class="col-12 col-xl-6">
                    <!-- contact card -->
                    <div class="art-a art-card">
                      <div class="art-table p-15-15">
                        <ul>
                          <li>
                            <h6><i class="fas fa-map-marker-alt"></i>{{ __('main.residence') }}:</h6><span>{{ __('main.turkey') }}</span>
                          </li>
                          <li>
                            <h6><i class="fas fa-city"></i>{{ __('main.city') }}:</h6><span><a href="https://maps.app.goo.gl/wXCu5QhR2rrvcqGZ8" target="_blank" data-no-swup>{{ __('main.izmir') }}</a></span>
                          </li>
                          <li>
                            <h6><i class="far fa-envelope"></i>{{ __('contact.email') }}:</h6><span><a href="mailto:huseyinemeci@gmail.com">huseyinemeci@gmail.com</a></span>
                          </li>
                          <li>
                            <h6><i class="fas fa-phone"></i>{{ __('contact.phone') }}</h6><span><a href="tel:+905517307091">+905517307091</a></span>
                          </li>
                          <li>
                            <h6><i class="fab fa-whatsapp"></i>WhatsApp:</h6><span><a href="https://wa.me/905517307091" target="_blank" data-no-swup>+905517307091</a></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- contact card end -->
                  </div>
                  <!-- col end -->
                  <!-- col -->
                  <div class="col-12 col-xl-6">
                    <!-- contact card -->
                    <div class="art-a art-card">
                      <div class="art-table p-15-15">
                        <ul>
                          <li>
                            <h6><i class="fab fa-linkedin"></i>Linkedin:</h6><span><a href="https://www.linkedin.com/in/huseyin-emeci-731528197/" target="_blank" data-no-swup>Hüseyin Emeci</a></span>
                          </li>
                          <li>
                            <h6><i class="fab fa-github-square"></i>Github:</h6><span><a href="https://github.com/digitian" target="_blank" data-no-swup>@digitian</a></span>
                          </li>
                          <li>
                            <h6><i class="fab fa-twitter"></i>X:</h6><span><a href="https://x.com/huseyinemeci" target="_blank" data-no-swup>@huseyinemeci</a></span>
                          </li>
                          <li>
                            <h6><i class="fab fa-facebook-square"></i>Facebook:</h6><span><a href="https://www.facebook.com/emeci.huseyin" target="_blank" data-no-swup>@emeci.huseyin</a></span>
                          </li>
                          <li>
                            <h6><i class="fab fa-instagram"></i>Instagram:</h6><span><a href="https://www.instagram.com/huseyinemeci/" target="_blank" data-no-swup>@huseyinemeci</a></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- contact card end -->
                  </div>
                  <!-- col end -->

                  <!-- col -->
                  <div class="col-lg-12">

                    <!-- section title -->
                    <div class="art-section-title">
                      <!-- title frame -->
                      <div class="art-title-frame">
                        <!-- title -->
                        <h4>{{ __('contact.get_in_touch') }}</h4>
                      </div>
                      <!-- title frame end -->
                    </div>
                    <!-- section title end -->

                    <!-- contact form frame -->
                    <div class="art-a art-card">

                      <!-- contact form -->
                      <form action="{{ route('contact.message.send') }}" method="post" class="art-contact-form">
                        @csrf
                        <!-- form field -->
                        <div class="art-form-field">
                          <!-- name input -->
                          <input id="name" name="name" class="art-input" type="text" placeholder="{{ __('contact.name') }}" required>
                          <!-- label -->
                          <label for="name"><i class="fas fa-user"></i></label>
                        </div>
                        <!-- form field end -->
                        <!-- form field -->
                        <div class="art-form-field">
                          <!-- email input -->
                          <input id="email" name="email" class="art-input" type="email" placeholder="{{ __('contact.email') }}" required>
                          <!-- label -->
                          <label for="email"><i class="fas fa-at"></i></label>
                        </div>
                        <!-- form field end -->
                        <!-- form field -->
                        <div class="art-form-field">
                          <!-- message textarea -->
                          <textarea id="message" name="message" class="art-input" placeholder="{{ __('contact.message') }}" required></textarea>
                          <!-- label -->
                          <label for="message"><i class="far fa-envelope"></i></label>
                        </div>
                        {!! RecaptchaV3::field('/send-message') !!}
                        <!-- form field end -->
                        <!-- button -->
                        <div class="art-submit-frame">
                          <button class="art-btn art-btn-md art-submit" type="submit"><span>{{ __('contact.send_message') }}</span></button>
                        </div>
                      </form>
                      <!-- contact form end -->

                    </div>
                    <!-- contact form frame end -->

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
