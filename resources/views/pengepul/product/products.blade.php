@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Product Table'])

  {{-- Modal --}}

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>Tabel Produk</h6>
            <div class="col-auto">
              <a href="product-add" class="btn btn-dark">Tambah Produk</a>
            </div>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success mx-4 my-2" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <div class="card-header d-flex align-items-start py-0">
            <div class="col-10"> <!-- Menggunakan grid kolom penuh untuk memperbesar form -->
              <form action="" method="GET">
                <div class="input-group align-items-center"> <!-- Menambahkan kelas align-items-center -->
                  <input type="text" class="form-control" name="keyword" placeholder="Keyword" style="width: 40%;">
                  <!-- Menyesuaikan lebar input -->
                  <button class="input-group-text btn btn-dark mt-3">Search</button>
                  <select name="price_filter" class="form-select" id="price_filter" style="width: 10%;">
                    <!-- Menyesuaikan lebar select -->
                    <option value="" selected disabled hidden>Price</option>
                    <option value="Below 10000">Below 10000</option>
                    <option value="10000 - 50000">10000 - 50000</option>
                    <option value="Above 50000">Above 50000</option>
                  </select>
                  <select name="kategori" class="form-select" id="kategori" style="width: 10%;">
                    <!-- Menyesuaikan lebar select -->
                    <option value="" selected disabled hidden>Kategori</option>
                    @foreach ($kategori as $item)
                      <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                  </select>
                  <select name="filter" class="form-select" id="filter" style="width: 10%;">
                    <!-- Menyesuaikan lebar select -->
                    <option value="" selected disabled hidden>Grade</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                  </select>
                  <select name="petani" class="form-select" id="petani" style="width: 10%;">
                    <!-- Menyesuaikan lebar select -->
                    <option value="" selected disabled hidden>Petani</option>
                    @foreach ($allPetani as $item)
                      <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                  </select>
                </div>
              </form>
            </div>
          </div>

          {{-- {{ $productList['petani']['nama'] }} --}}
          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              <table class="align-items-center mb-0 table">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Harga(KG)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Jumlah</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Grade</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Kategori</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Petani</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $item)
                    <tr>
                      <td>
                        <p class="font-weight-bold mb-0 ms-3 text-xs">
                          {{ $loop->iteration + $products->firstItem() - 1 }}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            @if ($item->foto_produk != '')
                              <img src="{{ asset('storage/foto_produk/' . $item->foto_produk) }}"
                                class="avatar avatar-lg me-3" alt="{{ $item->nama_produk }}">
                            @else
                              <img src="{{ asset('storage/photo/default-product.jpg') }}" class="avatar avatar-lg me-3"
                                alt="{{ $item->nama_produk }}">
                            @endif

                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $item->nama_produk }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-sm">Rp. {{ $item->harga }}</p>
                        {{-- <p class="text-secondary mb-0 text-sm">/Kg</p> --}}
                      </td>
                      {{-- <td class="text-center align-middle text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td> --}}
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->jumlah }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->grade }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item['kategori']['nama'] }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item['petani']['nama'] }}</span>
                      </td>
                      <td class="pe-4 align-middle">
                        <div class="d-flex align-items-center">
                          <!-- Tombol Edit -->
                          <a href="product-edit/{{ $item->id_produk }}" class="text-secondary font-weight-bold text-md"
                            data-toggle="tooltip" data-original-title="Edit user">
                            <i class="fa fa-pencil-square-o text-success text-sm opacity-10" aria-hidden="true"></i>
                          </a>
                          <!-- Tombol Hapus -->
                          <button type="button" class="btn btn-link deleteProductBtn pt-4"
                            value="{{ $item->id_produk }}">
                            <i class="fa fa-trash text-danger text-md opacity-10"></i>
                          </button>
                          <!-- Tombol Detail -->
                          <a href="product-detail/{{ $item->id_produk }}"
                            class="text-secondary font-weight-bold text-center" data-toggle="tooltip"
                            data-original-title="Edit user">
                            <i class="fa fa-info-circle text-dark text-sm opacity-10"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus produk</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Apakah anda yakin akan menghapus data?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-danger">Yes delete</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @empty
                    <tr>
                      <td colspan="8" class="text-center">Tidak ada produk tersedia.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
    @include('layouts.footers.auth.footer')
  </div>
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.deleteProductBtn').click(function(e) {
        e.preventDefault();

        var product_id = $(this).val();
        var deleteUrl = "{{ route('product.delete', ['id_produk' => ':id_produk']) }}";
        deleteUrl = deleteUrl.replace(':id_produk', product_id);

        $('#deleteForm').attr('action', deleteUrl);
        $('#deleteModal').modal('show');
      });
    });
  </script>
@endsection
