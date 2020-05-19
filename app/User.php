<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'province', 'email', 'role', 'password', 'profilePhoto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token) // traido desde vendor\laravel\framework\src\Illuminate\Auth\Passwords\CanResetPassword.php
    {                                                     // pero modifico el objeto new ResetPasswordNotification($token) por el siguiente:
        $this->notify(new UserResetPassword($token));
    }

    public function shoppingCart(){
      return $this->hasOne('App\ShoppingCart');
    }
}
