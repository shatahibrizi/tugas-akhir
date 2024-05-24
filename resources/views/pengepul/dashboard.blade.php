@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-uppercase font-weight-bold mb-0 text-sm">Today's Money</p>
                  <h5 class="font-weight-bolder">
                    $53,000
                  </h5>
                  <p class="mb-0">
                    <span class="text-success font-weight-bolder text-sm">+55%</span>
                    since yesterday
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary rounded-circle text-center">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-uppercase font-weight-bold mb-0 text-sm">Today's Users</p>
                  <h5 class="font-weight-bolder">
                    2,300
                  </h5>
                  <p class="mb-0">
                    <span class="text-success font-weight-bolder text-sm">+3%</span>
                    since last week
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger rounded-circle text-center">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-uppercase font-weight-bold mb-0 text-sm">New Clients</p>
                  <h5 class="font-weight-bolder">
                    +3,462
                  </h5>
                  <p class="mb-0">
                    <span class="text-danger font-weight-bolder text-sm">-2%</span>
                    since last quarter
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success rounded-circle text-center">
                  <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-uppercase font-weight-bold mb-0 text-sm">Sales</p>
                  <h5 class="font-weight-bolder">
                    $103,430
                  </h5>
                  <p class="mb-0">
                    <span class="text-success font-weight-bolder text-sm">+5%</span> than last month
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-warning shadow-warning rounded-circle text-center">
                  <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
          <div class="card-header bg-transparent pb-0 pt-3">
            <h6 class="text-capitalize">Sales overview</h6>
            <p class="mb-0 text-sm">
              <i class="fa fa-arrow-up text-success"></i>
              <span class="font-weight-bold">4% more</span> in 2021
            </p>
          </div>
          <div class="card-body p-3">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pb-0">
            <div class="d-flex justify-content-between">
              <h6 class="mb-2">Sales by Country</h6>
            </div>
          </div>
          <div class="table-responsive">
            <table class="align-items-center table">
              <tbody>
                <tr>
                  <td class="w-30">
                    <div class="d-flex align-items-center px-2 py-1">
                      <div>
                        <img src="./img/icons/flags/US.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="font-weight-bold mb-0 text-xs">Country:</p>
                        <h6 class="mb-0 text-sm">United States</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Sales:</p>
                      <h6 class="mb-0 text-sm">2500</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Value:</p>
                      <h6 class="mb-0 text-sm">$230,900</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="font-weight-bold mb-0 text-xs">Bounce:</p>
                      <h6 class="mb-0 text-sm">29.9%</h6>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="w-30">
                    <div class="d-flex align-items-center px-2 py-1">
                      <div>
                        <img src="./img/icons/flags/DE.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="font-weight-bold mb-0 text-xs">Country:</p>
                        <h6 class="mb-0 text-sm">Germany</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Sales:</p>
                      <h6 class="mb-0 text-sm">3.900</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Value:</p>
                      <h6 class="mb-0 text-sm">$440,000</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="font-weight-bold mb-0 text-xs">Bounce:</p>
                      <h6 class="mb-0 text-sm">40.22%</h6>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="w-30">
                    <div class="d-flex align-items-center px-2 py-1">
                      <div>
                        <img src="./img/icons/flags/GB.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="font-weight-bold mb-0 text-xs">Country:</p>
                        <h6 class="mb-0 text-sm">Great Britain</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Sales:</p>
                      <h6 class="mb-0 text-sm">1.400</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Value:</p>
                      <h6 class="mb-0 text-sm">$190,700</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="font-weight-bold mb-0 text-xs">Bounce:</p>
                      <h6 class="mb-0 text-sm">23.44%</h6>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="w-30">
                    <div class="d-flex align-items-center px-2 py-1">
                      <div>
                        <img src="./img/icons/flags/BR.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="font-weight-bold mb-0 text-xs">Country:</p>
                        <h6 class="mb-0 text-sm">Brasil</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Sales:</p>
                      <h6 class="mb-0 text-sm">562</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="font-weight-bold mb-0 text-xs">Value:</p>
                      <h6 class="mb-0 text-sm">$143,960</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="font-weight-bold mb-0 text-xs">Bounce:</p>
                      <h6 class="mb-0 text-sm">32.14%</h6>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card">
          <div class="card-header p-3 pb-0">
            <h6 class="mb-0">Categories</h6>
          </div>
          <div class="card-body p-3">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between border-radius-lg mb-2 border-0 ps-0">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm bg-gradient-dark me-3 text-center shadow">
                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 text-sm">Devices</h6>
                    <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                        sold</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                      class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between border-radius-lg mb-2 border-0 ps-0">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm bg-gradient-dark me-3 text-center shadow">
                    <i class="ni ni-tag text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 text-sm">Tickets</h6>
                    <span class="text-xs">123 closed, <span class="font-weight-bold">15
                        open</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                      class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between border-radius-lg mb-2 border-0 ps-0">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm bg-gradient-dark me-3 text-center shadow">
                    <i class="ni ni-box-2 text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 text-sm">Error logs</h6>
                    <span class="text-xs">1 is active, <span class="font-weight-bold">40
                        closed</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                      class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between border-radius-lg border-0 ps-0">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm bg-gradient-dark me-3 text-center shadow">
                    <i class="ni ni-satisfied text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 text-sm">Happy users</h6>
                    <span class="font-weight-bold text-xs">+ 430</span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                      class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection

@push('js')
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#fb6340",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
@endpush
