@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Product Table'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>Tabel Produk</h6>
            <div class="col-auto">
              <a href="product-add" class="btn btn-dark">Tambah Produk</a>
            </div>
          </div>
          {{-- {{ $productList['petani']['nama'] }} --}}
          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              <table class="align-items-center mb-0 table">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Harga(KG)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Jumlah</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Grade</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Kategori</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Petani</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($productList as $item)
                    <tr>
                      <td>
                        <p class="font-weight-bold mb-0 ms-3 text-xs">{{ $loop->iteration }}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $item->nama_produk }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-sm">Rp. {{ $item->harga }}</p>
                        {{-- <p class="text-secondary mb-0 text-sm">/Kg</p> --}}
                      </td>
                      {{-- <td class="text-center align-middle text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td> --}}
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->jumlah }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->grade }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item['kategori']['nama'] }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item['petani']['nama'] }}</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold ms-4 text-center text-xs"
                          data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection
