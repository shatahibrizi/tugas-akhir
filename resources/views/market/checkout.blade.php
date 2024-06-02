@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Product Table'])

  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
  </div>
  <!-- Single Page Header End -->

  <!-- Checkout Page Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <h1 class="mb-4">Billing details</h1>
      <form action="{{ route('place.order') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive mb-4">
              <table class="table">
                <thead class="text-center">
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
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
            <div class="form-group mb-4">
              <label for="paymentMethod" class="form-label">Payment Method</label>
              <select class="form-control" id="paymentMethod" name="metode_pembayaran" required>
                <option value="COD">Cash on Delivery (COD)</option>
                <option value="Transfer">Bank Transfer</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="bg-light mb-4 rounded">
              <div class="p-4">
                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="mb-0 me-4">Subtotal:</h5>
                  <p class="subtotal mb-0">Rp.{{ number_format($totalPrice, 0, ',', '.') }}</p>
                </div>
                <div class="d-flex justify-content-between mb-4">
                  <h5 class="mb-0 me-4">Shipping</h5>
                  <div class="">
                    <p class="mb-0">Rp.30,000</p>
                  </div>
                </div>
                <div class="border-top border-bottom d-flex justify-content-between mb-4 py-4">
                  <h5 class="mb-0 me-4 ps-4">Total</h5>
                  <p class="total mb-0 pe-4">Rp.{{ number_format($totalPriceWithShipping, 0, ',', '.') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-4 align-items-center justify-content-end pt-4 text-center">
          <div class="col-lg-6">
            <button type="submit" class="btn border-secondary text-uppercase w-100 text-primary px-4 py-3">
              Place Order
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Checkout Page End -->
  @include('layouts.footers.market.footer')
@endsection
