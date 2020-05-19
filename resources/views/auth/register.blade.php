@extends('template')

@section('title') Hassen Register - Online Store @endsection

  @section('registerLaravel')
    <div class="d-flex justify-content-between flex-column flex-md-row align-items-center mt-5 mt-sm-3">
      <nav id="breadcrumb" class="mr-auto" aria-label="breadcrumb" style="font-size:1em;">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Registration</li>
        </ol>
      </nav>
    </div>
    <div id="containerMod" class="container mb-5 py-3">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header font-weight-bold">{{ __('Create Account') }}</div>
            <div class="card-body">
              {{-- ARRAY DE ERRORES --}}
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <p style="color:black">{{"Please correct the following errors:"}}</p>
                  <ul class="errors" style="color:red;">
                    @foreach ($errors->all() as $error)
                      <li style="color:#900c3f">{{$error}}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              {{-- ARRAY DE ERRORES --}}
              <form id="formRegister" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          {{ $message }}
                        </span>
                      @enderror
                      <small id="error_name" class="form-text " style="color:red"></small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
                    <div class="col-md-6">
                      <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                        @error('surname')
                          <span class="invalid-feedback" role="alert">
                            {{ $message }}
                          </span>
                        @enderror
                        <small id="alert" class="form-text " style="color:red"></small>
                        <small id="error_surname" class="form-text " style="color:red"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>
                      <div class="col-md-6">
                        <select id="provincesAPI" class="form-control" name="province">
                          <option value="">Select a province...</option>
                        </select>
                        <small id="alert" class="form-text " style="color:red"></small>
                        <small id="error_province" class="form-text provHelp" style="color:red" role="alert"></small>
                      </div>
                      @error('province')
                        <span class="invalid-feedback" role="alert">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                      <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                            </span>
                          @enderror
                          <small id="error_email" class="form-text" style="color:red"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                              <span class="invalid-feedback" role="alert">
                                {{ $message }}
                              </span>
                            @enderror
                            <small id="error_password" class="form-text " style="color:red"></small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                          <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <small id="error_password_confirmation" class="form-text " style="color:red"></small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="profilePhoto" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>
                          <div class="col-md-6">
                            <input id="profilePhoto" type="file" class="form-control @error('profilePhoto') is-invalid @enderror" name="profilePhoto" value="{{ old('') }}" autocomplete="profilePhoto" autofocus>
                              @error('profilePhoto')
                                <span class="invalid-feedback" role="alert">
                                  {{ $message }}
                                </span>
                              @enderror
                            </div>
                          </div>
                          <small id="alertSubmitRegister" class="form-text text-center mb-2" style="color:red">
                          </small>
                          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button id="btnRegisterUser" type="submit" class="btn btn-block btn-primary">
                                {{ __('Register') }}
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endsection
