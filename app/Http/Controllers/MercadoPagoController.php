<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function store(Request $request)
    {
        //aqui tomamos los datos de las notificaciones
    }

    public function purchaseSuccess(Request $request)
    {
      dd($request);
    }

    public function purchaseFailure(Request $request)
    {
      dd($request);
    }

    public function purchasePending(Request $request)
    {

      $cart = session('objCart')->fresh();
      $arrayToJson = json_encode($request->all());
      $cart->update(['mp_response' => $arrayToJson]);

      return redirect(url(''));
      dd($request);

    }
}
