<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';  Esta opcion es la que pone laravel despues de make:auth
    protected $redirectTo = '/userProfile'; //modifico para que me redireccione a mi home


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'alpha', 'string','min:3', 'max:255'],
            'surname' => ['required', 'string','min:3', 'max:255'],
            'province' => ['required', 'string', 'alpha'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profilePhoto' => ['mimes:jpg,jpeg,png']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      // $form = app('request');
      // $ruta = $form->file('profilePhoto')->store('public/imagenes/imgUsers');
      // $nombreArchivo = basename($ruta);
      //
      //   return User::create([
      //       'name' => $data['name'],
      //       'surname' => $data['surname'],
      //       'email' => $data['email'],
      //       'province' => $data['province'],
      //       'profilePhoto' => $nombreArchivo,
      //       'password' => Hash::make($data['password']),
      //   ]);

      $form = app('request');
      if (!isset($data['profilePhoto'])) {
        $ruta = 'public/imagenes/imgUsers/userRandom.jpg';
        $nombreArchivo = basename($ruta);
      } else {
        $ruta = $form->file('profilePhoto')->store('public/imagenes/imgUsers');
        $nombreArchivo = basename($ruta);
      }

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'province' => $data['province'],
            'profilePhoto' => $nombreArchivo,
            'password' => Hash::make($data['password']),
        ]);
    }
}
