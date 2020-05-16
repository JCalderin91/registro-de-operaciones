<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="{{asset('favicon.png')}}" sizes="16x16" type="image/png">

  <title>Registro de operaciones</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/dataTables.css')}}">
  <style>
    body {
      background-color: #012325;
    }
  </style>
  @yield('csspage')
</head>

<body>

  <div class="container pb-5 mt-5">
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
  @yield('scriptpage')
</body>

</html>
