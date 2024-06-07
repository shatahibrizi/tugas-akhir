@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Daftar Pembeli'])

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>Daftar Pembeli</h6>
          </div>

          @if (Session::has('status'))
            <div class="alert alert-success mx-4 my-2" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              @if ($pembeli->isEmpty())
                <p class="text-center">Tidak ada pembeli yang terdaftar.</p>
              @else
                <table class="align-items-center mb-0 table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No HP</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pembeli as $buyer)
                      <tr>
                        <td>
                          <p class="font-weight-bold mb-0 ms-3 text-xs">{{ $loop->iteration }}</p>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $buyer->nama }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $buyer->email }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $buyer->username }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $buyer->alamat }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $buyer->no_hp }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <a href="#" class="btn btn-sm btn-primary">Edit</a>
                          <a href="#" class="btn btn-sm btn-danger">Hapus</a>
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
