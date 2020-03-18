<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;//agregado por mi segun documentacion
use Illuminate\Support\Facades\Auth; //agregado por mi segun documentacion


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home'; Esta opcion es la que pone laravel despues de make:auth
    protected $redirectTo = '/homeHassen'; //modifico para que me redireccione a mi home
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request){ //agregado por mi segun documentacion
      $credentials = $request->only('email', 'password');
    
      if(Auth::attempt($credentials)){
        //Authentication passed...
        // return redirect()->intended('dashboard');
        return redirect()->intended('homeHassen');

      }
    
    }

}
