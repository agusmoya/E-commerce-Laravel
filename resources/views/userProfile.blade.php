@extends('template')

@section('title')
  Hassen User Profile - Online Store
@endsection

@section('userProfile')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
      </ol>
    </nav>
  </div>
  <div class="container" >
    <div class="signup-form-container">
      <!-- NOTE: Inicia registracion -->
      <form class="profile_user text-light" role="form" id="register-form" action="/userProfile/updateUserProfile/{{Auth::user()->id}}" method="get">
        <div class="form-header">
          <div class="container mb-5">
            <div class="jumbotron p-3 m-3">
              <div class="title-info text-center">
                <h1> Welcome {{Auth::user()->name . " " . Auth::user()->surname}} </h1>
                <p>¡You have successfully registered!</p>
              </div>
              @if (isset(Auth::user()->profilePhoto))
                <div class="col-12 col-md-6 mx-auto">
                  <img id="center" class="img-thumbnail card-img mx-auto border-dark" src="{{asset('/storage/imagenes/imgUsers/'. Auth::user()->profilePhoto)}}" alt="profile-photo" style="max-width:525px;">
                </div>
              @else
                <h2 class="form-title mt-4 mb-4"><i class="fa fa-user"> </i>  My Profile</h2>
                <div class="col-6 m-auto">
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
                <input name="surname" type="text" class="form-control" placeholder="Lastname" value="{{Auth::user()->surname}}" readonly>
              </div>
              <span class="help-block" id="error"></span>
            </div>
          </div>

          <div class="row" >
            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Province:</label>
              <div class="input-group">
                <input name="province" type="text" class="form-control" placeholder="Province" value="{{Auth::user()->province}}" readonly>

              </div>
              <span class="help-block" id="error"></span>
            </div>

            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Email:</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input name="email" type="text" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" readonly>
              </div>
              <span class="help-block" id="error"></span>
            </div>
          </div>

        </div>
        <div class="form-footer">
          <button id="editProfile" type="submit" class="btn btn-block text-light">
            <span class="glyphicon glyphicon-log-in">Edit Profile</span>
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
