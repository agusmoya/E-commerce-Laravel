{{-- @extends('layouts.app') --}}
@extends('template')
@section('title') Hassen Register - Online Store @endsection

@section('registerLaravel')
<div id="containerMod" class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="formRegister" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
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
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="error_surname" class="form-text " style="color:red"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>
                          <div class="col-md-6">
                            <select id="provincesAPI" class="form-control" name="province" required>
                              <option value="empty">Seleccione un país...</option>
                            </select>
                            <small id="alert" class="form-text " style="color:red"></small>
                          </div>

                          {{-- <span id="errorProv" class="invalid-feedback" role="alert"></span> --}}
                          @error('province')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              <small id="province" class="form-text " style="color:red"></small>
                          @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="error_email" class="form-text " style="color:red"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="error_password" class="form-text " style="color:red"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <small id="error_password_confirmation" class="form-text provHelp" style="color:red"></small>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profilePhoto" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>

                            <div class="col-md-6">
                                <input id="profilePhoto" type="file" class="form-control @error('profilePhoto') is-invalid @enderror" name="profilePhoto" value="{{ old('') }}" autocomplete="profilePhoto" autofocus>

                                @error('profilePhoto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btnRegisterUser" type="submit" class="btn btn-primary">
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
