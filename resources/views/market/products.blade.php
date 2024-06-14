@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Product Table'])

  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item text-secondary"><a href="{{ route('market') }}">Home</a></li>
      <li class="breadcrumb-item text-secondary"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
  </div>
  <!-- Single Page Header End -->
  <!-- Pesan Status -->
  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
    </div>
  @elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif
  <!-- Fruits Shop Start -->
  <div class="container-fluid fruite flex-grow-1 py-5">
    <div class="container py-5">
      <h1 class="mb-4">Fresh fruits shop</h1>
      <div class="row g-4">
        <div class="col-lg-12">
          <form method="GET" action="">
            <div class="row g-4">
              <div class="col-lg-3">
                <div class="row g-4">
                  <div class="input-group w-100 d-flex mx-auto">
                    <input type="search" name="keyword" class="form-control p-3" placeholder="Keyword"
                      aria-describedby="search-icon-1">
                    <button id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                  </div>
                  <div class="col-lg-12">
                    <div class="mb-1">
                      <h4>Categories</h4>
                      <ul class="list-unstyled fruite-categorie">
                        <li>
                          <div class="d-flex justify-content-between fruite-name">
                            <a href="?kategori=Buah"><i class="fas fa-apple-alt me-2"></i>Buah</a>
                            <span>(3)</span>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex justify-content-between fruite-name">
                            <a href="?kategori=Sayur"><i class="fas fa-apple-alt me-2"></i>Sayur</a>
                            <span>(5)</span>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex justify-content-between fruite-name">
                            <a href="?kategori=Palawija"><i class="fas fa-apple-alt me-2"></i>Palawija</a>
                            <span>(2)</span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="mb-1">
                      <h4 class="mb-2">Price</h4>
                      <div class="d-flex">
                        <input type="number" name="min_price" class="form-control me-2" placeholder="Min Price"
                          value="{{ request('min_price') }}">
                        <input type="number" name="max_price" class="form-control" placeholder="Max Price"
                          value="{{ request('max_price') }}">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="mb-1">
                      <h4>Grade</h4>
                      <select name="filter" class="form-select w-100">
                        <option value="">All</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="mb-3">
                      <h4>Farmer</h4>
                      <select name="petani" class="form-select w-100">
                        <option value="">All</option>
                        @foreach ($allPetani as $petaniName)
                          <option value="{{ $petaniName }}">{{ $petaniName }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="position-relative">
                      <img src="{{ asset('markets/img/banner-fruits.jpg') }}" class="img-fluid w-100 rounded"
                        alt="">
                      <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="row g-4 justify-content-start">
                  @if ($products->isEmpty())
                    <div class="col-12">
                      <div class="alert alert-warning text-center" role="alert">
                        Tidak ada produk
                      </div>
                    </div>
                  @else
                    @foreach ($products as $item)
                      <div class="col-md-6 col-lg-4 col-xl-4">
                        <a href="product-detail/{{ $item->id_produk }}" class="text-decoration-none">
                          <div
                            class="position-relative fruite-item d-flex flex-column h-100 border-secondary rounded border">
                            <div class="fruite-img" style="max-height: 180px; overflow: hidden;">
                              @if ($item->foto_produk != '')
                                <img src="{{ asset('storage/foto_produk/' . $item->foto_produk) }}"
                                  class="img-fluid w-100 rounded-top" style="object-fit: cover;"
                                  alt="{{ $item->nama_produk }}">
                              @else
                                <img src="{{ asset('storage/photo/default-product.jpg') }}"
                                  class="img-fluid w-100 rounded-top" style="object-fit: cover;"
                                  alt="{{ $item->nama_produk }}">
                              @endif
                            </div>
                            <div class="d-flex justify-content-between w-100">
                              <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                                style="top: 10px; left: 10px;">
                                {{ $item->kategori->nama }}
                              </div>
                              <div class="position-absolute rounded bg-white px-3 py-1 text-white"
                                style="top: 10px; right: 10px;">
                                <a href="{{ route('addProduct.to.favorite', $item->id_produk) }}" class="text-white">
                                  <i class="fa fa-heart text-danger text-xl"></i>
                                </a>
                              </div>
                            </div>
                            <div class="rounded-bottom d-flex flex-column flex-grow-1 p-4 text-center">
                              <h4>{{ $item->nama_produk }}</h4>
                              <p class="flex-grow-1">{{ $item->deskripsi }}</p>
                              <div class="d-flex flex-column align-items-center">
                                <p class="text-dark fs-5 fw-bold mb-2">Rp.{{ number_format($item->harga, 0, ',', '.') }}
                                  / kg</p>
                                <p class="text-dark fs-6 fw-bold mb-2">Pengepul:
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
                  @endif
                </div>
              </div>

            </div>
            <div class="col-12">
              <div class="pagination d-flex justify-content-center mt-5">
                {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Fruits Shop End -->
  @include('layouts.footers.market.footer')
@endsection
