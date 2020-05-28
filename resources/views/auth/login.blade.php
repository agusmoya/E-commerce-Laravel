@extends('template')

@section('title') Hassen Login - Online Store @endsection

  @section('loginLaravel')
    <div class="d-flex justify-content-between flex-column flex-md-row align-items-center mt-5 mt-sm-3">
    <nav id="breadcrumb" class="mr-auto" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Login</li>
      </ol>
    </nav>
  </div>
    <div id="containerMod" class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header font-weight-bold">{{ __("Let's login!") }}</div>

            <div class="card-body">
              <form id="formLogin" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >
                      <small id="alertJsLogin" class="form-text" style="color:red">
                      </small>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <small id="alertJsLogin" class="form-text " style="color:red">
                        </small>
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            {{ $message }}
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                          <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                          </label>
                        </div>
                      </div>
                    </div>

                    <small id="alertSubmitLogin" class="form-text text-center mb-2" style="color:red">
                    </small>
                    <div class="form-group row">
                      <div class="col-md-8 offset-md-4">
                        <button id="btnLogin" type="submit" class="btn btn-lg btn-primary">
                          {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                          <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                          </a>
                        @endif
                      </div>
                    </div>
                  </form>
                  <div class="text-center ml-3">
                    <a class="text-dark" href="{{ route('register') }}" style="font-size: 0.9em">Don't have an account, i want to register.</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endsection
