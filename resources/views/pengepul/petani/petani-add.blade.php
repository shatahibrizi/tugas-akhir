@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Add Petani'])
  <div class="container-fluid py-4">
    <div class="row align-self-start">
      <div class="col-12">
        <div class="card mb-4">
          <!-- resources/views/products/create.blade.php -->
          <div class="card-header d-flex justify-content-center align-items-center pb-0">
            <h3>Tambah Petani</h3>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <div class="col-8 m-auto mt-3">
            <form method="post" action="{{ route('petani.store') }}" enctype="multipart/form-data">
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

              <x-text-input label="Nama" name="nama" id="nama" required />

              <x-large-text-input label="Alamat" name="alamat" id="alamat" required />

              <x-text-input label="No HP" name="no_hp" id="no_hp" required />

              <x-text-input label="Luas lahan (A)" name="luas_lahan" id="luas_lahan" required />

              <x-text-input label="Lokasi lahan" name="lokasi_lahan" id="lokasi_lahan" required />

              <x-text-input label="Grup petani" name="grup_petani" id="grup_petani" required />

              <div class="mb-3">
                <label for="foto">Foto petani</label>
                <input type="file" class="form-control" id="foto" name="foto" aria-label="Upload">
              </div>

              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          </div>

        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection
