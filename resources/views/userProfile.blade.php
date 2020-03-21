@extends('template')

@section('styleUserProfile')
  {{-- <link rel="stylesheet" href="{{asset('css/styleUserProfile.css')}}"> --}}
@endsection

@section('title')
  Hassen User Profile - Online Store
@endsection

@section('userProfile')
  <div class="container" >
    <div class="signup-form-container">

      <!-- NOTE: Inicia registracion -->
      <form class="profile_user" role="form" id="register-form" autocomplete="off" action="" method="post" enctype="multipart/form-data">
        <div class="form-header">

          <div class="container mb-5">
            <div class="jumbotron p-3 m-3">
              <div class="title-info text-center">
                <h1> Welcome {{Auth::user()->name . " " . Auth::user()->surname . "!"}} </h1>
                <p>Has logrado registrarte exitosamente!!!</p>
              </div>
              @if (isset(Auth::user()->profilePhoto))
                <div class="col-6 col-md-6 m-auto">
                  <img class="img-fluid img-thumbnail" src="{{asset('/storage/imagenes/imgUsers/'.Auth::user()->profilePhoto)}}" class="card-img" alt="profile-photo">
                </div>
              @else
                <h2 class="form-title mt-4 mb-4"><i class="fa fa-user"> </i>  My Profile</h2>
                <div class="col-6 col-md-6 m-auto">
                  <span style="font-size: 48px; color: Dodgerblue;">
                    <i class="fas fa-user-alt"></i>
                  </span>
                </div>
              @endif
            </div>
          </div>

        </div>
        <div class="form-body">
          <div class="row" >
            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Name:</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="name" id="name" type="text" class="form-control" placeholder="Name" value="{{Auth::user()->name}}" readonly>
              </div>
              <span class="help-block" id="error"></span>
            </div>
            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Surname:</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="surntname" type="text" class="form-control" placeholder="Lastname" value="{{Auth::user()->surname}}" readonly>
              </div>
              <span class="help-block" id="error"></span>
            </div>
          </div>

          {{-- <div class="row">
          <div class="form-group col-lg-6">
          <div class="input-group">
          <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
          <input name="dni" id="dni" type="text" class="form-control" placeholder="DNI" value="{{Auth::user()->name}}" readonly>
        </div>
        <span class="help-block" id="error"></span>
      </div>
      <div class="form-group col-lg-6">
      <div class="input-group">
      <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
      <input name="phone" type="text" class="form-control" placeholder="Phone" value="{{Auth::user()->name}}" readonly>
    </div>
    <span class="help-block" id="error"></span>
  </div>
</div> --}}

{{-- <div class="row">
<div class="form-group col-lg-6">
<div class="input-group">
<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
<input name="city" id="city" type="text" class="form-control" placeholder="City" value="{{Auth::user()->name}}" readonly>
</div>
<span class="help-block" id="error"></span>
</div>
<div class="form-group col-lg-6">
<div class="input-group">
<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
<input name="country" type="text" class="form-control" placeholder="Country" value="{{Auth::user()->name}}" readonly>
</div>
<span class="help-block" id="error"></span>
</div>
</div> --}}

{{-- <div class="form-group">
<div class="input-group">
<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
<input name="username" type="text" class="form-control" placeholder="Username" value="{{Auth::user()->name}}" readonly>
</div>
<span class="help-block" id="error"></span>
</div> --}}
<div class="form-group ">
  <label for="exampleInputEmail1">Email:</label>
  <div class="input-group">
    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
    <input name="email" type="text" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" readonly>
  </div>
  <span class="help-block" id="error"></span>
</div>
{{-- <div class="row">
<div class="form-group col-lg-6">
<div class="input-group">
<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
<input name="password" id="password" type="password" class="form-control" placeholder="Password" readonly>
</div>
<span class="help-block" id="error"></span>
</div>
<div class="form-group col-lg-6">
<div class="input-group">
<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
<input name="repassword" type="password" class="form-control" placeholder="Retype Password" readonly>
</div>
<span class="help-block" id="error"></span>
</div>
</div> --}}
</div>
<div class="form-footer">
  <button type="submit" class="btn btn-info">
    <span class="glyphicon glyphicon-log-in">Edit Profile</span>
  </button>
</div>
</form>
</div>
</div>

@endsection
