@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Product Table'])

  {{-- Modal --}}

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>Tabel Pesanan</h6>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success mx-4 my-2" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif

          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              @if ($orders->isEmpty())
                <p class="text-center">You have no orders.</p>
              @else
                <table class="align-items-center mb-0 table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id Pesanan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Tanggal
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                      <tr>
                        <td>
                          <p class="font-weight-bold mb-0 ms-3 text-xs">
                            {{ $loop->iteration + $orders->firstItem() - 1 }}</p>
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
                          <span
                            class="text-secondary font-weight-bold text-sm">{{ $order->products->pluck('petani.nama')->unique()->join(', ') }}</span>
                        </td>
                        <td>
                          <ul class="list-unstyled">
                            @foreach ($order->products as $product)
                              <li>{{ $product->nama_produk }} - {{ $product->pivot->jumlah }} pcs</li>
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
