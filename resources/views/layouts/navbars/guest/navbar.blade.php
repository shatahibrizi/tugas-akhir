<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg border-radius-lg mx-4 mt-4 py-2 shadow blur">
        <div class="container-fluid">
          <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="{{ route('home') }}">
            Agro Sembalun
          </a>
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
              <li class="nav-item">
                <a class="nav-link me-2" href="{{ route('register') }}">
                  <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                  Sign Up
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-2" href="{{ route('login') }}">
                  <i class="fas fa-key opacity-6 text-dark me-1"></i>
                  Login
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>
  </div>
</div>
