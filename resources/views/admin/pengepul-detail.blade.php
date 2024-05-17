@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Detail pengepul</p>
              <a href="{{ route('pengepul.edit', ['id_pengepul' => $pengepul->id_pengepul]) }}"
                class="btn btn-dark btn-sm ms-auto">Edit</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 mb-4">
                <div class="d-flex flex-column align-items-start">
                  @if ($pengepul->foto_profil != '')
                    <img src="{{ asset('storage/foto_profil/' . $pengepul->foto_profil) }}" class="avatar-xxl rounded"
                      alt="{{ $pengepul->nama }}">
                  @else
                    <img src="{{ asset('photo/default-product.jpg') }}" class="img-fluid" alt="{{ $pengepul->nama }}">
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <x-text-input label="Nama" name="nama" id="nama" value="{{ $pengepul->nama }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Email" name="email" id="email" value="{{ $pengepul->email }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Username" name="username" id="username" value="{{ $pengepul->username }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Alamat" name="alamat" id="alamat" value="{{ $pengepul->alamat }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="No HP" name="no_hp" id="no_hp" value="{{ $pengepul->no_hp }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="No Rek" name="no_hp" id="no_hp" value="{{ $pengepul->no_rek }}" required
                    readonly />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  @include('layouts.footers.auth.footer')
  </div>
@endsection
