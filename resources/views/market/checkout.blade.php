@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Tabel Produk'])

  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Beranda</a></li>
      <li class="breadcrumb-item"><a href="#">Halaman</a></li>
      <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
  </div>
  <!-- Single Page Header End -->

  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
    </div>
  @elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @elseif (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
    </div>
  @endif

  <!-- Checkout Page Start -->
  <div class="container-fluid py-2">
    <div class="container py-5">
      <h1 class="mb-4">Detail Pembayaran</h1>
      <form action="{{ route('place.order') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive mb-4">
              <table class="table">
                <thead class="text-center">
                  <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($cart as $id_produk => $details)
                    <tr>
                      <th scope="row">
                        <div class="d-flex align-items-center mt-2">
                          <img src="{{ asset('storage/foto_produk/' . $details['foto_produk']) }}"
                            class="img-fluid mx-auto rounded" style="width: 80px; height: 80px;" alt="">
                        </div>
                      </th>
                      <td class="py-5">{{ $details['nama_produk'] }}</td>
                      <td class="py-5">{{ $details['quantity'] }}</td>
                      <td class="py-5">Rp. {{ number_format($details['harga'], 0, ',', '.') }}</td>
                      <td class="py-5">Rp. {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group mb-4">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $alamat ?? '' }}</textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="kabupaten" class="form-label">Kabupaten</label>
                  <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                    value="{{ old('kabupaten', $kabupaten ?? '') }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="kecamatan" class="form-label">Kecamatan</label>
                  <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                    value="{{ old('kecamatan', $kecamatan ?? '') }}" readonly>
                </div>
              </div>
            </div>

            <div class="form-group mb-4">
              <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
              <select class="form-control" id="paymentMethod" name="metode_pembayaran" required>
                <option value="Transfer">Transfer Bank</option>
              </select>
            </div>
            <div class="form-group mb-4" id="bankDetails">
              <label for="no_rek" class="form-label">Nomor Rekening Admin</label>
              <input type="text" class="form-control" id="no_rek" name="no_rek" value="{{ $admin->no_rek ?? '' }}"
                readonly>
              <label for="buktiBayar" class="form-label mt-3">Unggah Bukti Bayar</label>
              <input type="file" class="form-control" id="buktiBayar" name="bukti_bayar" accept="image/*" required>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="bg-light mb-4 rounded">
              <div class="p-4">
                <h1 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h1>
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="mb-0 me-4">Subtotal:</h5>
                  <p class="subtotal mb-0">Rp.{{ number_format($totalPrice, 0, ',', '.') }}</p>
                </div>
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="mb-0 me-4">Biaya Pengiriman:</h5>
                  <p class="shipping-cost mb-0">Rp.{{ number_format($shippingCost, 0, ',', '.') }}</p>
                </div>
                @if ($totalItems > 10)
                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="mb-0 me-4">Biaya Pengiriman Tambahan:</h5>
                    <p class="additional-shipping-cost mb-0">
                      Rp.{{ number_format($additionalShippingCost, 0, ',', '.') }}</p>
                  </div>
                @endif
                <div class="border-top border-bottom d-flex justify-content-between mb-4 py-4">
                  <h5 class="mb-0 me-4">Total</h5>
                  <p class="total mb-0">Rp.{{ number_format($totalPriceWithShipping, 0, ',', '.') }}</p>
                </div>
              </div>
            </div>
            <button type="submit" class="btn border-secondary text-uppercase w-100 text-primary px-4 py-3">
              Pesan Sekarang
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>
  <!-- Checkout Page End -->
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentMethodSelect = document.getElementById('paymentMethod');
      const bankDetails = document.getElementById('bankDetails');

      paymentMethodSelect.addEventListener('change', function() {
        if (this.value === 'Transfer') {
          bankDetails.style.display = 'block';
        } else {
          bankDetails.style.display = 'none';
        }
      });
    });
  </script>
@endsection
