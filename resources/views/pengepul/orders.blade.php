@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Order Table'])

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>Tabel Pesanan</h6>
            <a href="{{ route('stok.export.orders', $pengepul->id_pengepul) }}" class="btn btn-success">Ekspor ke Excel</a>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Produk
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama
                        Pembeli</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Alamat
                        Pembeli</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                        Metode Pembayaran</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Bukti
                        Bayar</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi
                      </th>
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
                          <span class="text-secondary font-weight-bold text-sm">{{ $order->metode_pembayaran }}</span>
                        </td>
                        <td class="text-center align-middle">
                          @if ($order->bukti_bayar)
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                              data-bs-target="#paymentProofModal-{{ $order->id_pesanan }}">
                              Lihat Bukti
                            </a>
                          @else
                            <span class="text-secondary font-weight-bold text-sm">Tidak ada bukti</span>
                          @endif
                        </td>
                        <td class="text-center align-middle">
                          @if ($order->status != 'Selesai')
                            <a href="{{ route('orders.update.status', ['order' => $order->id_pesanan, 'status' => 'Diproses']) }}"
                              class="btn btn-success btn-xs mt-3"><i class="fas fa-check"></i></a>
                            <a href="{{ route('orders.update.status', ['order' => $order->id_pesanan, 'status' => 'Gagal']) }}"
                              class="btn btn-danger btn-xs mt-3"><i class="fas fa-times"></i></a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="paymentProofModal-{{ $order->id_pesanan }}" tabindex="-1"
                  aria-labelledby="paymentProofModalLabel-{{ $order->id_pesanan }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="paymentProofModalLabel-{{ $order->id_pesanan }}">Bukti Pembayaran
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img src="{{ asset('storage/bukti_bayar/' . $order->bukti_bayar) }}" class="img-fluid">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      @include('layouts.footers.auth.footer')
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      // Script to handle modal functionality
      $('.btn-primary').on('click', function() {
        var targetModal = $(this).data('bs-target');
        $(targetModal).modal('show');
      });
    });
  </script>
@endsection
