@extends('template')

@section('styleLogin')
  <link rel="stylesheet" href="{{asset('css/styleLogin.css')}}">
@endsection

@section('title')
  Hassen Login - Online Store
@endsection

@section('login')

  <?php

  if (isset($fullNameUser)) {
    $_SESSION["email"] = $_POST["email"];
    // $_SESSION["userName"] = $fullNameUser;

    if($_POST["checkbox"]){
      setcookie("userName", $fullNameUser, time() + 60);
    }
    header("location: perfilUsuario.php?id=$idUser");
  }

  ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>

            <form class="form-signin" role="form" id="register-form" autocomplete="off" action="login.php" method="post" enctype="multipart/form-data">
              <div class="form-label-group">
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?= $email ?>">
                <label for="inputEmail">Email address</label>
              </div>
              <span class="help-block" id="error">
                <?php
                if (isset($errorEmailEmpty)){
                  echo $errorEmailEmpty . "<br>";
                }
                if (isset($errorEmailFormat)){
                  echo $errorEmailFormat . "<br>";
                }
                ?>
              </span>

              <div class="form-label-group">
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              <span style="color:red;" class="help-block" id="error" >
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
                if(isset($datosIncorrectos)):
                  echo $datosIncorrectos;?>
                  <p><a style="font-size: 20px; text-decoration: none;" href="registration.php">Sign Up!</a></p>
                <?php endif;?>
              </span>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" name="checkbox" class="custom-control-input" id="customCheck1" checked>
                <label class="custom-control-label" for="customCheck1">Remember me!</label>
              </div>

              <button id="btnSignIn" style="font-size: 15px;" class="btn btn-lg btn-info btn-block text-uppercase" type="submit">Sign in</button>

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#exampleModalCenter" style="font-size:14px;">
                  I forgot my password
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-lg btn-block" >Send me an email</button>
                    </div>
                  </div>
                </div>
              </div>


                <p id="forgotPass" class="mt-2 mb-0"><a style="font-size: 13px; text-decoration: none;" href="#">I forgot my password</a></p>

              <p id="forgotPass" class="mt-0">Do you already have a user?<a style="font-size: 15px; text-decoration: none;" href="registration.php">  Log in</a></p>

              <hr class="my-3">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
