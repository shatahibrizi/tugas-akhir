<!-- Navbar -->
<nav
  class="navbar navbar-main navbar-expand-lg border-radius-xl {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }} mx-4 px-0 shadow-none"
  id="navbarBlur" data-scroll="false">
  <div class="container-fluid px-3 py-1">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb me-sm-6 mb-0 me-5 bg-transparent px-0 pb-0 pt-1">
        <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item active text-sm text-white" aria-current="page">{{ $title }}</li>
      </ol>
      <h6 class="font-weight-bolder mb-0 text-white">{{ $title }}</h6>
    </nav>
    <div class="navbar-collapse mt-sm-0 me-md-0 me-sm-4 collapse mt-2" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        @if (auth()->guard('admin')->check())
          <!-- Admin specific content here if needed -->
        @else
          <!-- Pengepul specific content here if needed -->
        @endif
      </div>
      <ul class="navbar-nav justify-content-end">
        @if (auth()->check())
          <li class="nav-item d-flex align-items-center me-3">
            <a href="{{ auth()->guard('admin')->check() ? route('admin.profile', auth()->user() ? auth()->user()->id_admin : '') : route('profile', auth()->user() ? auth()->user()->id_pengepul : '') }}"
              class="d-flex align-items-center text-decoration-none">
              <img
                src="{{ auth()->user()->foto_profil ? asset('storage/foto_profil/' . auth()->user()->foto_profil) : asset('img/default-user.png') }}"
                class="avatar avatar-sm me-2">
              <div class="d-flex flex-column justify-content-center">
                <span class="font-weight-bold text-white">{{ auth()->user()->nama }}</span>
                <span class="text-xs text-white">{{ auth()->guard('admin')->check() ? 'Admin' : 'Pengepul' }}</span>
              </div>
            </a>
          </li>
        @endif
        <li class="nav-item d-flex align-items-center">
          @if (auth()->guard('admin')->check())
            <form role="form" method="POST" action="{{ route('admin_logout') }}" id="logout-form">
              @csrf
              <button type="submit" class="btn btn-link nav-link font-weight-bold mt-3 px-0 text-white">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Log out</span>
              </button>
            </form>
          @else
            <form role="form" method="POST" action="{{ route('logout') }}" id="logout-form">
              @csrf
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="nav-link font-weight-bold px-0 text-white">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Log out</span>
              </a>
            </form>
          @endif
        </li>

        <li class="nav-item d-xl-none d-flex align-items-center ps-3">
          <a href="javascript:;" class="nav-link p-0 text-white" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center px-3">
          <a href="javascript:;" class="nav-link p-0 text-white">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
          </a>
        </li>
        @if (auth()->check() && !auth()->guard('admin')->check())
          <li class="nav-item dropdown d-flex align-items-center pe-2">
            <a href="javascript:;" class="nav-link p-0 text-white" id="dropdownMenuButton" data-bs-toggle="dropdown"
              aria-expanded="false" onclick="markAsRead()">
              <i class="fa fa-bell cursor-pointer"></i>
              @if (auth()->user()->unreadNotifications->count())
                <span class="badge bg-danger"
                  id="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end me-sm-n4 px-2 py-3" aria-labelledby="dropdownMenuButton">
              @foreach (auth()->user()->unreadNotifications as $notification)
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="{{ $notification->data['pembeli_image'] ?? asset('img/default-user.png') }}"
                          class="avatar avatar-sm me-3">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="font-weight-normal mb-1 text-sm">
                          <span class="font-weight-bold">New order</span> from {{ $notification->data['message'] }}
                        </h6>
                        <p class="text-secondary mb-0 text-xs">
                          <i class="fa fa-clock me-1"></i>
                          {{ $notification->created_at->diffForHumans() }}
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              @endforeach
              @foreach (auth()->user()->readNotifications as $notification)
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="{{ $notification->data['pembeli_image'] ?? asset('img/default-user.png') }}"
                          class="avatar avatar-sm me-3">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="font-weight-normal mb-1 text-sm">
                          <span class="font-weight-bold">New order</span> from {{ $notification->data['message'] }}
                        </h6>
                        <p class="text-secondary mb-0 text-xs">
                          <i class="fa fa-clock me-1"></i>
                          {{ $notification->created_at->diffForHumans() }}
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function markAsRead() {
    console.log('markAsRead function called'); // Tambahkan log ini
    $.ajax({
      type: 'POST',
      url: '{{ route('markAsRead') }}',
      success: function(data) {
        console.log('Success:', data); // Tambahkan log ini
        if (data.success) {
          $('#notification-count').remove();
        }
      },
      error: function(xhr) {
        console.error('Error:', xhr.responseText); // Tambahkan log ini
      }
    });
  }
</script>
