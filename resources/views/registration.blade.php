@extends('template')

@section('styleRegistration')
  <link rel="stylesheet" href="{{asset('css/styleRegistration.css')}}">
@endsection

@section('title')
  Hassen Registration - Online Store
@endsection

@section('registration')

  <div class="container">
    <div class="signup-form-container">

      <!-- NOTE: Inicia registracion -->
      <form role="form" id="register-form" autocomplete="off" action="registration.php" method="post" enctype="multipart/form-data">
        <div class="form-header">
          <h1 class="form-title mt-5 mb-4"> <i class="fa fa-user"></i> Sign Up</h1>
        </div>
        <div class="form-body">
          <div class="row">
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="name" id="name" type="text" class="form-control" placeholder="Name" required value=''>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorNameEmpty)){
                  echo $errorNameEmpty . "<br>";
                }
                if (isset($errorNameNumeric)) {
                  echo $errorNameNumeric . "<br>";
                }
                ?>
              </span>
            </div>
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="lastname" type="text" class="form-control" placeholder="Lastname" required value=''>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorLastnameEmpty)){
                  echo $errorLastnameEmpty . "<br>";
                }
                if (isset($errorLastnameText)){
                  echo $errorLastnameText . "<br>";
                }
                ?>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="dni" id="dni" type="text" class="form-control" placeholder="DNI" value=''>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorDniNumeric)){
                  echo $errorDniNumeric . "<br>";
                }
                ?>
              </span>
            </div>
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="phone" type="text" class="form-control" placeholder="Phone" value=''>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorPhoneNumeric)){
                  echo $errorPhoneNumeric . "<br>";
                }
                ?>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="city" id="city" type="text" class="form-control" placeholder="City" value=''>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorCityNumeric)){
                  echo $errorCityNumeric . "<br>";
                }
                ?>
              </span>
            </div>
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="country" type="text" class="form-control" placeholder="Country" value=''>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorCountryNumeric)){
                  echo $errorCountryNumeric . "<br>";
                }
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
              <input name="username" type="text" class="form-control" placeholder="Username" required value=''>
            </div>
            <span class="help-block" id="error">
              <?php
              if (isset($errorUsernameEmpty)){
                echo $errorUsernameEmpty . "<br>";
              }
              if (isset($errorUsernameCharacters)){
                echo $errorUsernameCharacters . "<br>";
              }
              if (isset($errorUsernameText)){
                echo $errorUsernameText . "<br>";
              }
              ?>
            </span>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
              <input name="email" type="text" class="form-control" placeholder="Email" required value=''>
            </div>
            <span class="help-block" id="error">
              <?php
              if (isset($errorEmailEmpty)){
                echo $errorEmailEmpty . "<br>";
              }
              if (isset($errorEmailFormat)){
                echo $errorEmailFormat . "<br>";
              }
              if (isset($emailExistence)){
                echo $emailExistence . "<br>";
              }
              ?>
            </span>
          </div>
          <div class="row">
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorPasswordEmpty)){
                  echo $errorPasswordEmpty . "<br>";
                }
                if (isset($errorPasswordNumber)){
                  echo $errorPasswordNumber . "<br>";
                }
                if (isset($errorPasswordCharacters)){
                  echo $errorPasswordCharacters . "<br>";
                }
                ?>
              </span>
            </div>
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="repassword" type="password" class="form-control" placeholder="Retype Password" required>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorRePasswordEmpty)){
                  echo $errorRePasswordEmpty . "<br>";
                }
                if (isset($errorRePasswordMatch)){
                  echo $errorRePasswordMatch . "<br>";
                }
                ?>
              </span>
            </div>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>

            <div class="custom-file">
              <input name="imagen" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">Choose profile picture</label>
            </div>

            <span class="help-block" id="error">
              <?php if(isset($arrayImgErrors["loadError"])){
                echo $arrayImgErrors["loadError"] . "<br>";
              }
              if(isset($arrayImgErrors["formatError"])){
                echo $arrayImgErrors["formatError"] . "<br>";
              }
              ?>
            </span>
          </div>
        </div>
        <div class="form-footer my-3">
          <button type="submit" style="font-size: 15px; font-weight: bold;" class="btn btn-lg btn-danger mb-5">
            <span class="glyphicon glyphicon-log-in">Sign Me Up !</span>
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
