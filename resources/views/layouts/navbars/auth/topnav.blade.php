@php
    use App\Models\User;
    $notifikasiCount = count(
        User::with('notifikasi')
            ->where('id', auth()->user()->id)
            ->first()
            ->notifikasi->where('mark', 'false'),
    );
    // $notifikasiCount = 5
@endphp
{{-- <!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
    id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white text-uppercase" href="javascript:;"> {{$master}}</a></li>
                <li class="breadcrumb-item text-sm text-white text-uppercase active" aria-current="page">{{ $title }}</li>
                @if (session()->has('pageTitle'))
                    <li class="breadcrumb-item text-sm text-white">{{ session()->get('pageTitle') }}</li>
                @endif
            </ol>
            <h6 class="font-weight-bolder text-capitalize text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse  navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3">
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Log out</span>
                        </a>
                    </form>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="#sidenav-collapse-main" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center px-3">
                    <a href="javascript:;" class="nav-link text-white p-0" id="get-data" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer">
                            <span class="badge bg-primary" id="notif-number">{{ $notifikasiCount }}</span>
                        </i>
                    </a>
                    
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <div id="data"></div>
                        
                    </ul> 
                    <script>
                        $(document).ready(function() {

                            $('#get-data').click(function() {
                                $.ajax({
                                    url: "{{ route('notifi.mark') }}",
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        // tampilkan data pada halaman
                                        // console.log(data)
                                        $('#data').empty()
                                        $('#data').html(`
                                        <li class="dropdown-header">
                                            pesan terakhir
                                                <a href="{{ route('notifikasi') }}" class="text-decoration-none">
                                                    <span class="badge rounded-pill bg-primary p-2 ms-2">View all
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                            <hr class="dropdown-divider"></hr>
                                                </li>
                                        `)
                                        if (data.length == 0) $('#data').append(
                                            `<li class="notification-item"> <h4 class="mx-auto text-center mt-2">pesan kosong</h4></li>`
                                            )
                                        else {
                                            $.each(data, async function(index, item) {
                                                // console.log(index)
                                                var row = $('<li>').addClass(
                                                    'd-flex justify-content-between align-items-center px-2');
                                                if (item.status == 'berhasil') {
                                                    var i = $('<i>').addClass(
                                                        'fa fa-check text-success me-2')
                                                } else {
                                                    var i = $('<i>').addClass(
                                                        'fa fa-x-circle text-danger')
                                                }
                                                var div = $('<div>').css('cursor', 'pointer')
                                                var h4 = $('<h4>').addClass('font-poppins text-uppercase').text("tabel " +
                                                    await item
                                                    .nama_table);
                                                var p = $('<span>').addClass('font-poppins text-xs font-weight-bold mb-0').text(
                                                    await item.msg);
                                                var hr = $('<hr>').addClass('dropdown-divider');
                                                div.append(h4, p)
                                                row.append(i, div)
                                                $('#data').append(row, hr)
                
                                            })
                                        }
                
                                        $('#notif-number').html('0')
                
                                    },
                                    error: function(data) {
                                        // tampilkan pesan error pada halaman
                                        // console.log(data)
                                    }
                                });
                            });
                        });
                    </script>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar --> --}}

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
    id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active text-capitalize" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto">
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a 
                                class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-sm-inline d-none">Log out</span>
                            </a>
                        </form>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                     <li class="nav-item dropdown pe-2 d-flex align-items-center px-3">
                        <a href="javascript:;" class="nav-link text-white p-0" id="get-data" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer">
                                <span class="badge bg-primary" id="notif-number">{{ $notifikasiCount }}</span>
                            </i>
                        </a>
                        
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            <div id="data"></div>
                            
                        </ul> 
                        <script>
                            $(document).ready(function() {
    
                                $('#get-data').click(function() {
                                    $.ajax({
                                        url: "{{ route('notifi.mark') }}",
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(data) {
                                            // tampilkan data pada halaman
                                            // console.log(data)
                                            $('#data').empty()
                                            $('#data').html(`
                                            <li class="dropdown-header">
                                                pesan terakhir
                                                    <a href="{{ route('notifikasi') }}" class="text-decoration-none">
                                                        <span class="badge rounded-pill bg-primary p-2 ms-2">View all
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                <hr class="dropdown-divider"></hr>
                                                    </li>
                                            `)
                                            if (data.length == 0) $('#data').append(
                                                `<li class="notification-item"> <h4 class="mx-auto text-center mt-2">pesan kosong</h4></li>`
                                                )
                                            else {
                                                $.each(data, async function(index, item) {
                                                    // console.log(index)
                                                    var row = $('<li>').addClass(
                                                        'd-flex justify-content-between align-items-center px-2');
                                                    if (item.status == 'berhasil') {
                                                        var i = $('<i>').addClass(
                                                            'fa fa-check text-success me-2')
                                                    } else {
                                                        var i = $('<i>').addClass(
                                                            'fa fa-x-circle text-danger')
                                                    }
                                                    var div = $('<div>').css('cursor', 'pointer')
                                                    var h5 = $('<h5>').addClass('font-poppins text-uppercase').text("tabel " +
                                                        await item
                                                        .nama_table);
                                                    var p = $('<span>').addClass('font-poppins text-xs font-weight-bold mb-0').text(
                                                        await item.msg);
                                                    var hr = $('<hr>').addClass('dropdown-divider');
                                                    div.append(h5, p)
                                                    row.append(i, div)
                                                    $('#data').append(row, hr)
                    
                                                })
                                            }
                    
                                            $('#notif-number').html('0')
                    
                                        },
                                        error: function(data) {
                                            // tampilkan pesan error pada halaman
                                            // console.log(data)
                                        }
                                    });
                                });
                            });
                        </script>
                    </li>
                        {{-- <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li> --}}
                    {{-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="./img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="./img/small-logos/logo-spotify.svg"
                                                class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New album</span> by Travis Scott
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                1 day
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>credit-card</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(453.000000, 454.000000)">
                                                                <path class="color-background"
                                                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                    opacity="0.593633743"></path>
                                                                <path class="color-background"
                                                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                Payment successfully completed
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                2 days
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- End Navbar -->
