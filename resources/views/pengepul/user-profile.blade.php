@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
  @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
  <div class="card card-profile-bottom mx-4 shadow-lg">
    <div class="card-body p-3">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}
            </h5>
            <p class="font-weight-bold mb-0 text-sm">
              Public Relations
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active d-flex align-items-center justify-content-center mb-0 px-0 py-1"
                  data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">App</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-center mb-0 px-0 py-1" data-bs-toggle="tab"
                  href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-email-83"></i>
                  <span class="ms-2">Messages</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-center mb-0 px-0 py-1" data-bs-toggle="tab"
                  href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-settings-gear-65"></i>
                  <span class="ms-2">Settings</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="alert">
    @include('components.alert')
  </div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
            @csrf
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" name="nama"
                      value="{{ old('nama', auth()->user()->nama) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" name="email"
                      value="{{ old('email', auth()->user()->email) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">First name</label>
                    <input class="form-control" type="text" name="alamat"
                      value="{{ old('alamat', auth()->user()->alamat) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Last name</label>
                    <input class="form-control" type="text" name="username"
                      value="{{ old('username', auth()->user()->username) }}">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Contact Information</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Address</label>
                    <input class="form-control" type="text" name="no_hp"
                      value="{{ old('no_hp', auth()->user()->no_hp) }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">City</label>
                    <input class="form-control" type="text" name="no_rek"
                      value="{{ old('no_rek', auth()->user()->no_rek) }}">
                  </div>
                </div>
                {{-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Country</label>
                    <input class="form-control" type="text" name="country"
                      value="{{ old('country', auth()->user()->country) }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Postal code</label>
                    <input class="form-control" type="text" name="postal"
                      value="{{ old('postal', auth()->user()->postal) }}">
                  </div>
                </div> --}}
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">About me</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">About me</label>
                    <input class="form-control" type="text" name="about"
                      value="{{ old('about', auth()->user()->about) }}">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-profile">
          <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
          <div class="row justify-content-center">
            <div class="col-4 col-lg-4 order-lg-2">
              <div class="mt-n4 mt-lg-n6 mb-lg-0 mb-4">
                <a href="javascript:;">
                  <img src="/img/team-2.jpg" class="rounded-circle img-fluid border border-2 border-white">
                </a>
              </div>
            </div>
          </div>
          <div class="card-header pt-lg-2 pb-lg-3 border-0 pb-4 pt-0 text-center">
            <div class="d-flex justify-content-between">
              <a href="javascript:;" class="btn btn-sm btn-info d-none d-lg-block mb-0">Connect</a>
              <a href="javascript:;" class="btn btn-sm btn-info d-block d-lg-none mb-0"><i
                  class="ni ni-collection"></i></a>
              <a href="javascript:;" class="btn btn-sm btn-dark d-none d-lg-block float-right mb-0">Message</a>
              <a href="javascript:;" class="btn btn-sm btn-dark d-block d-lg-none float-right mb-0"><i
                  class="ni ni-email-83"></i></a>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col">
                <div class="d-flex justify-content-center">
                  <div class="d-grid text-center">
                    <span class="font-weight-bolder text-lg">22</span>
                    <span class="opacity-8 text-sm">Friends</span>
                  </div>
                  <div class="d-grid mx-4 text-center">
                    <span class="font-weight-bolder text-lg">10</span>
                    <span class="opacity-8 text-sm">Photos</span>
                  </div>
                  <div class="d-grid text-center">
                    <span class="font-weight-bolder text-lg">89</span>
                    <span class="opacity-8 text-sm">Comments</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-4 text-center">
              <h5>
                Mark Davis<span class="font-weight-light">, 35</span>
              </h5>
              <div class="h6 font-weight-300">
                <i class="ni location_pin mr-2"></i>Bucharest, Romania
              </div>
              <div class="h6 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
              </div>
              <div>
                <i class="ni education_hat mr-2"></i>University of Computer Science
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footers.auth.footer')
  </div>
@endsection
