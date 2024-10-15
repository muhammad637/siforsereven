<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/Logo.png')}}"> --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        SIFORSEVEN | {{ $title }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-dashboard.css') }}" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



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
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    {{-- <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script> --}}
    <!--  Google Maps Plugin    -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    {{-- <script src="{{asset('assets/js/paper-dashboard.min.js')}}" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! --> --}}
    <script src="{{ asset('assets/demo/demo.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.22/js/dataTables.bootstrap4.min.js"></script>
     --}}
     {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script> --}}
     {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> --}}
     <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script>
      $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
      });
    </script> --}}
    {{-- <script>
      $(document).ready(function() {
        $('#example').DataTable();
      });
    </script> --}}
    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
