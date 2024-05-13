@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Edit Petani'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Edit Petani</p>
            </div>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <form method="post" action="{{ route('petani.update', ['id_petani' => $petani->id_petani]) }}"
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
                    <x-text-input label="Nama" name="nama" id="nama" value="{{ $petani->nama }}" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <x-text-input label="Lokasi lahan" name="lokasi_lahan" id="lokasi_lahan"
                      value="{{ $petani->lokasi_lahan }}" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="No HP" name="no_hp" id="no_hp" value="{{ $petani->no_hp }}" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="Luas lahan (A)" name="luas_lahan" id="luas_lahan"
                      value="{{ $petani->luas_lahan }}" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <x-text-input label="Grup petani" name="grup_petani" id="grup_petani"
                      value="{{ $petani->grup_petani }}" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <x-large-text-input label="Alamat" name="alamat" id="alamat" value="{{ $petani->alamat }}"
                      required />
                  </div>
                </div>

                {{-- {{ dd($products->deskripsi) }} --}}
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" aria-label="Upload">
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
