<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-xl fixed-start my-3 ms-4 border-0 bg-white"
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times text-secondary position-absolute d-none d-xl-none end-0 top-0 cursor-pointer p-3 opacity-5"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
      <img src="{{ asset('img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="font-weight-bold fs-6 ms-3">Sembalun Agro</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="navbar-collapse collapse h-auto w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="fa fa-tachometer text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="text-uppercase font-weight-bolder opacity-6 ms-2 ps-4 text-xs">Master Penjualan</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ str_contains(request()->url(), 'pengepul') == true ? 'active' : '' }}"
          href="{{ route('page', ['page' => 'pengepul']) }}">

          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="fa fa-bar-chart text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Pesanan</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="text-uppercase font-weight-bolder opacity-6 ms-2 ps-4 text-xs">Master Stock</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ str_contains(request()->url(), 'pengepul') == true ? 'active' : '' }}"
          href="{{ route('page', ['page' => 'pengepul']) }}">

          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="ni ni-delivery-fast text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Produk Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ str_contains(request()->url(), 'product-lacak') == true ? 'active' : '' }}"
          href="{{ route('page', ['page' => 'product-lacak']) }}">
          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Lacak Produk</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="text-uppercase font-weight-bolder opacity-6 ms-2 ps-4 text-xs">Master Data</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ str_contains(request()->url(), 'products') == true ? 'active' : '' }}"
          href="{{ route('page', ['page' => 'products']) }}">
          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="fa fa-table text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Produk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ str_contains(request()->url(), 'petani') == true ? 'active' : '' }}"
          href="{{ route('page', ['page' => 'petani']) }}">
          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="fa fa-male text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Petani</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="text-uppercase font-weight-bolder opacity-6 ms-2 ps-4 text-xs">Master akun</h6>
      </li>
      <li class="nav-item">
        @php
          $isAdmin = auth()->guard('admin')->check();
          $user = auth()->user();
        @endphp

        <a class="nav-link {{ $isAdmin ? (Route::currentRouteName() == 'admin.profile' ? 'active' : '') : (Route::currentRouteName() == 'profile' ? 'active' : '') }}"
          href="{{ $isAdmin ? route('admin.profile', $user ? $user->id_admin : '') : route('profile', $user ? $user->id_pengepul : '') }}">
          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li>

      @if (auth()->guard('admin')->check())
        <li class="nav-item">
        @else
        <li class="nav-item d-none">
      @endif
      <a class="nav-link {{ str_contains(request()->url(), 'pengepul') == true ? 'active' : '' }}"
        href="{{ route('page', ['page' => 'pengepul']) }}">
        <div
          class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
          <i class="fa fa-user-plus text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Pengepul</span>
      </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('page', ['page' => 'pengepul'])  }}">
          <div
            class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
            <i class="fa fa-users text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Pembeli</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
