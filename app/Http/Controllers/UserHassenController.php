<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserHassenController extends Controller
{
    public function showUpdateUserProfile($id){
      $user = User::find($id);
      return view('editUserProfile', compact('user'));
    }

    public function updateUserProfile(Request $form){
      $user = User::find($form["id"]);
      $user->name = $form["name"];
      $user->surname = $form["surname"];


      $ruta = $form->file('profilePhoto')->store('public/imagenes/imgUsers');
      $nombreArchivo = basename($ruta);
      $user->profilePhoto = $nombreArchivo;
      $user->save();
      return redirect('/userProfile');
    }
}
