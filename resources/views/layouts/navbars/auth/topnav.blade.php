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
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" href="javascript:;">{{$title}}</a>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
       
        <ul class="navbar-nav">
            <li class="nav-item dropdown pe-2 d-flex align-items-center px-3">
                <a href="javascript:;" class="nav-link p-0" id="get-data" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-bell">
                    </i>
                    <span class="badge bg-primary" id="notif-number" style="color: white;">{{ $notifikasiCount }}</span>
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
          <li class="nav-item">
            <a class="nav-link btn-rotate" href="javascript:;">
                <i class="fa fa-sign-out" aria-hidden="true"></i>

              <p>
                <span class="d-lg-none d-md-block">Account</span>
              </p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- End Navbar -->
