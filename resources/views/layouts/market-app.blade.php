<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>@yield('title', 'Fruitables - Vegetable Website Template')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
    rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="{{ asset('markets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('markets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('markets/css/bootstrap.min.css') }}" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="{{ asset('markets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
  @yield('content')
  <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
      class="fa fa-arrow-up"></i></a>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="{{ asset('markets/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('markets/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('markets/lib/lightbox/js/lightbox.min.js') }}"></script>
  <script src="{{ asset('markets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Javascript -->
  <script src="{{ asset('markets/js/main.js') }}"></script>
  @stack('js')
  @yield('scripts')
</body>

</html>
