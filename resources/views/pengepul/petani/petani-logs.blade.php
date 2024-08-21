@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Log Aktivitas Petani'])

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Log Aktivitas Petani</h6>
          </div>
          <div class="card-body px-0 pb-2 pt-0">
            <div class="table-responsive p-0">
              <table class="align-items-center mb-0 table">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">User
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Petani</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Aksi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-6">Perubahan
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($logs as $log)
                    <tr>
                      <td class="text-center align-middle">
                        <p class="text-secondary font-weight-bold text-sm">{{ $log->pengepul->nama }}</p>
                      </td>
                      <td class="text-center align-middle">
                        <p class="text-secondary font-weight-bold text-sm">{{ $log->petani->nama }}</p>
                      </td>
                      <td class="text-center align-middle">
                        <p class="text-secondary font-weight-bold text-sm">{{ $log->action }}</p>
                      </td>
                      <td class="align-middle">
                        @if ($log->changes)
                          @foreach ($logs as $log)
                            <div>
                              <ul>
                                @foreach (json_decode($log->changes, true) as $key => $change)
                                  <li class="text-secondary font-weight-bold text-sm">
                                    {{ $key }}: dari <strong>{{ htmlspecialchars($change['old']) }}</strong> ke
                                    <strong>{{ htmlspecialchars($change['new']) }}</strong>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          @endforeach
                        @endif
                      </td>
                      <td class="align-middle">
                        <p class="text-secondary font-weight-bold text-sm">{{ $log->created_at }}</p>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">Tidak ada log aktivitas tersedia.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
