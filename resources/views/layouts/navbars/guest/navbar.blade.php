@php
  $userType = '';
  $currentPath = request()->path();
  if ($currentPath == 'admin/login') {
      $userType = 'Admin';
  } elseif ($currentPath == 'login') {
      $userType = 'Pembeli';
  } elseif ($currentPath == 'stok/login') {
      $userType = 'Pengepul';
  }
@endphp

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg border-radius-lg mx-4 mt-4 py-2 shadow blur">
        <div class="container-fluid">
          <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="{{ route('dashboard') }}">
            Agro Sembalun
          </a>
          <span class="navbar-brand font-weight-bolder ms-lg-12 ms-3">
            @if ($userType)
              Login {{ $userType }}
            @endif
          </span>
          <button class="navbar-toggler ms-2 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </span>
          </button>
          <div class="navbar-collapse collapse" id="navigation">
            <ul class="navbar-nav ms-auto">
              @if ($userType == 'Pembeli')
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Login Sebagai
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                    <li><a class="dropdown-item" href="{{ route('pembeli.login') }}">Pembeli</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin_login') }}">Admin</a></li>
                    <li><a class="dropdown-item" href="{{ route('login') }}">Pengepul</a></li>
                  </ul>
                </li>
              @elseif ($userType == 'Admin')
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Login Sebagai
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin_login') }}">Admin</a></li>
                    <li><a class="dropdown-item" href="{{ route('pembeli.login') }}">Pembeli</a></li>
                    <li><a class="dropdown-item" href="{{ route('login') }}">Pengepul</a></li>
                  </ul>
                </li>
              @elseif ($userType == 'Pengepul')
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Login Sebagai
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                    <li><a class="dropdown-item" href="{{ route('login') }}">Pengepul</a></li>
                    <li><a class="dropdown-item" href="{{ route('pembeli.login') }}">Pembeli</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin_login') }}">Admin</a></li>
                  </ul>
                </li>
              @endif
              @if ($userType != 'Admin')
                <li class="nav-item">
                  @if ($userType == 'Pembeli')
                    <a class="nav-link me-2" href="{{ route('pembeli.register') }}">
                    @elseif ($userType == 'Pengepul')
                      <a class="nav-link me-2" href="{{ route('register') }}">
                  @endif
                  <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                  Sign Up
                  </a>
                </li>
              @endif
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>
  </div>
</div>
