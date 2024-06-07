@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Produk'])

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">

          @if (Session::has('status'))
            <div class="alert alert-success mx-4 my-2" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              @if ($tambahProduk->isEmpty())
                <p class="text-center">Tidak ada produk yang ditambahkan.</p>
              @else
                <table class="align-items-center mb-0 table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jumlah
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Tanggal
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tambahProduk as $item)
                      <tr>
                        <td>
                          <p class="font-weight-bold mb-0 ms-3 text-xs">{{ $loop->iteration }}</p>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              @if ($item->foto_produk != '')
                                <img src="{{ asset('storage/foto_produk/' . $item->foto_produk) }}"
                                  class="avatar avatar-lg me-3" alt="{{ $item->nama_produk }}">
                              @else
                                <img src="{{ asset('storage/photo/default-product.jpg') }}" class="avatar avatar-lg me-3"
                                  alt="{{ $item->nama_produk }}">
                              @endif

                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $item->nama_produk }}</h6>
                            </div>
                          </div>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $item->jumlah }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $item->tanggal }}</span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection
