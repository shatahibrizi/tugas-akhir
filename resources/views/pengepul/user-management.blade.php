@extends('layouts.app')

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
  <div class="row mx-4 mt-4">
    <div class="col-12">
      <div class="alert alert-light" role="alert">
        This feature is available in <strong>Argon Dashboard 2 Pro Laravel</strong>. Check it
        <strong>
          <a href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank">
            here
          </a>
        </strong>
      </div>
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Users</h6>
        </div>
        <div class="card-body px-0 pb-2 pt-0">
          <div class="table-responsive p-0">
            <table class="align-items-center mb-0 table">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                    Create Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                    Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex px-3 py-1">
                      <div>
                        <img src="./img/team-1.jpg" class="avatar me-3" alt="image">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Admin</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="font-weight-bold mb-0 text-sm">Admin</p>
                  </td>
                  <td class="text-center align-middle text-sm">
                    <p class="font-weight-bold mb-0 text-sm">22/03/2022</p>
                  </td>
                  <td class="text-end align-middle">
                    <div class="d-flex justify-content-center align-items-center px-3 py-1">
                      <p class="font-weight-bold mb-0 text-sm">Edit</p>
                      <p class="font-weight-bold mb-0 ps-2 text-sm">Delete</p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-3 py-1">
                      <div>
                        <img src="./img/team-2.jpg" class="avatar me-3" alt="image">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Creator</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="font-weight-bold mb-0 text-sm">Creator</p>
                  </td>
                  <td class="text-center align-middle text-sm">
                    <p class="font-weight-bold mb-0 text-sm">22/03/2022</p>
                  </td>
                  <td class="text-end align-middle">
                    <div class="d-flex justify-content-center align-items-center px-3 py-1">
                      <p class="font-weight-bold mb-0 text-sm">Edit</p>
                      <p class="font-weight-bold mb-0 ps-2 text-sm">Delete</p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-3 py-1">
                      <div>
                        <img src="./img/team-3.jpg" class="avatar me-3" alt="image">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Member</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="font-weight-bold mb-0 text-sm">Member</p>
                  </td>
                  <td class="text-center align-middle text-sm">
                    <p class="font-weight-bold mb-0 text-sm">22/03/2022</p>
                  </td>
                  <td class="text-end align-middle">
                    <div class="d-flex justify-content-center align-items-center px-3 py-1">
                      <p class="font-weight-bold mb-0 cursor-pointer text-sm">Edit</p>
                      <p class="font-weight-bold mb-0 cursor-pointer ps-2 text-sm">Delete</p>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
