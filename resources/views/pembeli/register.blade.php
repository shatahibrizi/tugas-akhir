@extends('layouts.app')

@section('content')
  @include('layouts.navbars.guest.navbar')
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 border-radius-lg m-3 pb-11 pt-5"
      style="background-image: url('{{ asset('img/regist pembeli.jpg') }}');
                background-size: cover; background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 mx-auto text-center">
            <h1 class="mb-2 mt-5 text-white">Selamat Datang!</h1>
            <p class="text-lead text-white">Gunakan formulir ini untuk login atau membuat akun baru di proyek Anda secara
              gratis.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header pt-4 text-center text-lg">
              <h5>Registrasi</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('pembeli.register.perform') }}">
                @csrf
                <div class="mb-3 flex flex-col">
                  <input type="text" name="nama" class="form-control" placeholder="Nama" aria-label="Name"
                    value="{{ old('nama') }}">
                  @error('nama')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email"
                    value="{{ old('email') }}">
                  @error('email')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <input type="password" name="password" class="form-control" placeholder="Password"
                    aria-label="Password">
                  @error('password')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Konfirmasi Password" aria-label="Confirm Password">
                  @error('password_confirmation')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <select class="form-control" name="kabupaten" id="kabupaten" placeholder="Test">
                    <option value="">Pilih Kabupaten</option>
                    <option value="Lombok Utara">Lombok Utara</option>
                    <option value="Lombok Timur">Lombok Timur</option>
                    <option value="Lombok Tengah">Lombok Tengah</option>
                    <option value="Mataram">Mataram</option>
                    <option value="Lombok Barat">Lombok Barat</option>
                  </select>
                  @error('kabupaten')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <select class="form-control" name="kecamatan" id="kecamatan">
                    <option value="">Pilih Kecamatan</option>
                  </select>
                  @error('kecamatan')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Saya menyetujui <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan Ketentuan</a>
                  </label>
                  @error('terms')
                    <p class='text-danger text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                </div>
                <p class="mb-0 mt-3 text-sm">Sudah punya akun? <a href="{{ route('pembeli.login') }}"
                    class="text-dark font-weight-bolder">Masuk</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('layouts.footers.guest.footer')
@endsection

@section('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      const kabupatenSelect = document.getElementById('kabupaten');
      const kecamatanSelect = document.getElementById('kecamatan');

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
      });
    });
  </script>
@endsection
