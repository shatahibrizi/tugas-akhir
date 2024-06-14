@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Product Table'])
  <!-- Hero Start -->
  <div class="container-fluid hero-header mb-2 py-5">
    <div class="container py-5">
      <div class="row g-5 align-items-center">
        <div class="col-md-12 col-lg-7">
          <h4 class="text-secondary mb-3">100% Organic Foods</h4>
          <h1 class="display-3 text-primary mb-5">Organic Veggies & Fruits Foods</h1>
          <div class="position-relative mx-auto">
            <input class="form-control border-secondary w-75 border-1 rounded-1 px-4 py-3" type="number"
              placeholder="Search" />
            <button type="submit"
              class="btn btn-primary border-secondary border-start-0 position-absolute h-100 rounded-end px-4 py-3 text-white"
              style="top: 0; right: 25%">
              Submit Now
            </button>
          </div>
        </div>
        <div class="col-md-12 col-lg-5">
          <img src="{{ asset('markets/img/landing-page-fruit.jpg') }}" class="img-fluid rounded-1">
        </div>
      </div>
    </div>
  </div>
  <!-- Hero End -->

  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
    </div>
  @elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <!-- Featurs Section Start -->
  <div class="container-fluid featurs py-5">
    <div class="container py-5">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-car-side fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Free Shipping</h5>
              <p class="mb-0">Free on order over $300</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-user-shield fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Security Payment</h5>
              <p class="mb-0">100% security payment</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-exchange-alt fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>30 Day Return</h5>
              <p class="mb-0">30 day money guarantee</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fa fa-phone-alt fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>24/7 Support</h5>
              <p class="mb-0">Support every time fast</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Featurs Section End -->

  <!-- Fruits Shop Start-->
  <div class="container-fluid fruite py-5">
    <div class="container py-5">
      <div class="tab-class text-center">
        <div class="row g-4">
          <div class="col-lg-4 text-start">
            <h1>Our Organic Products</h1>
          </div>
          <div class="col-lg-8 text-end">
            <ul class="nav nav-pills d-inline-flex mb-5 text-center">
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill {{ Request::get('kategori') == null ? 'active' : '' }} m-2 py-2"
                  data-bs-toggle="pill" href="{{ route('market') }}">
                  <span class="text-dark" style="width: 130px">All Products</span>
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
                            <p class="flex-grow-1">
                              {{ $item->deskripsi }}
                            </p>
                            <div class="d-flex flex-column align-items-center">
                              <p class="text-dark fs-5 fw-bold mb-2">Rp.{{ $item->harga }} / kg</p>
                              <p class="text-dark fs-6 fw-bold mb-2">
                                @foreach ($item->pengepul as $pengepul)
                                  {{ $pengepul->nama }}@if (!$loop->last)
                                    ,
                                  @endif
                                @endforeach
                              </p>
                              <a href="{{ route('addProduct.to.cart', $item->id_produk) }}"
                                class="btn border-secondary rounded-pill text-primary border px-3"
                                style="margin-top: 10px;">
                                <i class="fa fa-shopping-bag text-primary me-2"></i> Add to cart
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

  <!-- Fruits Shop End-->

  <!-- Vesitable Shop Start-->
  <div class="container-fluid vesitable py-5">
    <div class="container py-5">
      <h1 class="mb-0">Fresh Organic Vegetables</h1>
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
              Vegetable
            </div>
            <div class="rounded-bottom d-flex flex-column flex-grow-1 p-4">
              <h4>{{ $item->nama_produk }}</h4>
              <p class="flex-grow-1">
                {{ $item->deskripsi }}
              </p>
              <div class="d-flex flex-column align-items-center">
                <p class="text-dark fs-5 fw-bold mb-2">Rp. {{ $item->harga }} / kg</p>
                <p class="text-dark fs-6 fw-bold mb-2">
                  @foreach ($item->pengepul as $pengepul)
                    {{ $pengepul->nama }}@if (!$loop->last)
                      ,
                    @endif
                  @endforeach
                </p>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"
                  style="margin-top: 10px;">
                  <i class="fa fa-shopping-bag text-primary me-2"></i> Add to cart
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Vesitable Shop End -->

  <!-- Banner Section Start-->
  <div class="container-fluid banner bg-secondary my-5">
    <div class="container py-5">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6">
          <div class="py-4">
            <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
            <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
            <p class="text-dark mb-4">
              The generated Lorem Ipsum is therefore always free from repetition injected humour,
              or non-characteristic words etc.
            </p>
            <a href="#" class="banner-btn btn rounded-pill text-dark border-2 border-white px-5 py-3">BUY</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="position-relative">
            <img src="{{ asset('markets/img/baner-1.png') }} " class="img-fluid w-100 rounded" alt="" />
            <div class="d-flex align-items-center justify-content-center rounded-circle position-absolute bg-white"
              style="width: 140px; height: 140px; top: 0; left: 0">
              <h1 style="font-size: 100px">1</h1>
              <div class="d-flex flex-column">
                <span class="h2 mb-0">50$</span>
                <span class="h4 text-muted mb-0">kg</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Section End -->

  <!-- Fact Start -->
  <div class="container-fluid py-5">
    <div class="container">
      <div class="bg-light rounded p-5">
        <div class="row g-4 justify-content-center">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>satisfied customers</h4>
              <h1>1963</h1>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>quality of service</h4>
              <h1>99%</h1>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>quality certificates</h4>
              <h1>33</h1>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>Available Products</h4>
              <h1>789</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Fact Start -->

  <!-- Tastimonial Start -->
  <div class="container-fluid testimonial py-5">
    <div class="container py-5">
      <div class="testimonial-header text-center">
        <h4 class="text-primary">Our Testimonial</h4>
        <h1 class="display-5 text-dark mb-5">Our Client Saying!</h1>
      </div>
      <div class="owl-carousel testimonial-carousel">
        <div class="testimonial-item img-border-radius bg-light rounded p-4">
          <div class="position-relative">
            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0"></i>
            <div class="border-bottom border-secondary mb-4 pb-4">
              <p class="mb-0">
                Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's
                standard dummy text ever since the 1500s,
              </p>
            </div>
            <div class="d-flex align-items-center flex-nowrap">
              <div class="bg-secondary rounded">
                <img src="{{ asset('markets/img/testimonial-1.jpg') }} " class="img-fluid rounded"
                  style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="d-block ms-4">
                <h4 class="text-dark">Client Name</h4>
                <p class="m-0 pb-3">Profession</p>
                <div class="d-flex pe-5">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item img-border-radius bg-light rounded p-4">
          <div class="position-relative">
            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0"></i>
            <div class="border-bottom border-secondary mb-4 pb-4">
              <p class="mb-0">
                Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's
                standard dummy text ever since the 1500s,
              </p>
            </div>
            <div class="d-flex align-items-center flex-nowrap">
              <div class="bg-secondary rounded">
                <img src="{{ asset('markets/img/testimonial-1.jpg') }} " class="img-fluid rounded"
                  style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="d-block ms-4">
                <h4 class="text-dark">Client Name</h4>
                <p class="m-0 pb-3">Profession</p>
                <div class="d-flex pe-5">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item img-border-radius bg-light rounded p-4">
          <div class="position-relative">
            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0"></i>
            <div class="border-bottom border-secondary mb-4 pb-4">
              <p class="mb-0">
                Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's
                standard dummy text ever since the 1500s,
              </p>
            </div>
            <div class="d-flex align-items-center flex-nowrap">
              <div class="bg-secondary rounded">
                <img src="{{ asset('markets/img/testimonial-1.jpg') }} " class="img-fluid rounded"
                  style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="d-block ms-4">
                <h4 class="text-dark">Client Name</h4>
                <p class="m-0 pb-3">Profession</p>
                <div class="d-flex pe-5">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Tastimonial End -->
  @include('layouts.footers.market.footer')
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
