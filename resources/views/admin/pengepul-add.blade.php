@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Add Pengepul'])
  <div class="container-fluid py-4">
    <div class="row align-self-start">
      <div class="col-12">
        <div class="card mb-4">
          <!-- resources/views/products/create.blade.php -->
          <div class="card-header d-flex justify-content-center align-items-center pb-0">
            <h3>Tambah Pengepul</h3>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <div class="col-8 m-auto mt-3">
            <form method="post" action="{{ route('pengepul.store') }}" enctype="multipart/form-data">
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

              <x-text-input label="Email" name="email" id="email" required />

              <x-large-text-input label="Alamat" name="alamat" id="alamat" required />

              <x-text-input label="No HP" name="no_hp" id="no_hp" required />


              <x-text-input label="Username" name="username" id="username" required />

              <x-text-input label="No Rek" name="no_rek" id="no_rek" required />


              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                  required>
                @error('password_confirmation')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="foto_profil">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto_profil" aria-label="Upload">
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
