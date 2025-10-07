<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Sayfa') | {{ __('admin.admin_panel') }} | Hüseyin Emeci</title>
    @vite(['resources/css/admin.css'])
    @stack('styles')
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
    <div class="page">
      <!-- Sidebar -->
      @include('admin.layouts.sidebar')

      <!-- Navbar -->
      @include('admin.layouts.header')

      <!-- Content -->
      @yield('content')
    </div>
    <!-- Tabler Core -->
    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/admin/js/demo.min.js') }}" defer></script>
    @stack('scripts')
  </body>
</html>