@extends('template')

@section('title') Hassen Edit User Profile - Online Store @endsection

  @section('userProfile')
    <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active"> <a href="/userProfile">User Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update User Profile</li>
      </ol>
    </nav>
  </div>

    <div class="container" >
      <div class="signup-form-container">
        <!-- NOTE: Inicia registracion -->
        <form class="profile_user text-light" role="form" id="formRegister" action="/userProfile/updateUserProfile" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-header">
            <div class="container mb-5">
              <div class="jumbotron p-3 m-3">
                <div class="title-info text-center">
                  <h1> {{Auth::user()->name}} </h1>
                  <p>¡Here you can edit your profile!</p>
                </div>
                @if (isset(Auth::user()->profilePhoto))
                  <div class="col-12 col-md-6 m-auto">
                    <img id="center" class="img-fluid img-thumbnail card-img border-dark" src="{{asset('/storage/imagenes/imgUsers/'. Auth::user()->profilePhoto)}}" alt="profile-photo" style="max-width:525px;">
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
            <div class="row" >
              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Name:</label>
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                  <input name="name" id="name" type="text" class="form-control" placeholder="Name" value="{{Auth::user()->name}}">
                  <input name="user_id" id="user_id" type="hidden" class="form-control" value="{{Auth::user()->id}}">
                </div>
                <span class="help-block" id="error"></span>
                @error('name')
                    <small class="" style="color:#e84a5f" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Surname:</label>
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                  <input name="surname" type="text" class="form-control" placeholder="Lastname" value="{{Auth::user()->surname}}">
                </div>
                <span class="help-block" id="error"></span>
                @error('surname')
                  <small class="" style="color:#e84a5f" role="alert">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>

            <div class="row" >
              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Email:</label>
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                  <input name="email" type="text" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
                </div>
                <span class="help-block" id="error"></span>
                @error('email')
                  @foreach ($errors->get('email') as $message)
                    <small class="" style="color: #e84a5f" role="alert">
                      {{ $message }}
                    </small>
                  @endforeach
                @enderror
              </div>

              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Email confirmation:</label>
                <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                  <input name="email_confirmation" type="text" class="form-control" placeholder="Email confirmation" value="{{old('email_confirmation')}}">
                </div>
                <span class="help-block" id="error"></span>
                @error('email_confirmation')
                  <small class="" style="color:#e84a5f" role="alert">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>

            <div class="row" >
              <div class="form-group col-lg-6">
                <label for="exampleInputEmail1">Province:</label>
                <div class="input-group">
                  <select id="provincesAPI" class="form-control" name="province" required>
                    <option value="{{Auth::user()->province}}">{{Auth::user()->province}}</option>
                  </select>
                </div>
                <span class="help-block" id="error"></span>
                @error('province')
                    <small class="" style="color:#e84a5f" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>

              <div class="form-group col-lg-6">
                <label for="inputFile">Profile photo:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" name="profilePhoto" class="custom-file-input" id="iptFileUpload">
                    <label id="lblFileUpload" class="custom-file-label" for="fileUpload">Choose file</label>
                  </div>
                </div>
                @error('profilePhoto')
                    <small class="" style="color:#e84a5f" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
            </div>

          </div>
            <div class="form-footer">
              <small id="submitEditUserProfile" class="text-center" style="color:#e84a5f" role="alert">

              </small>
              <button id="btnUpdateUser" type="submit" class="btn btn-block text-light">
                <span class="glyphicon glyphicon-log-in">Update Profile</span>
              </button>
            </div>
      </form>
      </div>
    </div>

  @endsection
