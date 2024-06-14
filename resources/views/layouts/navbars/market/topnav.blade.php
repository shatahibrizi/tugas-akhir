<div id="spinner"
  class="show w-100 vh-100 position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center bg-white">
  <div class="spinner-grow text-primary" role="status"></div>
</div>

<!-- Navbar start -->
<div class="container px-0">
  <nav class="navbar navbar-light navbar-expand-xl bg-white">
    <a href="index.html" class="navbar-brand">
      <h1 class="text-primary display-6">Fruitables</h1>
    </a>
    <button class="navbar-toggler px-3 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars text-primary"></span>
    </button>
    <div class="navbar-collapse collapse bg-white" id="navbarCollapse">
      <div class="navbar-nav mx-auto">
        <a href="{{ route('market') }}"
          class="nav-link {{ Route::currentRouteName() == 'market' ? 'active' : '' }}">Home</a>
        <a href="{{ route('products.shop') }}"
          class="nav-item nav-link {{ Route::currentRouteName() == 'products.shop' ? 'active' : '' }}">Shop</a>
        <a href="{{ route('orders') }}"
          class="nav-item nav-link {{ Route::currentRouteName() == 'orders' ? 'active' : '' }}">Pesanan</a>
        <a href="{{ route('show.favorites') }}"
          class="nav-item nav-link {{ Route::currentRouteName() == 'show.favorites' ? 'active' : '' }}">Favorit</a>
      </div>
      <div class="d-flex align-items-center">
        <div class="input-group me-4">
          <input type="text" class="form-control" placeholder="Type here...">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
        </div>
        <a href="{{ route('cart') }}" class="position-relative my-auto me-4">
          <i class="fa fa-shopping-bag fa-2x"></i>
          <span
            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
            style="top: -5px; left: 15px; height: 20px; min-width: 20px">{{ count((array) session('cart')) }}</span>
        </a>
        @if (auth()->guard('pembeli')->check())
          <a href="{{ route('pembeli.profile', ['id_pembeli' => auth()->guard('pembeli')->id()]) }}"
            class="position-relative my-auto me-4">
          @else
            <a href="{{ route('pembeli.login') }}" class="position-relative my-auto me-4">
        @endif
        <i class="fas fa-user fa-2x"></i>
        </a>
        <!-- Logout Button Start -->
        <form method="POST" action="{{ route('pembeli.logout') }}">
          @csrf
          <button type="submit" class="btn btn-link p-0">
            <i class="fas fa-sign-out-alt fa-2x text-primary"></i>
          </button>
        </form>
        <!-- Logout Button End -->
      </div>
    </div>
  </nav>
</div>
