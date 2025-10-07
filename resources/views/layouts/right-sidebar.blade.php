<div class="art-menu-bar">

    <!-- menu bar frame -->
    <div class="art-menu-bar-frame">

    <!-- menu bar header -->
    <div class="art-menu-bar-header">
        <!-- menu bar button -->
        <div class="art-menu-bar-btn">
        <!-- icon -->
        <span></span>
        </div>
        <!-- menu bar button end -->
    </div>
    <!-- menu bar header end -->

    <!-- current page title -->
    <div class="art-current-page"></div>
    <!-- current page title end -->

    <!-- scroll frame -->
    <div class="art-scroll-frame">

        <!-- menu -->
        <nav id="swupMenu">
        <!-- menu list -->
        <ul class="main-menu">
            <!-- menu item -->
            <li class="menu-item{{ url()->current() === route(app()->getLocale() . '.home') ? ' current-menu-item' : '' }}"><a href="{{ route(app()->getLocale() . '.home')  }}">{{ __('main.homepage') }}</a></li>
            <!-- menu item -->
            <li class="menu-item{{ url()->current() === route(app()->getLocale() . '.about') ? ' current-menu-item' : '' }}"><a href="{{ route(app()->getLocale() . '.about')  }}">{{ __('main.aboutme') }}</a></li>
            <!-- menu item -->
            <li class="menu-item{{ url()->current() === route(app()->getLocale() . '.portfolio') ? ' current-menu-item' : '' }}"><a href="{{ route(app()->getLocale() . '.portfolio')  }}">{{ __('main.portfolio') }}</a></li>
            <!-- menu item -->
            <li class="menu-item{{ url()->current() === route(app()->getLocale() . '.blog') ? ' current-menu-item' : '' }}"><a href="{{ route(app()->getLocale() . '.blog')  }}">{{ __('main.blog') }}</a></li>
            <!-- menu item -->
            <li class="menu-item{{ url()->current() === route(app()->getLocale() . '.contact') ? ' current-menu-item' : '' }}"><a href="{{ route(app()->getLocale() . '.contact')  }}">{{ __('main.contact') }}</a></li>
        </ul>
        <!-- menu list end -->
        </nav>
        <!-- menu end -->

        <!-- language change -->
        <ul class="art-language-change">
        <!-- language item -->
        <li id="lang_de_parent"><a href="" id="lang_de">DE</a></li>
        <!-- language item -->
        <li id="lang_en_parent"><a href="" id="lang_en">EN</a></li>
        <!-- language item -->
        <li id="lang_tr_parent"><a href="" id="lang_tr">TR</a></li>
        </ul>
        <!-- language change end -->

    </div>
    <!-- scroll frame end -->

    </div>
    <!-- menu bar frame -->

</div>