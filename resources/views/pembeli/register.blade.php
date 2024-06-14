@extends('layouts.app')

@section('content')
  @include('layouts.navbars.guest.navbar')
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 border-radius-lg m-3 pb-11 pt-5"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 mx-auto text-center">
            <h1 class="mb-2 mt-5 text-white">Welcome!</h1>
            <p class="text-lead text-white">Use these awesome forms to login or create new account in your
              project for free.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header pt-4 text-center text-lg">
              <h5>Register</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('pembeli.register.perform') }}">
                @csrf
                <div class="mb-3 flex flex-col">
                  <input type="text" name="nama" class="form-control" placeholder="Nama" aria-label="Name"
                    value="{{ old('nama') }}">
                  @error('nama')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email"
                    value="{{ old('email') }}">
                  @error('email')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <input type="password" name="password" class="form-control" placeholder="Password"
                    aria-label="Password">
                  @error('password')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3 flex flex-col">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                    aria-label="Confirm Password">
                  @error('password_confirmation')
                    <p class='text-danger pt-1 text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                  @error('terms')
                    <p class='text-danger text-xs'>{{ $message }}</p>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="mb-0 mt-3 text-sm">Already have an account? <a href="{{ route('pembeli.login') }}"
                    class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('layouts.footers.guest.footer')
@endsection
