<?php
// $archivoArrayUsuarios = file_get_contents("json/usuarios.json");
// $arrayUsuarios = json_decode($archivoArrayUsuarios, true);

$usuarioEncontrado = [];
$name = $lastname = $dni = $phone = $city = $country = $username = $email = $imgProfileUser = NULL;
?>

@extends('template')

@section('styleUserProfile')
  <link rel="stylesheet" href="{{asset('css/styleUserProfile.css')}}">
@endsection
{{-- @section('styleRegistration')
  <link rel="stylesheet" href="{{asset('css/styleRegistration.css')}}">
@endsection --}}

@section('title')
  Hassen User Profile - Online Store
@endsection

@section('userProfile')

  <?php
  if($_GET){
    foreach ($arrayUsuarios as $usuario) {
      if($usuario["id"] == $_GET["id"]){
        $usuarioEncontrado = $usuario;
        $name = $usuarioEncontrado["name"];
        $lastname = $usuarioEncontrado["lastname"];
        $dni = $usuarioEncontrado["dni"];
        $phone = $usuarioEncontrado["phone"];
        $city = $usuarioEncontrado["city"];
        $country = $usuarioEncontrado["country"];
        $username = $usuarioEncontrado["username"];
        $email = $usuarioEncontrado["email"];
        $imgProfileUser = $usuarioEncontrado["imgProfileFileName"];
      }
    }
  } else {

  // if($_SESSION){
  //   foreach ($arrayUsuarios as $usuario) {
  //     if($usuario["email"] == $_SESSION["email"]){
  //       $usuarioEncontrado = $usuario;
  //       $name = $usuarioEncontrado["name"];
  //       $lastname = $usuarioEncontrado["lastname"];
  //       $dni = $usuarioEncontrado["dni"];
  //       $phone = $usuarioEncontrado["phone"];
  //       $city = $usuarioEncontrado["city"];
  //       $country = $usuarioEncontrado["country"];
  //       $username = $usuarioEncontrado["username"];
  //       $email = $usuarioEncontrado["email"];
  //       $imgProfileUser = $usuarioEncontrado["imgProfileFileName"];
  //     }
  //   }
  // }
  }
   ?>


  <div class="container" >
    <div class="signup-form-container">

      <!-- NOTE: Inicia registracion -->
      <form role="form" id="register-form" autocomplete="off" action="perfilUsuario.php" method="post" enctype="multipart/form-data">
        <div class="form-header">

          <?php
          if (isset($imgProfileUser)) :?>
          <div class="container mb-5">
            <div class="jumbotron">
              <div class="title-info">
                <h1>Welcome <?= $name . " " . $lastname . "!" ?></h1>
                <p>Has logrado registrarte exitosamente!!!</p>
              </div>
              <div class="image-Profile">
                <img class= "img-thumbnail" id="imgProfileUser" src="imgPerfiles/<?= $imgProfileUser ?>" class="rounded float-right" alt="imagen perfil">
              </div>
              <?php // NOTE: <p><a class="btn btn-secondary btn-md" href="registration.php" role="button">Edit Profile</a></p> ?>
            </div>
          </div>
        <?php else:?>
          <h2 class="form-title mt-4 mb-4"><i class="fa fa-user"> </i>  My Profile</h2>
        <?php endif;?>

      </div>
      <div class="form-body">
        <div class="row" >
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="name" id="name" type="text" class="form-control" placeholder="Name" value="<?= $name ?>" >
            </div>
            <span class="help-block" id="error"></span>
          </div>
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="lastname" type="text" class="form-control" placeholder="Lastname" value="<?= $lastname ?>">
            </div>
            <span class="help-block" id="error"></span>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="dni" id="dni" type="text" class="form-control" placeholder="DNI" value="<?= $dni ?>">
            </div>
            <span class="help-block" id="error"></span>
          </div>
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="phone" type="text" class="form-control" placeholder="Phone" value="<?= $phone ?>">
            </div>
            <span class="help-block" id="error"></span>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="city" id="city" type="text" class="form-control" placeholder="City" value="<?= $city ?>">
            </div>
            <span class="help-block" id="error"></span>
          </div>
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="country" type="text" class="form-control" placeholder="Country" value="<?= $country ?>">
            </div>
            <span class="help-block" id="error"></span>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
            <input name="username" type="text" class="form-control" placeholder="Username" value="<?= $username ?>">
          </div>
          <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
            <input name="email" type="text" class="form-control" placeholder="Email" value="<?= $email ?>">
          </div>
          <span class="help-block" id="error"></span>
        </div>
        <div class="row">
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="password" id="password" type="password" class="form-control" placeholder="Password">
            </div>
            <span class="help-block" id="error"></span>
          </div>
          <div class="form-group col-lg-6">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input name="repassword" type="password" class="form-control" placeholder="Retype Password">
            </div>
            <span class="help-block" id="error"></span>
          </div>
        </div>
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
