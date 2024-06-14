@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Your Orders'])

  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Your Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Orders</li>
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

  <!-- Orders Page Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <h1 class="mb-4">Produk Favorit</h1>
      @if ($favorites->isEmpty())
        <p class="text-center">Anda belum menambahkan produk favorit.</p>
      @else
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th scope="col" style="width: 20%;" class="text-center">Nama Produk</th>
                <th scope="col" style="width: 30%;" class="text-center">Deskripsi</th>
                <th scope="col" style="width: 15%;" class="text-center">Harga</th>
                <th scope="col" style="width: 20%;" class="text-center">Pengepul</th>
                <th scope="col" style="width: 10%;" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach ($favorites as $favorite)
                <tr>
                  <td>
                    <div class="d-flex justify-content-center px-2 py-1">
                      <div>
                        @if ($favorite->foto_produk != '')
                          <img src="{{ asset('storage/foto_produk/' . $favorite->foto_produk) }}"
                            class="avatar avatar-xl me-3" alt="{{ $favorite->nama_produk }}">
                        @else
                          <img src="{{ asset('storage/photo/default-product.jpg') }}" class="avatar avatar-xl me-3"
                            alt="{{ $favorite->nama_produk }}">
                        @endif

                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $favorite->nama_produk }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    {{ $favorite->deskripsi }}
                  </td>
                  <td>
                    Rp.
                    {{ number_format($favorite->harga, 0, ',', '.') }}
                  </td>
                  <td>
                    @foreach ($favorite->pengepul as $pengepul)
                      {{ $pengepul->nama }}
                      @if (!$loop->last)
                        ,
                      @endif
                    @endforeach
                  </td>
                  <td>
                    <div class="d-flex justify-content-evenly">
                      <a href="{{ route('product.shop.detail', $favorite->id_produk) }}"
                        class="text-info font-weight-bold text-xl">
                        <i class="fa fa-info text-info text-sm opacity-10" aria-hidden="true"></i>
                      </a>
                      <a href="{{ route('removeProduct.from.favorite', $favorite->id_produk) }}"
                        class="text-info font-weight-bold text-xl">
                        <i class="fa fa-trash text-danger text-sm opacity-10" aria-hidden="true"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
  <!-- Orders Page End -->

  @include('layouts.footers.market.footer')

@endsection
