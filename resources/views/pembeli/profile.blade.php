@extends('layouts.market-app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Your Profile'])

  <div class="row">
    <div class="col-md-12">
      <div class="card" style="box-shadow: none;">
        <div style="position: relative;">
          <img src="{{ asset('markets/img/fruit-landscape.jpg') }}" class="card-img-top" alt="Gambar Buah-buahan"
            style="width: 100%; height: auto; max-width: none; max-height: 200px; object-fit: cover">
          <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3);">
          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="alert">
    @include('components.alert')
  </div>

  @if (Session::has('status'))
    <div class="alert alert-success mx-4 my-2" role="alert">
      {{ Session::get('message') }}
    </div>
  @endif

  <div class="container-fluid p-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card" style="margin: 0 10px; height: auto;">
          <form role="form" method="POST"
            action="{{ route('pembeli.profile.update', auth()->guard('pembeli')->user()->id_pembeli) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
                <button type="submit" class="btn btn-primary btn-sm mb-2 ms-auto px-3 py-2">Save</button>
              </div>
            </div>

            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="col-auto">
                <div class="avatar avatar-xl position-relative mt-2">
                  @if (auth()->guard('pembeli')->user()->foto_profil != '')
                    <img src="{{ asset('storage/foto_profil/' . auth()->guard('pembeli')->user()->foto_profil) }}"
                      class="w-100 rounded" alt="{{ auth()->guard('pembeli')->user()->nama }}">
                  @else
                    <img src="{{ asset('storage/photo/default-product.jpg') }}" class="w-100 rounded"
                      alt="{{ auth()->guard('pembeli')->user()->nama }}">
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="nama" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" name="nama"
                      value="{{ old('nama', auth()->guard('pembeli')->user()->nama) }}">
                    @error('nama')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="email" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" name="email"
                      value="{{ old('email', auth()->guard('pembeli')->user()->email) }}">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="username" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="username"
                      value="{{ old('username', auth()->guard('pembeli')->user()->username) }}">
                    @error('username')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="no_hp" class="form-control-label">No HP</label>
                    <input class="form-control" type="text" name="no_hp"
                      value="{{ old('username', auth()->guard('pembeli')->user()->no_hp) }}">
                    @error('no_hp')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="alamat" class="form-control-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5">{{ old('alamat', auth()->guard('pembeli')->user()->alamat) }}</textarea>
                    @error('alamat')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="foto_profil" class="form-control-label">Foto Profil</label>
                    <input class="form-control" type="file" name="foto_profil">
                    @error('foto_profil')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
