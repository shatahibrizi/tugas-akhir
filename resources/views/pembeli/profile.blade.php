@extends('layouts.market-app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Your Profile'])

  <div class="row">
    <div class="col-md-12">
      <div class="card" style="box-shadow: none;">
        <div style="position: relative;">
          <img src="{{ asset('markets/img/fruit-landscape.jpg') }}" class="card-img-top" alt="Gambar Buah-buahan"
            style="width: 100%; height: auto; max-width: none; max-height: 200px; object-fit: cover">
          <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3);">
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

  <div class="container-fluid p-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card" style="margin: 0 10px; height: auto;">
          <form role="form" method="POST"
            action="{{ route('pembeli.profile.update', auth()->guard('pembeli')->user()->id_pembeli) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
                <button type="submit" class="btn btn-primary btn-sm mb-2 ms-auto px-3 py-2">Save</button>
              </div>
            </div>

            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="col-auto">
                <div class="avatar avatar-xl position-relative mt-2">
                  @if (auth()->guard('pembeli')->user()->foto_profil != '')
                    <img src="{{ asset('storage/foto_profil/' . auth()->guard('pembeli')->user()->foto_profil) }}"
                      class="w-100 rounded" alt="{{ auth()->guard('pembeli')->user()->nama }}">
                  @else
                    <img src="{{ asset('storage/photo/default-product.jpg') }}" class="w-100 rounded"
                      alt="{{ auth()->guard('pembeli')->user()->nama }}">
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="nama" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" name="nama"
                      value="{{ old('nama', auth()->guard('pembeli')->user()->nama) }}">
                    @error('nama')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="email" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" name="email"
                      value="{{ old('email', auth()->guard('pembeli')->user()->email) }}">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="username" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="username"
                      value="{{ old('username', auth()->guard('pembeli')->user()->username) }}">
                    @error('username')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="no_hp" class="form-control-label">No HP</label>
                    <input class="form-control" type="text" name="no_hp"
                      value="{{ old('no_hp', auth()->guard('pembeli')->user()->no_hp) }}">
                    @error('no_hp')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="alamat" class="form-control-label">Alamat</label>
                    <input class="form-control" name="alamat"
                      value="{{ old('alamat', auth()->guard('pembeli')->user()->alamat) }}">
                    @error('alamat')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="kabupaten" class="form-control-label">Kabupaten</label>
                    <select class="form-control" name="kabupaten" id="kabupaten">
                      <option value="">Pilih Kabupaten</option>
                      <option value="Lombok Utara"
                        {{ old('kabupaten', auth()->guard('pembeli')->user()->kabupaten) == 'Lombok Utara' ? 'selected' : '' }}>
                        Lombok Utara</option>
                      <option value="Lombok Timur"
                        {{ old('kabupaten', auth()->guard('pembeli')->user()->kabupaten) == 'Lombok Timur' ? 'selected' : '' }}>
                        Lombok Timur</option>
                      <option value="Lombok Tengah"
                        {{ old('kabupaten', auth()->guard('pembeli')->user()->kabupaten) == 'Lombok Tengah' ? 'selected' : '' }}>
                        Lombok Tengah</option>
                      <option value="Mataram"
                        {{ old('kabupaten', auth()->guard('pembeli')->user()->kabupaten) == 'Mataram' ? 'selected' : '' }}>
                        Mataram</option>
                      <option value="Lombok Barat"
                        {{ old('kabupaten', auth()->guard('pembeli')->user()->kabupaten) == 'Lombok Barat' ? 'selected' : '' }}>
                        Lombok Barat</option>
                    </select>
                    @error('kabupaten')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="kecamatan" class="form-control-label">Kecamatan</label>
                    <select class="form-control" name="kecamatan" id="kecamatan">
                      <option value="">Pilih Kecamatan</option>
                      <!-- Kecamatan options will be populated based on the selected kabupaten -->
                    </select>
                    @error('kecamatan')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
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
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      const kabupatenSelect = document.getElementById('kabupaten');
      const kecamatanSelect = document.getElementById('kecamatan');
      const selectedKecamatan = "{{ old('kecamatan', auth()->guard('pembeli')->user()->kecamatan) }}";

      const kecamatanOptions = {
        'Lombok Utara': ['Bayan', 'Gangga', 'Kayangan', 'Pemenang', 'Tanjung'],
        'Lombok Timur': ['Aikmel', 'Jerowaru', 'Keruak', 'Labuan Haji', 'Lenek', 'Masbagik',
          'Montong Gading', 'Pringgabaya', 'Pringgasela', 'Sakra', 'Sakra Timur',
          'Sakra Barat', 'Sambelia', 'Selong', 'Sembalun', 'Sikur', 'Sukamulia',
          'Suralaga', 'Suela', 'Terara', 'Wanasaba'
        ],
        'Lombok Tengah': ['Batukliang', 'Batukliang Utara',
          'Janapria', 'Jonggat', 'Kopang', 'Praya', 'Praya Barat', 'Praya Barat Daya',
          'Praya Tengah', 'Praya Timur', 'Pringgarata', 'Pujut'
        ],
        'Mataram': ['Ampenan', 'Cakranegara',
          'Mataram', 'Sandubaya', 'Sekarbela', 'Selaparang'
        ],
        'Lombok Barat': ['Batu Layar',
          'Gunungsari', 'Lingsar', 'Narmada', 'Kediri', 'Labuapi', 'Kuripan',
          'Gerung', 'Lembar', 'Sekotong'
        ]
      };

      kabupatenSelect.addEventListener('change', function() {
        const selectedKabupaten = kabupatenSelect.value;

        // Clear kecamatan options
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (selectedKabupaten && kecamatanOptions[selectedKabupaten]) {
          kecamatanOptions[selectedKabupaten].forEach(function(kecamatan) {
            const option = document.createElement('option');
            option.value = kecamatan;
            option.textContent = kecamatan;
            kecamatanSelect.appendChild(option);
          });
        }

        // Select the previously selected kecamatan if it matches the current kabupaten
        if (selectedKecamatan && kecamatanOptions[selectedKabupaten].includes(selectedKecamatan)) {
          kecamatanSelect.value = selectedKecamatan;
        }
      });

      // Trigger change event on page load to populate kecamatan if kabupaten is already selected
      if (kabupatenSelect.value) {
        kabupatenSelect.dispatchEvent(new Event('change'));
      }
    });
  </script>
@endsection
