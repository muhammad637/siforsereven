<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 {{ Route::currentRouteName() == 'outlets.show' || Route::currentRouteName() == 'outlets.edit' || Route::currentRouteName() == 'outlets.delete' ? 'd-none d-md-block' : '' }}"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="{{ asset('./img/icon/RSUD-logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 fw-bold text-uppercase fs-6">SIFORSEVEN</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto shadow-none" id="sidenav-collapse-main" style="height:100vh;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'order') == true ? 'active' : '' }}"
                    href="{{ route('order') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings text-sm opacity-10 text-success"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">service request</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'history') == true ? 'active' : '' }}"
                    href="{{ route('history') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-history text-info text-sm opacity-10 text-success"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">history</span>
                </a>
            </li>
            @if (auth()->user()->cekLevel == 'teknisi')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                        href="{{ route('profile') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'outlet_map.index' ? 'active' : '' }}"
                        href="{{ route('outlet_map.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-map text-success text-sm opacity-10" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lokasi</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->cekLevel == 'admin')
                <li class="nav-item mt-3 d-flex align-items-center">
                    <div class="ps-4">
                        <i class="fa fa-database text-sm opacity-10 text-warning"></i>
                    </div>
                    <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Master</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'barang' ? 'active' : '' }}"
                        href="{{ route('barang') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-cube text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1 text-capitalize">Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user') == true ? 'active' : '' }}"
                        href="{{ route('user.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1 text-capitalize">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'ruangan') == true ? 'active' : '' }}"
                        href="{{ route('ruangan') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-hospital-o text-info text-sm opacity-10" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1 text-capitalize">Ruangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'outlet_map.index' ? 'active' : '' }}"
                        href="{{ route('outlet_map.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-map text-success text-sm opacity-10" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lokasi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                        href="{{ route('profile') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
