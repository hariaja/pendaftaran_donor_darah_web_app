<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/images/blood.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/blood.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/blood.png') }}">
    <!-- END Icons -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/template/src/css/codebase.min.css') }}">
    <!-- Styles -->

    <!-- Vite Builder -->
    @vite([])
  </head>
  <body>
    <div id="page-container" class="main-content-boxed">
      <main id="main-container">
        @yield('content')
      </main>
    </div>
  </body>
</html>