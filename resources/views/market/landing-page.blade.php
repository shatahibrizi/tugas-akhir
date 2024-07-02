@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Tabel Produk'])
  <!-- Hero Mulai -->
  <div class="container-fluid hero-header mb-2 py-5">
    <div class="container py-5">
      <div class="row g-5 align-items-center">
        <div class="col-md-12 col-lg-7">
          <h4 class="text-secondary mb-3">100% Makanan Organik</h4>
          <h1 class="display-3 text-primary mb-5">Sayuran & Buah-buahan Organik</h1>
        </div>
        <div class="col-md-12 col-lg-5">
          <img src="{{ asset('markets/img/landing-page-fruit.jpg') }}" class="img-fluid rounded-1">
        </div>
      </div>
    </div>
  </div>
  <!-- Hero Selesai -->

  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
    </div>
  @elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <!-- Bagian Fitur Mulai -->
  <div class="container-fluid featurs py-5">
    <div class="container py-5">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-car-side fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Pengiriman Gratis</h5>
              <p class="mb-0">Untuk pesanan di atas harga tertentu</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-user-shield fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Pembayaran Aman</h5>
              <p class="mb-0">100% pembayaran <br> aman</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-thumbs-up fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Kualitas Terjamin</h5>
              <p class="mb-0">Kualitas terbaik, segar, dan unggul</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fa fa-phone-alt fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Dukungan 24/7</h5>
              <p class="mb-0">Dukungan cepat <br> setiap saat</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bagian Fitur Selesai -->

  <!-- Toko Buah Mulai -->
  <div class="container-fluid fruite py-5">
    <div class="container py-5">
      <div class="tab-class text-center">
        <div class="row g-4">
          <div class="col-lg-4 text-start">
            <h1>Produk Organik Kami</h1>
          </div>
          <div class="col-lg-8 text-end">
            <ul class="nav nav-pills d-inline-flex mb-5 text-center">
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill {{ Request::get('kategori') == null ? 'active' : '' }} m-2 py-2"
                  data-bs-toggle="pill" href="{{ route('market') }}">
                  <span class="text-dark" style="width: 130px">Semua Produk</span>
                </a>
              </li>
              @foreach ($allKategori as $category)
                <li class="nav-item">
                  <a class="d-flex bg-light rounded-pill {{ Request::get('kategori') == $category ? 'active' : '' }} m-2 py-2"
                    href="{{ route('market', ['kategori' => $category]) }}">
                    <span class="text-dark" style="width: 130px">{{ $category }}</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="tab-content">
          <div id="tab-1" class="tab-pane fade show active p-0">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  @foreach ($products as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                      <a href="product-detail/{{ $item->id_produk }}" class="text-decoration-none">
                        <div
                          class="position-relative fruite-item d-flex flex-column h-100 border-secondary rounded border">
                          <div class="fruite-img" style="max-height: 180px; overflow: hidden;">
                            <!-- Mengatur max-height dan overflow -->
                            @if ($item->foto_produk != '')
                              <img src="{{ asset('storage/foto_produk/' . $item->foto_produk) }}"
                                class="img-fluid w-100 rounded-top" style="object-fit: cover;"
                                alt="{{ $item->nama_produk }}"> <!-- Penambahan object-fit -->
                            @else
                              <img src="{{ asset('storage/photo/default-product.jpg') }}"
                                class="img-fluid w-100 rounded-top" style="object-fit: cover;"
                                alt="{{ $item->nama_produk }}"> <!-- Penambahan object-fit -->
                            @endif
                          </div>
                          <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                            style="top: 10px; left: 10px;">
                            {{ $item['kategori']['nama'] }}
                          </div>
                          <div class="rounded-bottom d-flex flex-column flex-grow-1 p-4">
                            <h4>{{ $item->nama_produk }}</h4>

                            <div class="d-flex flex-column align-items-center">
                              <p class="text-dark fs-5 fw-bold mb-2">Rp.{{ $item->harga }} / kg</p>
                              <p class="text-dark fs-6 fw-bold mb-2">
                                @foreach ($item->pengepul as $pengepul)
                                  {{ $pengepul->nama }}@if (!$loop->last)
                                    ,
                                  @endif
                                @endforeach
                              </p>
                              <a href="#"
                                class="btn border-secondary rounded-pill text-primary d-flex align-items-center border px-3"
                                style="margin-top: 10px;">
                                <i class="fa fa-shopping-bag text-primary" style="margin-right: 4px;"></i>Tambah ke
                                keranjang
                              </a>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Toko Buah Selesai -->

  <!-- Toko Sayuran Mulai -->
  <div class="container-fluid vesitable py-5">
    <div class="container py-5">
      <h1 class="mb-0">Sayuran Organik Segar</h1>
      <div class="owl-carousel vegetable-carousel justify-content-center">
        @foreach ($vegetables as $item)
          <div class="border-primary position-relative vesitable-item h-100 d-flex flex-column rounded border">
            <div class="vesitable-img">
              @if ($item->foto_produk != '')
                <img src="{{ asset('storage/foto_produk/' . $item->foto_produk) }}" class="img-fluid w-100 rounded-top"
                  alt="{{ $item->nama_produk }}">
              @else
                <img src="{{ asset('storage/photo/default-product.jpg') }}" class="img-fluid w-100 rounded-top"
                  alt="{{ $item->nama_produk }}">
              @endif
            </div>
            <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
              Sayuran
            </div>
            <div class="rounded-bottom d-flex flex-column flex-grow-1 p-4">
              <h4>{{ $item->nama_produk }}</h4>
              <div class="d-flex flex-column align-items-center">
                <p class="text-dark fs-5 fw-bold mb-2">Rp. {{ $item->harga }} / kg</p>
                <p class="text-dark fs-6 fw-bold mb-2">
                  @foreach ($item->pengepul as $pengepul)
                    {{ $pengepul->nama }}@if (!$loop->last)
                      ,
                    @endif
                  @endforeach
                </p>
                <a href="#"
                  class="btn border-secondary rounded-pill text-primary d-flex align-items-center border px-3"
                  style="margin-top: 10px;">
                  <i class="fa fa-shopping-bag text-primary me-2"></i> Tambah ke keranjang
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Toko Sayuran Selesai -->

  <!-- Bagian Banner Mulai -->
  <div class="container-fluid banner bg-secondary my-5">
    <div class="container py-5">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6">
          <div class="py-4">
            <h1 class="display-3 text-white">Produk Segar</h1>
            <p class="fw-normal display-3 text-dark mb-4">di Toko Kami</p>
            <p class="text-dark mb-4">
              Kami menyediakan berbagai macam buah eksotis segar yang siap memanjakan lidah Anda. Setiap buah dipilih
              dengan cermat untuk memastikan kualitas dan kesegaran terbaik.
            </p>
            <a href="#" class="banner-btn btn rounded-pill text-dark border-2 border-white px-5 py-3">BELI</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="position-relative">
            <img src="{{ asset('markets/img/baner-1.png') }} " class="img-fluid w-100 rounded" alt="" />
            <div class="d-flex align-items-center justify-content-center rounded-circle position-absolute bg-white"
              style="width: 140px; height: 140px; top: 0; left: 0">
              <h1 style="font-size: 100px">1</h1>
              <div class="d-flex flex-column">
                <span class="h2 mb-0">40K</span>
                <span class="h4 text-muted mb-0">kg</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Banner Section End -->
  {{-- @include('layouts.footers.market.footer') --}}
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // Menangkap klik pada tautan kategori
      $('.category-filter').click(function(event) {
        event.preventDefault(); // Mencegah perilaku default dari tautan

        var category = $(this).data('category'); // Mendapatkan kategori dari data-category

        // Melakukan permintaan AJAX
        $.ajax({
          url: "{{ route('market') }}", // Menggunakan route 'market' yang sesuai
          method: 'GET',
          data: {
            kategori: category
          }, // Mengirim kategori yang dipilih ke controller
          success: function(response) {
            // Memperbarui bagian tampilan produk dengan daftar produk yang diperoleh
            $('#product-container').html(response);
          },
          error: function(xhr, status, error) {
            // Handle error jika ada
            console.error(error);
          }
        });
      });
    });
  </script>
@endsection
