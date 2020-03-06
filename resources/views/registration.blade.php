<?php
declare(strict_types=1);
// require_once("funciones.php");

$errorNameEmpty = $errorNameNumeric = $errorLastnameEmpty = $errorLastnameText = $errorLastnameText = $errorDniNumeric = $errorPhoneNumeric = $errorCityNumeric = $errorCountryNumeric = $errorUsernameEmpty = $errorUsernameCharacters = $errorUsernameText = $errorEmailEmpty = $errorEmailFormat = $errorPasswordEmpty = $errorPasswordNumber = $errorPasswordCharacters = $errorRePasswordEmpty = $errorRePasswordMatch = NULL;
$name = $lastname = $dni = $phone = $city = $country = $username = $email = NULL;

if ($_POST) {
  $flag = true;
  // VALIDAR Name required
  if(isset($_POST["name"])){
    $name = $_POST["name"];
    if (empty(trim($_POST["name"]))) {
      $flag = false;
      $errorNameEmpty = "The Name cannot be empty!";
    }

    if (is_numeric($_POST["name"])) {
      $flag = false;
      $errorNameNumeric = "The Name must be text!";
    }
  }
  // VALIDAR Lastname required
  if(isset($_POST["lastname"])){
    $lastname = $_POST["lastname"];
    if (empty(trim($_POST["lastname"]))) {
      $flag = false;
      $errorLastnameEmpty = "The Lastname cannot be empty!";
    }

    if (is_numeric($_POST["lastname"])) {
      $flag = false;
      $errorLastnameText = "The Lastname must be text!";
    }
  }

  // VALIDAR dni
  if(isset($_POST["dni"])){
    $dni = $_POST["dni"];
    if (!is_numeric($_POST["dni"])) {
      $flag = false;
      $errorDniNumeric = "The DNI must be numeric!";
    }
  }
  // VALIDAR telefono
  if(isset($_POST["phone"])){
    $phone = $_POST["phone"];
    if (!is_numeric($_POST["phone"]) && $_POST["phone"] != NULL) {
      $flag = false;
      $errorPhoneNumeric = "The Phone must be numeric!";
    }
  }
  // VALIDAR City
  if(isset($_POST["city"])){
    $city = $_POST["city"];
    if(is_numeric($_POST["city"])){
      $flag = false;
      $errorCityNumeric = "The City must be text!";
    }
  }
  // VALIDAR Country
  if(isset($_POST["country"])){
    $country = $_POST["country"];
    if(is_numeric($_POST["country"])){
      $flag = false;
      $errorCountryNumeric = "The Country must be text!";
    }
  }
  //VALIDAR username
  if(isset($_POST["username"])){
    $username = $_POST["username"];
    if (empty(trim($_POST["username"]))) {
      $flag = false;
      $errorUsernameEmpty = "The Username cannot be empty!";
    }

    if (strlen($_POST["username"]) < 10) {
      $flag = false;
      $errorUsernameCharacters = "The Username cannot have less than 10 caracters!";
    }

    if (is_numeric($_POST["username"])) {
      $flag = false;
      $errorUsernameText = "The Username must be text!";
    }
  }
  // VALIDAR email required
  if(isset($_POST["email"])){
    $email = $_POST["email"];
    if (empty(trim($_POST["email"]))) {
      $flag = false;
      $errorEmailEmpty = "The Email cannot be empty!";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $flag = false;
      $errorEmailFormat = "The Email does not have the correct format!";
    }
  }
  // VALIDAR password
  if(isset($_POST["password"])){
    $password = $_POST["password"];
    if (empty(trim($_POST["password"]))) {
      $flag = false;
      $errorPasswordEmpty = "The Password cannot be empty!";
    }

    if(!empty(trim($_POST["password"]))){
      $bandera = false;
      for ($i=0; $i < strlen($_POST["password"]); $i++) {
        if(is_numeric(substr($_POST["password"],$i,1))){
          $bandera=true;
        }
      }
      if(!$bandera){
        $flag = false;
        $errorPasswordNumber = "The Password must be at least 1 number!";
      }
    }

    if (strlen($_POST["password"]) < 10) {
      $flag = false;
      $errorPasswordCharacters = "The Password cannot have less than 10 characters!";
    }
  }
  //VALIDAR Retype Password
  if(isset($_POST["repassword"])){
    if (empty(trim($_POST["repassword"]))) {
      $flag = false;
      $errorRePasswordEmpty = "The Retype Password can not be empty!";
    }

    if($_POST["repassword"] != $_POST["password"]){
      $flag = false;
      $errorRePasswordMatch = "The Retype Password does not match with Password!";
    }
  }

  // VALIDAR que no exista el usario (vía email)
  $emailExistence = null;
  $flag = validarUsuarioExistente();
  if(!$flag){
    $emailExistence = "The email you entered already exists!";
  }

  //REGISTRAR
  if($flag){
    $idUser = registrarUsuario();
    if (is_array($idUser)) {
      $arrayImgErrors = $idUser;
    } else {
      //Crear objeto Usuario:
      $user = new UsuarioComun($name, $lastname, $username, $dni, $phone, $city, $country, $email, $password, $repassword);
      //REDIRECCIONAR
      header("location: perfilUsuario.php?id=$idUser");
    }
  }
}

?>

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
                <input name="name" id="name" type="text" class="form-control" placeholder="Name" required value='<?= $name ?>'>
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
                <input name="lastname" type="text" class="form-control" placeholder="Lastname" required value='<?= $lastname ?>'>
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
                <input name="dni" id="dni" type="text" class="form-control" placeholder="DNI" value='<?= $dni ?>'>
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
                <input name="phone" type="text" class="form-control" placeholder="Phone" value='<?= $phone ?>'>
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
                <input name="city" id="city" type="text" class="form-control" placeholder="City" value='<?= $city ?>'>
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
                <input name="country" type="text" class="form-control" placeholder="Country" value='<?= $country ?>'>
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
              <input name="username" type="text" class="form-control" placeholder="Username" required value='<?= $username ?>'>
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
              <input name="email" type="text" class="form-control" placeholder="Email" required value='<?= $email ?>'>
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
