@extends('layouts.admin-app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'All Orders'])

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>All Orders</h6>
          </div>

          @if (Session::has('status'))
            <div class="alert alert-success mx-4 my-2" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              @if ($orders->isEmpty())
                <p class="text-center">No orders available.</p>
              @else
                <table class="align-items-center mb-0 table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Date
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Products</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buyer Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buyer Address</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Collector Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                      <tr>
                        <td>
                          <p class="font-weight-bold mb-0 ms-3 text-xs">{{ $loop->iteration }}</p>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $order->id_pesanan }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $order->tanggal_pesanan }}</span>
                        </td>
                        <td class="text-center align-middle">
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
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">Rp.
                            {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <ul class="list-unstyled">
                            @foreach ($order->products as $product)
                              <li class="text-secondary font-weight-bold text-sm">{{ $product->nama_produk }} -
                                {{ $product->pivot->jumlah }} pcs</li>
                            @endforeach
                          </ul>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $order->pembeli->nama }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <span class="text-secondary font-weight-bold text-sm">{{ $order->pembeli->alamat }}</span>
                        </td>
                        <td class="text-center align-middle">
                          <ul class="list-unstyled">
                            @foreach ($order->products as $product)
                              @foreach ($product->pengepul as $pengepul)
                                <li class="text-secondary font-weight-bold text-sm">{{ $pengepul->nama }}</li>
                              @endforeach
                            @endforeach
                          </ul>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection
