@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Your Orders'])

  <div class="container-fluid page-header py-5">
    <h1 class="display-6 text-center text-white">Your Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Pages</a></li>
      <li class="breadcrumb-item active text-white">Orders</li>
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
      <h1 class="mb-4">Order History</h1>
      @if ($orders->isEmpty())
        <p class="text-center">You have no orders.</p>
      @else
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th scope="col" class="text-center">Order ID</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center">Products</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach ($orders as $order)
                <tr>
                  <td>{{ $order->id_pesanan }}</td>
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
                  <td>
                    <ul class="list-unstyled">
                      @foreach ($order->products as $product)
                        <li>{{ $product->nama_produk }} - {{ $product->pivot->jumlah }} pcs</li>
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

  @include('layouts.footers.market.footer')

@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('.btn-confirm').click(function(e) {
        e.preventDefault();

        var orderId = $(this).data('order-id');
        var actionUrl =
          "{{ route('buyer.orders.update.status', ['order' => ':orderId', 'status' => 'Selesai']) }}";
        actionUrl = actionUrl.replace(':orderId', orderId);

        Swal.fire({
          title: 'Konfirmasi Pesanan Selesai',
          text: "Apakah Anda yakin pesanan ini telah selesai?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, konfirmasi!'
        }).then((result) => {
          if (result.isConfirmed) {
            $('<form>', {
              'method': 'POST',
              'action': actionUrl
            }).append($('<input>', {
              'name': '_token',
              'value': '{{ csrf_token() }}',
              'type': 'hidden'
            })).append($('<input>', {
              'name': '_method',
              'value': 'PUT',
              'type': 'hidden'
            })).appendTo('body').submit();
          }
        });
      });
    });
  </script>
@endsection
