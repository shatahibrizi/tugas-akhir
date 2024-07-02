@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
  <div class="card card-profile-bottom mx-4 shadow-lg">
    <div class="card-body p-3">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative mt-2">
            @if (auth()->user()->foto_profil != '')
              <img src="{{ asset('storage/foto_profil/' . auth()->user()->foto_profil) }}" class="w-100 rounded"
                alt="{{ auth()->user()->nama }}">
            @else
              <img src="{{ asset('storage/photo/default-product.jpg') }}" class="w-100 rounded"
                alt="{{ auth()->user()->nama }}">
            @endif
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ auth()->user()->nama }}
            </h5>
            <p class="font-weight-bold mb-0 text-sm">
              Public Relations
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
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
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form role="form" method="POST" action="{{ route('profile.update', auth()->user()->id_pengepul) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" name="nama"
                      value="{{ old('nama', auth()->user()->nama) }}">
                    @error('nama')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email" class="form-control-label">Email</label>
                    <input class="form-control" type="email" name="email"
                      value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="username"
                      value="{{ old('username', auth()->user()->username) }}">
                    @error('username')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="alamat" class="form-control-label">Alamat</label>
                    <input class="form-control" type="text" name="alamat"
                      value="{{ old('alamat', auth()->user()->alamat) }}">
                    @error('alamat')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="no_hp" class="form-control-label">No HP</label>
                    <input class="form-control" type="text" name="no_hp"
                      value="{{ old('no_hp', auth()->user()->no_hp) }}">
                    @error('no_hp')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="no_rek" class="form-control-label">No Rekening</label>
                    <input class="form-control" type="text" name="no_rek"
                      value="{{ old('no_rek', auth()->user()->no_rek) }}">
                    @error('no_rek')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
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
    @include('layouts.footers.auth.footer')
  </div>
@endsection
