@extends('layouts.app')

@section('content')
  <div class="position-sticky z-index-sticky container top-0">
    <div class="row">
      <div class="col-12">
        @include('layouts.navbars.guest.navbar')
      </div>
    </div>
  </div>
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Change password</h4>
                  <p class="mb-0">Set a new password for your email</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="{{ route('change.perform') }}">
                    @csrf

                    <div class="mb-3 flex flex-col">
                      <input type="email" name="email" class="form-control form-control-lg" placeholder="Email"
                        value="{{ old('email') }}" aria-label="Email">
                      @error('email')
                        <p class="text-danger pt-1 text-xs"> {{ $message }} </p>
                      @enderror
                    </div>
                    <div class="mb-3 flex flex-col">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"
                        aria-label="Password">
                      @error('password')
                        <p class="text-danger pt-1 text-xs"> {{ $message }} </p>
                      @enderror
                    </div>
                    <div class="mb-3 flex flex-col">
                      <input type="password" name="confirm-password" class="form-control form-control-lg"
                        placeholder="Password" aria-label="Password">
                      @error('confirm-password')
                        <p class="text-danger pt-1 text-xs"> {{ $message }} </p>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mb-0 mt-4">Send Reset
                        Link</button>
                    </div>
                  </form>
                </div>
                <div id="alert">
                  @include('components.alert')
                </div>
              </div>
            </div>
            <div
              class="col-6 d-lg-flex d-none h-100 position-absolute justify-content-center flex-column end-0 top-0 my-auto pe-0 text-center">
              <div
                class="position-relative bg-gradient-secondary h-100 border-radius-lg d-flex flex-column justify-content-center m-3 overflow-hidden px-7"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
              background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="font-weight-bolder position-relative mt-5 text-white">"Attention is the new
                  currency"</h4>
                <p class="position-relative text-white">The more effortless the writing looks, the more
                  effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
