@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Detail petani</p>
              <a href="{{ route('petani.edit', ['id_petani' => $petani->id_petani]) }}"
                class="btn btn-dark btn-sm ms-auto">Edit</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 mb-4">
                <div class="d-flex flex-column align-items-start">
                  @if ($petani->foto != '')
                    <img src="{{ asset('storage/foto/' . $petani->foto) }}" class="avatar-xxl rounded"
                      alt="{{ $petani->nama }}">
                  @else
                    <img src="{{ asset('photo/default-product.jpg') }}" class="img-fluid" alt="{{ $petani->nama }}">
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <x-text-input label="Nama" name="nama" id="nama" value="{{ $petani->nama }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Alamat" name="alamat" id="alamat" value="{{ $petani->alamat }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="No HP" name="no_hp" id="no_hp" value="{{ $petani->no_hp }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Luas lahan (A)" name="luas_lahan" id="luas_lahan" value="{{ $petani->luas_lahan }}"
                    required readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Lokasi lahan" name="lokasi_lahan" id="lokasi_lahan"
                    value="{{ $petani->lokasi_lahan }}" required readonly />
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
