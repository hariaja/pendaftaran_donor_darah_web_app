<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/images/blood.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/blood.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/blood.png') }}">
    <!-- END Icons -->

    <!-- Styles -->
    @include('components.css')
    <!-- Styles -->

    <!-- Vite Builder -->
    @vite([])
  </head>
  <body>
    <!-- Page Container -->
    <div id="page-container" class="sidebar-dark side-scroll page-header-fixed page-header-dark main-content-boxed">
      <!-- Sidebar -->
      @include('bases.components.sidebar')
      <!-- END Sidebar -->

      <!-- Header -->
      @include('bases.components.header')
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        @yield('hero')
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-full">
          @yield('content')
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Footer -->
      <footer id="page-footer">
        @include('bases.components.footer')
      </footer>
      <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    @include('components.js')
  </body>
</html>