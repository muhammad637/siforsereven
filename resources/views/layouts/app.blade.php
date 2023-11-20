<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SIFORSEVEN | DASHBOARD
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{asset('./assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('./assets/css/paper-dashboard.css?v=2.0.1')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('./assets/demo/demo.css')}}" rel="stylesheet" />
  

</head>

<body class="{{ $class ?? '' }}">
    {{-- <body> --}}
    @guest
        @yield('content')
    @endguest

    @auth
        <div class="min-height-300 bg-warning position-absolute w-100"></div>
        @include('layouts.navbars.auth.sidenav')
        <main class="main-content border-radius-lg">
            @yield('content')
        </main>
        {{-- @include('components.fixed-plugin') --}}
    @endauth

    {{-- pemanggilan datatables js  --}}
    <script src="{{asset('./assets/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('./assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('./assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('./assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="{{asset('./assets/js/plugins/chartjs.min.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{asset('./assets/js/plugins/bootstrap-notify.js')}}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('./assets/js/paper-dashboard.min.js?v=2.0.1')}}" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{asset('./assets/demo/demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
      });
    </script>
    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
