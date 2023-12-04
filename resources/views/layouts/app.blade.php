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
    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />


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
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{-- <script>
      $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
      });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            // master barang


            $('#jenis').change(function() {
                if ($(this).val() === 'jenis_other') {
                    $('#jenis_other').show();
                } else {
                    $('#jenis_other').hide();
                }
            });
            $('#merk').change(function() {
                if ($(this).val() === 'merk_other') {
                    $('#merk_other').show();
                } else {
                    $('#merk_other').hide();
                }
            });
            $('#tipe').change(function() {
                if ($(this).val() === 'tipe_other') {
                    $('#tipe_other').show();
                } else {
                    $('#tipe_other').hide();
                }
            });



            // password
            $('#eye').addClass('fa fa-eye-slash')
            $('#eye1').addClass('fa fa-eye-slash')
            $('#eye2').addClass('fa fa-eye-slash')
            $('#mybutton').click(function() {
                // $('#currentPassword').attr('value','aan')
                var passwordInputan = $('#currentPassword');
                var passwordFieldTypean = passwordInputan.attr('type');

                // Toggle tampilan password
                if (passwordFieldTypean === 'password') {
                    passwordInputan.attr('type', 'text');
                    $('#eye1').removeClass('fa fa-eye-slash')
                    $('#eye1').addClass('fa fa-eye')
                } else {
                    $('#eye1').removeClass('fa fa-eye')
                    $('#eye1').addClass('fa fa-eye-slash')
                    passwordInputan.attr('type', 'password');
                }
            });
            $('#mybutton2').click(function() {
                var passwordInput = $('#newPassword');
                var passwordFieldType = passwordInput.attr('type');

                // Toggle tampilan password
                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    $('#eye').removeClass('fa fa-eye-slash')
                    $('#eye').addClass('fa fa-eye')
                } else {
                    $('#eye').removeClass('fa fa-eye')
                    $('#eye').addClass('fa fa-eye-slash')
                    passwordInput.attr('type', 'password');
                }
            });
            $('#mybutton3').click(function() {
                var passwordInput = $('#confirmPassword');
                var passwordFieldType = passwordInput.attr('type');

                // Toggle tampilan password
                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    $('#eye2').removeClass('fa fa-eye-slash')
                    $('#eye2').addClass('fa fa-eye')
                } else {
                    $('#eye2').removeClass('fa fa-eye')
                    $('#eye2').addClass('fa fa-eye-slash')
                    passwordInput.attr('type', 'password');
                    // alert('oke')
                }
            });
            // $('#status').change(function () {
            //     if ($(this).val() === 'selesai') {
            //         alert('oke');
            //         $('#status_selesai').show();
            //     } else {
            //         $('#status_selesai').hide();
            //     }
            // });
        });
    </script>
    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
