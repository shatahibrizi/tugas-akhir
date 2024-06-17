@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Admin Dashboard'])
  <div class="container-fluid py-4">
    <!-- Cards Section -->
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-equal-height">
          <div class="card-body card-body-equal-height p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-capitalize font-weight-bold mb-0 text-sm">Total Penjualan</p>
                  <h5 class="font-weight-bolder mb-0">
                    Rp.{{ number_format($totalSales, 0, ',', '.') }}
                    <span class="text-success font-weight-bolder text-sm">+{{ round($salesGrowthPercentage) }}%</span>
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-equal-height">
          <div class="card-body card-body-equal-height p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-capitalize font-weight-bold mb-0 text-sm">Total Jenis Produk</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $totalProducts }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
                  <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-equal-height">
          <div class="card-body card-body-equal-height p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-capitalize font-weight-bold mb-0 text-sm">Total Jumlah Produk</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $totalProductQuantity }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary border-radius-md text-center shadow">
                  <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Grafik Penjualan</h6>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="salesChart" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Grafik Jumlah Produk Terjual</h6>
            </div>
            <div class="card-body">
              <div class="bg-gradient-dark border-radius-lg pe-1">
                <div class="chart">
                  <canvas id="orderChart" class="chart-canvas" height="282"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Grafik Produk Masuk</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">5% more</span> in 2021
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="productEntryChart" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row my-4">
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Produk Masuk</h6>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="align-items-center mb-0 table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama
                        Produk</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jumlah
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Tanggal
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama
                        Pengepul</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($productEntries as $entry)
                      <tr>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">{{ $entry->nama_produk }}</p>
                        </td>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">{{ $entry->jumlah }}</p>
                        </td>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">
                            {{ Carbon\Carbon::parse($entry->tanggal)->format('d M Y') }}</p>
                        </td>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">{{ $entry->pengepul_nama }}</p>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Histori Pesanan</h6>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="align-items-center mb-0 table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Order
                        ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama
                        Pembeli</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total
                        Harga</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                      <tr>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">{{ $order->id_pesanan }}</p>
                        </td>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">{{ $order->pembeli->nama }}</p>
                        </td>
                        <td class="text-center">
                          <p class="font-weight-bold mb-0 text-xs">
                            Rp.{{ number_format($order->total_harga, 0, ',', '.') }}
                          </p>
                        </td>
                        <td class="text-center">
                          <span
                            class="badge badge-sm {{ $order->status == 'Selesai' ? 'bg-gradient-success' : ($order->status == 'Diproses' ? 'bg-gradient-warning' : ($order->status == 'Pending' ? 'bg-gradient-secondary' : 'bg-gradient-danger')) }}">
                            {{ $order->status }}
                          </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('layouts.footers.auth.footer')
    </div>
  @endsection

  @push('js')
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
      var ctx1 = document.getElementById("salesChart").getContext("2d");
      var salesChart = new Chart(ctx1, {
        type: "line",
        data: {
          labels: {!! json_encode($salesChartData['labels'], JSON_NUMERIC_CHECK) !!},
          datasets: [{
            label: "Penjualan",
            data: {!! json_encode($salesChartData['data'], JSON_NUMERIC_CHECK) !!},
            borderColor: "#fb6340",
            backgroundColor: 'rgba(251, 99, 64, 0.2)',
            borderWidth: 2,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  if (value % 1 === 0) {
                    return value;
                  }
                } // Display only integer values
              }
            }
          }
        }
      });

      var ctx2 = document.getElementById("productEntryChart").getContext("2d");
      var productEntryChart = new Chart(ctx2, {
        type: "line",
        data: {
          labels: {!! json_encode($productEntryChartData['labels'], JSON_NUMERIC_CHECK) !!},
          datasets: [{
            label: "Produk Masuk",
            data: {!! json_encode($productEntryChartData['data'], JSON_NUMERIC_CHECK) !!},
            borderColor: "#2dce89",
            backgroundColor: 'rgba(45, 206, 137, 0.2)',
            borderWidth: 2,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  if (value % 1 === 0) {
                    return value;
                  }
                } // Display only integer values
              }
            }
          }
        }
      });

      var ctx3 = document.getElementById("orderChart").getContext("2d");
      var orderChart = new Chart(ctx3, {
        type: "line",
        data: {
          labels: {!! json_encode($orderChartData['labels'], JSON_NUMERIC_CHECK) !!},
          datasets: [{
            label: "Jumlah Produk Terjual",
            data: {!! json_encode($orderChartData['data'], JSON_NUMERIC_CHECK) !!},
            borderColor: "#5e72e4",
            backgroundColor: 'rgba(94, 114, 228, 0.2)',
            borderWidth: 2,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              labels: {
                color: '#fff' // Set legend text color to white
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                color: '#fff',
                callback: function(value) {
                  if (value % 1 === 0) {
                    return value;
                  }
                } // Display only integer values
              }
            },
            x: {
              ticks: {
                color: '#fff',
              }
            }
          }
        }
      });

      document.addEventListener("DOMContentLoaded", function() {
        let maxHeight = 0;
        const cards = document.querySelectorAll('.card-equal-height');

        // First pass: find the max height
        cards.forEach(card => {
          maxHeight = Math.max(maxHeight, card.offsetHeight);
        });

        // Second pass: set all to max height
        cards.forEach(card => {
          card.style.height = maxHeight + 'px';
        });
      });
    </script>
  @endpush
