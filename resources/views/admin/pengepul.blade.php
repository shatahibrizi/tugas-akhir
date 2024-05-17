@extends('layouts.admin-app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Pengepul Table'])

  {{-- Modal --}}

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6>Tabel Pengepul</h6>
            <div class="col-auto">
              <a href="pengepul-add" class="btn btn-dark">Tambah Pengepul</a>
            </div>
          </div>
          @if (Session::has('status'))
            <div class="alert alert-success mx-4 my-2" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
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
                      Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Username</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Alamat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      No HP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Action</th>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {{-- {{ dd($pengepul) }} --}}
                  @forelse ($pengepul as $item)
                    <tr>
                      <td>
                        <p class="font-weight-bold mb-0 ms-3 text-xs">
                          {{ $loop->iteration + $pengepul->firstItem() - 1 }}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            @if ($item->foto_profil != '')
                              <img src="{{ asset('storage/foto_profil/' . $item->foto_profil) }}"
                                class="avatar avatar-lg me-3" alt="{{ $item->nama }}">
                            @else
                              <img src="{{ asset('storage/photo/default-product.jpg') }}" class="avatar avatar-lg me-3"
                                alt="{{ $item->nama }}">
                            @endif

                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="font-weight-bold mb-0 text-sm">{{ $item->email }}</p>
                        {{-- <p class="text-secondary mb-0 text-sm">/Kg</p> --}}
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->username }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->alamat }}</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-secondary font-weight-bold text-sm">{{ $item->no_hp }}</span>
                      </td>
                      <td class="pe-4 align-middle">
                        <div class="d-flex align-items-center">
                          <!-- Tombol Edit -->
                          <a href="pengepul-edit/{{ $item->id_pengepul }}"
                            class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                            data-original-title="Edit user">
                            <i class="fa fa-pencil-square-o text-success text-sm opacity-10" aria-hidden="true"></i>
                          </a>
                          <!-- Tombol Hapus -->
                          <button type="button" class="btn btn-link deleteProductBtn pt-4"
                            value="{{ $item->id_pengepul }}">
                            <i class="fa fa-trash text-danger text-md opacity-10"></i>
                          </button>
                          <!-- Tombol Detail -->
                          <a href="pengepul-detail/{{ $item->id_pengepul }}"
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
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus pengepul</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Apakah anda yakin akan menghapus data?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-danger">Yes, delete</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @empty
                    <tr>
                      <td colspan="8" class="text-center">Tidak ada pengepul tersedia.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{ $pengepul->withQueryString()->links('pagination::bootstrap-5') }}
    @include('layouts.footers.auth.footer')
  </div>
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.deleteProductBtn').click(function(e) {
        e.preventDefault();

        var pengepul_id = $(this).val();
        var deleteUrl = "{{ route('pengepul.delete', ['id_pengepul' => ':id_pengepul']) }}";
        deleteUrl = deleteUrl.replace(':id_pengepul', pengepul_id);

        $('#deleteForm').attr('action', deleteUrl);
        $('#deleteModal').modal('show');
      });
    });
  </script>
@endsection
