@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Edit Pengepul'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Edit Pengepul</p>
            </div>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <form method="post" action="{{ route('pengepul.update', ['id_pengepul' => $pengepul->id_pengepul]) }}"
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
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="Nama" name="nama" id="nama" value="{{ $pengepul->nama }}" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="Email" name="email" id="email"
                      value="{{ old('email', $pengepul->email) }}" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="Username" name="username" id="username" value="{{ $pengepul->username }}"
                      required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-large-text-input label="Alamat" name="alamat" id="alamat" value="{{ $pengepul->alamat }}"
                      required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="No HP" name="no_hp" id="no_hp" value="{{ $pengepul->no_hp }}" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="No Rek" name="no_rek" id="no_rek" value="{{ $pengepul->no_rek }}" required />
                  </div>
                </div>

                {{-- {{ dd($products->deskripsi) }} --}}
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="foto_profil">Foto</label>
                    <input type="file" class="form-control" id="foto_profil" name="foto_profil" aria-label="Upload">
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
