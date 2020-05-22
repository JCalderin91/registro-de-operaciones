<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="{{asset('favicon.png')}}" sizes="16x16" type="image/png">

  <title>{!! trans('text.title') !!}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/dataTables.css')}}">
  <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
  <style>
    body {
      background-color: #012325;
    }
    .top-right.links {
        position: fixed;
        top: 10px;
        right: 10px;
    }
  </style>
  @yield('css')
</head>

<body>

  @include('layouts.partials.navbar')
  <div class="container pb-5 mt-1">
    @include('layouts.flash-messages')
    @yield('content')
  </div>
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/chart/chart.bundle.js')}}"></script>
  <script src="{{asset('assets/js/chart/chart.extension.js')}}"></script>
  <script src="{{asset('assets/js/datatable.js')}}"></script>
  <script src="{{asset('assets/js/BootstrapDatTable.js')}}"></script>
  @yield('js')
</body>

</html>
