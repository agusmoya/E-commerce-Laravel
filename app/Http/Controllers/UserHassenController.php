<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserHassenController extends Controller
{
    public function showUpdateUserProfile($id){
      $user = User::find($id);
      return view('editUserProfile', compact('user'));
    }

    public function updateUserProfile(Request $form){

      $rules = [
        'name' => ['required', 'string', 'alpha','min:3', 'max:255'],
        'surname' => ['required', 'string', 'alpha','min:3', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'confirmed'],
        'province' => ['required'],
        'email_confirmation' => ['required', 'string', 'email', 'max:255'],
        'profilePhoto' => ['mimes:jpg,jpeg,png']
      ];

      $message = [
        "required" => 'The field :attribute is required.',
        "string" => 'The field :attribute must be a text.',
        "alpha" => 'The field :attribute must contain only letters.',
        "min" => 'The field :attribute must have at least :min letters.',
        "email" => 'The field :attribute must have a valid email format.',
        "max" => 'The field :attribute must have a maximum of three letters.',
        "unique" => 'The field :attribute must be unique.',
        "confirmed" => 'The field :attribute must match your email_confirmation.',
        "mimes" => 'The field :attribute must be in the format: .jpg,.jpeg o.png.'
      ];

      // $validator = Validator::make($form->all(), $rules);
      // if ($validator->fails()) {
      //   return redirect()
      //   ->back()
      //   ->withErrors($validator)
      //   ->withInput();
      // }

      $this->validate($form, $rules, $message);

      $user = User::find($form["user_id"]);
      $user->name = $form["name"];
      $user->surname = $form["surname"];
      $user->email = $form["email"];
      $user->province = $form["province"];

      if ($form["profilePhoto"] == "") {
        $form["profilePhoto"] = $user["profilePhoto"];
        $user->save();
        return redirect('/userProfile');
      }

      $ruta = $form->file('profilePhoto')->store('public/imagenes/imgUsers');
      $nombreArchivo = basename($ruta);
      $user->profilePhoto = $nombreArchivo;
      $user->save();
      return redirect('/userProfile');
    }
}
