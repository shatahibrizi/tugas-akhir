@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Product Table'])
  <div class="container-fluid py-4">
    <div class="row align-self-start">
      <div class="col-12">
        <div class="card mb-4">
          <!-- resources/views/products/create.blade.php -->
          <div class="card-header d-flex justify-content-center align-items-center pb-0">
            <h3>Tambah Produk</h3>
          </div>
          <div class="col-8 m-auto mt-3">
            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
              @csrf
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <x-text-input label="Nama" name="nama_produk" id="nama" required />

              <x-large-text-input label="Deskripsi Produk" name="deskripsi" id="deskripsi" required />

              <x-text-input label="Harga" name="harga" id="harga" required />

              <div class="mb-3">
                <label for="grade">Grade</label>
                <select name="grade" class="form-select" id="grade" required>
                  <option selected>Open this select menu</option>
                  {{ $uniqueGrades = $products->pluck('grade')->unique() }}
                  @foreach ($uniqueGrades as $grade)
                    <option value="{{ $grade }}">{{ $grade }}</option>
                  @endforeach
                </select>
              </div>


              <div class="mb-3">
                <label for="kategori">Kategori</label>
                <select name="id_kategori" class="form-select" id="kategori" required>
                  <option selected>Open this select menu</option>
                  @foreach ($kategori as $item)
                    <option value="{{ $item->id_kategori }}">{{ $item->nama }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="petani">Petani</label>
                <select name="id_petani" class="form-select" id="petani" required>
                  <option selected>Open this select menu</option>
                  @foreach ($petani as $item)
                    <option value="{{ $item->id_petani }}">{{ $item->nama }}</option>
                  @endforeach
                </select>
              </div>

              {{-- <div class="mb-3">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" aria-label="Upload">
              </div> --}}

              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          </div>

        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection
