@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Edit Profile</p>
            </div>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <form method="post" action="{{ route('product.update', ['id_produk' => $products->id_produk]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <x-text-input label="Nama" name="nama_produk" id="nama" value="{{ $products->nama_produk }}"
                      required />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <x-text-input label="Harga" name="harga" id="harga" value="{{ $products->harga }}" required />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <x-text-input label="Jumlah" name="jumlah" id="jumlah" value="{{ $products->jumlah }}" required />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="grade">Grade</label>
                    <select name="grade" class="form-select" id="grade" required>
                      <option selected value="{{ $products->grade }}">{{ $products->grade }}</option>
                      {{ $uniqueGrades = $products->pluck('grade')->unique() }}
                      @foreach ($uniqueGrades as $grade)
                        <option value="{{ $grade }}">{{ $grade }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="id_kategori" class="form-select" id="kategori" required>
                      <option selected value="{{ $products->kategori->id_kategori }}">{{ $products->kategori->nama }}
                      </option>
                      @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}">{{ $item->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="petani">Petani</label>
                    <select name="id_petani" class="form-select" id="petani" required>
                      <option selected value="{{ $products->petani->id_petani }}">{{ $products->petani->nama }}
                      </option>
                      @foreach ($petani as $item)
                        <option value="{{ $item->id_petani }}">{{ $item->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <x-text-input label="Estimasi busuk" name="estimasi_busuk" id="estimasi_busuk"
                      value="{{ $products->estimasi_busuk }}" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <x-large-text-input label="Deskripsi Produk" name="deskripsi" id="deskripsi"
                      value="{{ $products->deskripsi }}" />
                  </div>
                </div>
                {{-- {{ dd($products->deskripsi) }} --}}
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="foto_produk">Foto produk</label>
                    <input type="file" class="form-control" id="foto_produk" name="foto_produk" aria-label="Upload">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success m-auto">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  @include('layouts.footers.auth.footer')
  </div>
@endsection
