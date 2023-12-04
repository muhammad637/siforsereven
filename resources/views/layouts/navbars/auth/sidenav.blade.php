<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
      <a href="https://www.creative-tim.com" class="simple-text logo-mini">
        <div class="logo-image-small">
          <img src="{{asset('assets/img/Logo.png')}}">
        </div>
        <!-- <p>CT</p> -->
      </a>
      <a href="https://www.creative-tim.com" class="simple-text logo-normal">
        SIFORSEVEN
        <!-- <div class="logo-image-big">
          <img src="../assets/img/logo-big.png">
        </div> -->
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
          <a class=""
          href="{{ route('home') }}">
            <i class="fa fa-desktop text-danger"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li>
          <a>
            <h6 class="ps-6 ms-2 text-uppercase text-xs font-weight-bolder opacity-6" style="margin-top: 2px;">Pages</h6>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'order' ? 'active' : ''}}">
          <a class="nav-link"{{ Route::currentRouteName() == 'order' ? 'active' : ''}} href="{{ route('order')}} ">
            <i class="fa fa-wrench text-success"></i>
            <p>Service Request</p>
          </a>
        </li>
        <li class="{{ str_contains(request()->url(), 'history') == true ? 'active' : '' }}">
          <a {{ str_contains(request()->url(), 'history') == true ? 'active' : '' }}  href="{{route('history')}}">
            <i class="fa fa-history text-primary"></i>
            
            <p>History</p>
          </a>
        </li>
        
        @if (auth()->user()->cekLevel == 'teknisi')
        <li class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">
          <a   href=" {{route('profile')}}" >
            <i class="fa fa-user text-warning"></i>
            <p>Profile</p>
          </a>
        </li>
        @endif
        @if (auth()->user()->cekLevel == 'admin')
        <li>
          <a>
            <h6 class="ps-6 ms-2 text-uppercase text-xs font-weight-bolder opacity-6" style="margin-top: 2px;">Master</h6>
          </a>
        </li>
        <li class=" {{ Route::currentRouteName() == 'barang' ? 'active' : ''}}">
          <a href="{{route('barang')}}">
            <i class="fa fa-cube" style="color: #3506CA;"></i>
            <p>Barang</p>
          </a>
        </li>
        <li class="{{ str_contains(request()->url(), 'user') == true ? 'active' : '' }}">
          <a href="{{route('user.index')}}">
            <i class="fa fa-users" style="color: black;"></i>
            <p>User Management</p>
          </a>
        </li>
        <li class="{{ str_contains(request()->url(), 'ruangan') == true ? 'active' : '' }}">
          <a href="{{route('ruangan')}}">
            <i class="fa fa-hospital-o text-primary"></i>
            <p>Ruangan</p>
          </a>
        </li>
        <li>
          {{-- <a {{Route::currentRouteName() == 'outlet_map.index' ? 'active' : ''}} href="{{route('outlet_map.index')}}">
            <i class="fa fa-map text-success"></i>
            <p>Lokasi</p>
          </a> --}}
        </li>
        <li class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">
          <a href="{{route('profile')}}">
            <i class="fa fa-user" style="color: blueviolet"></i>
            <p>Profile</p>
          </a>
        </li>
        @endif
      </ul>
    </div>
  </div>