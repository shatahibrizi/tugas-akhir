@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Your Orders'])

  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Pesanan Anda</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Pesanan</li>
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
  @endif

  <!-- Orders Page Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <h1 class="mb-4">Histori Pesanan</h1>
      @if ($orders->isEmpty())
        <p class="text-center">Anda tidak memiliki pesanan.</p>
      @else
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Tanggal</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center">Biaya Pengiriman</th>
                <th scope="col" class="text-center">Produk</th>
                <th scope="col" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach ($orders as $order)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                  <td>
                    @php
                      $status = $order->status;
                      $badgeClass = 'bg-secondary';
                      if ($status == 'Diproses') {
                          $badgeClass = 'bg-warning';
                      } elseif ($status == 'Pending') {
                          $badgeClass = 'bg-secondary';
                      } elseif ($status == 'Selesai') {
                          $badgeClass = 'bg-success';
                      } elseif ($status == 'Gagal') {
                          $badgeClass = 'bg-danger';
                      }
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                  </td>
                  <td>Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                  <td>Rp. {{ number_format($order->biaya_pengiriman, 0, ',', '.') }}</td>
                  <td>
                    <ul class="list-unstyled">
                      @foreach ($order->products as $product)
                        <li>{{ $product->nama_produk }} - {{ $product->pivot->jumlah }} kg</li>
                      @endforeach
                    </ul>
                  </td>
                  <td>
                    @if ($order->status != 'Selesai' && $order->status != 'Gagal')
                      <button class="btn btn-success btn-sm btn-confirm" data-order-id="{{ $order->id_pesanan }}">Pesanan
                        Selesai</button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
  <!-- Orders Page End -->
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('.btn-confirm').click(function(e) {
        e.preventDefault();

        var orderId = $(this).data('order-id');
        $('#shippingCostModal-' + orderId).modal('show');
      });
    });
  </script>
@endsection
