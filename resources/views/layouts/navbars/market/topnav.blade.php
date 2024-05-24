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
        <a href="{{ route('product.shop.detail') }}"
          class="nav-item nav-link {{ Route::currentRouteName() == 'product.shop.detail' ? 'active' : '' }}">Shop
          Detail</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu bg-secondary rounded-0 m-0">
            <a href="cart.html" class="dropdown-item">Cart</a>
            <a href="chackout.html" class="dropdown-item">Chackout</a>
            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
            <a href="404.html" class="dropdown-item">404 Page</a>
          </div>
        </div>
        <a href="contact.html" class="nav-item nav-link">Contact</a>
      </div>
      <div class="d-flex align-items-center">
        <div class="input-group me-4">
          <input type="text" class="form-control" placeholder="Type here...">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
        </div>
        <a href="#" class="position-relative my-auto me-4">
          <i class="fa fa-shopping-bag fa-2x"></i>
          <span
            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
            style="top: -5px; left: 15px; height: 20px; min-width: 20px">3</span>
        </a>
        <a href="#" class="my-auto">
          <i class="fas fa-user fa-2x"></i>
        </a>
      </div>
    </div>
  </nav>
</div>
<!-- Navbar End -->

<!-- Modal Search End -->
