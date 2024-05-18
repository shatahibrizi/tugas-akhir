@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Detail produk</p>
              <a href="{{ route('product.edit', ['id_produk' => $products->id_produk]) }}"
                class="btn btn-dark btn-sm ms-auto">Edit</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <x-text-input label="Nama" name="nama_produk" id="nama" value="{{ $products->nama_produk }}"
                    required readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Harga" name="harga" id="harga" value="{{ $products->harga }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Jumlah" name="jumlah" id="jumlah" value="{{ $products->jumlah }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Grade" name="grade" id="grade" value="{{ $products->grade }}" required
                    readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Kategori" name="kategori" id="kategori" value="{{ $products->kategori->nama }}"
                    required readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Asal petani" name="petani" id="petani" value="{{ $products->petani->nama }}"
                    required readonly />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <x-text-input label="Estimasi busuk" name="estimasi_busuk" id="estimasi_busuk"
                    value="{{ $products->estimasi_busuk }}" required readonly />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <x-large-text-input label="Deskripsi Produk" name="deskripsi" id="deskripsi"
                    value="{{ $products->deskripsi }}" readonly />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                </div>
              </div>
              <div class="col-md-6">
                <div class="d-flex flex-column align-items-start">
                  <label for="example-text-input" class="form-label mb-4">Foto produk</label>
                  <div class="m-auto">
                    @if ($products->foto_produk != '')
                      <img src="{{ asset('storage/foto_produk/' . $products->foto_produk) }}" class="img-fluid rounded"
                        alt="{{ $products->nama_produk }}">
                    @else
                      <img src="{{ asset('photo/default-product.jpg') }}" class="img-fluid"
                        alt="{{ $products->nama_produk }}">
                    @endif
                  </div>
                </div>
              </div>
              <!-- QR Code -->
              <div class="col-md-6">
                <div class="d-flex flex-column align-items-start">
                  <label for="example-text-input" class="form-label mb-4">QR Code</label>
                  <div class="m-auto">
                    @if ($products->qr_code_path)
                      <img src="{{ asset($products->qr_code_path) }}" class="img-fluid" alt="QR Code">
                    @else
                      <p>No QR Code available.</p>
                    @endif
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
  @include('layouts.footers.auth.footer')
  </div>
@endsection
