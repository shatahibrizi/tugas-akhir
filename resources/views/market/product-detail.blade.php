@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Product Table'])

  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Detail Produk</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Detail Produk</li>
    </ol>
  </div>
  <!-- Single Page Header End -->

  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
    </div>
  @elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <!-- Single Product Start -->
  <div class="container-fluid mt-5 py-5">
    <div class="container pb-5">
      <div class="row g-4 mb-5">
        <div class="col-lg-8 col-xl-9">
          <div class="row g-4">
            <div class="col-lg-4">
              <div class="rounded text-center">
                <a href="#">
                  @if ($product->foto_produk != '')
                    <img src="{{ asset('storage/foto_produk/' . $product->foto_produk) }}" class="img-fluid rounded"
                      alt="{{ $product->nama_produk }}">
                  @else
                    <img src="{{ asset('photo/default-product.jpg') }}" class="img-fluid"
                      alt="{{ $product->nama_produk }}">
                  @endif
                </a>
              </div>
            </div>
            <div class="col-lg-6 ms-2">
              <h4 class="fw-bold mb-3">{{ $product->nama_produk }}</h4>
              <p class="mb-3">Kategori: {{ $product['kategori']['nama'] }}</p>
              <h5 class="fw-semi-bold mb-3">Rp.{{ $product->harga }}/Kg</h5>
            </div>
            <div class="col-lg-12">
              <nav>
                <div class="nav nav-tabs mb-3">
                  <button class="nav-link active border-bottom-0 border-white" type="button" role="tab"
                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about"
                    aria-selected="true">Deskripsi</button>
                </div>
              </nav>
              <div class="tab-content mb-5">
                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                  <p class="text-justify">{{ $product->deskripsi }}</p>
                  <p>Detail produk: </p>
                  <div class="px-2">
                    <div class="row g-4">
                      <div class="col-6">
                        <div class="row bg-light align-items-center justify-content-center py-2 text-center">
                          <div class="col-6">
                            <p class="mb-0">Grade</p>
                          </div>
                          <div class="col-6">
                            <p class="mb-0">{{ $product->grade }}</p>
                          </div>
                        </div>
                        <div class="row align-items-center justify-content-center py-2 text-center">
                          <div class="col-6">
                            <p class="mb-0">Asal Petani</p>
                          </div>
                          <div class="col-6">
                            <p class="mb-0">{{ $product['petani']['nama'] }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xl-3">
          <div class="row g-4 fruite">
            <div class="col-lg-12 rounded border-2">
              <h4 class="my-3">Atur jumlah</h4>
              <div class="d-flex justify-content-start align-items-center mb-5">
                @if ($product->foto_produk != '')
                  <img src="{{ asset('storage/foto_produk/' . $product->foto_produk) }}" class="avatar avatar-xl rounded"
                    alt="{{ $product->nama_produk }}">
                @else
                  <img src="{{ asset('photo/default-product.jpg') }}" class="avatar avatar-xl"
                    alt="{{ $product->nama_produk }}">
                @endif
                <h6 class="ms-4 mt-2">{{ $product->nama_produk }}</h6>
              </div>
              <hr>
              <div class="d-flex flex-column align-items-center">
                <div class="d-flex justify-content-between align-items-center pt-4">
                  <div class="input-group quantity mb-4" style="width: 100px;">
                    <div class="input-group-btn">
                      <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <input type="text" id="quantity-input" class="form-control form-control-sm border-0 text-center"
                      value="1">
                    <div class="input-group-btn">
                      <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <h6 class="mb-4 ms-4">Stok: {{ $product->jumlah }}</h6>
                </div>
                <div class="d-flex justify-content-between align-items-center w-100">
                  <h6>Total harga: </h6>
                  <h5 id="total-price" data-price-per-unit="{{ $product->harga }}">Rp.{{ $product->harga }}</h5>
                </div>
                <a href="{{ route('addProduct.to.cart', $product->id_produk) }}"
                  class="btn border-secondary rounded-pill text-primary w-100 mb-4 border py-2">
                  <i class="fa fa-shopping-bag text-primary me-2"></i> Add to cart
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h1 class="fw-bold mb-0">Related products</h1>
    <div class="vesitable">
      <div class="owl-carousel vegetable-carousel justify-content-center">
        @foreach ($products as $item)
          <div class="border-primary position-relative vesitable-item h-100 d-flex flex-column rounded border">
            <a href="{{ $item->id_produk }}" class="text-decoration-none">
              <div class="vesitable-img">
                @if ($item->foto_produk != '')
                  <img src="{{ asset('storage/foto_produk/' . $item->foto_produk) }}"
                    class="img-fluid w-100 rounded-top" alt="{{ $item->nama_produk }}">
                @else
                  <img src="{{ asset('storage/photo/default-product.jpg') }}" class="img-fluid w-100 rounded-top"
                    alt="{{ $item->nama_produk }}">
                @endif
              </div>
              <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
                {{ $item['kategori']['nama'] }}
              </div>
              <div class="rounded-bottom d-flex flex-column flex-grow-1 p-4">
                <h4>{{ $item->nama_produk }}</h4>
                <div class="d-flex flex-column align-items-center">
                  <p class="text-dark fs-5 fw-bold mb-2">Rp.{{ $item->harga }} / kg</p>
                  <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"
                    style="margin-top: 10px;">
                    <i class="fa fa-shopping-bag text-primary me-2"></i> Add to cart
                  </a>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  </div>
  <!-- Single Product End -->
  @include('layouts.footers.market.footer')
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      var pricePerUnit = parseFloat($('#total-price').data('price-per-unit'));
      $('#quantity-input').on('input', function() {
        var quantity = $(this).val();
        var totalPrice = pricePerUnit * quantity;
        $('#total-price').text('Rp.' + totalPrice.toLocaleString());
      });

      $('.btn-minus').on('click', function() {
        var quantityInput = $(this).closest('.quantity').find('#quantity-input');
        var quantity = parseInt(quantityInput.val());
        if (quantity > 1) {
          quantityInput.val(quantity - 1).trigger('input');
        }
      });

      $('.btn-plus').on('click', function() {
        var quantityInput = $(this).closest('.quantity').find('#quantity-input');
        var quantity = parseInt(quantityInput.val());
        quantityInput.val(quantity + 1).trigger('input');
      });
    });
  </script>
@endsection
