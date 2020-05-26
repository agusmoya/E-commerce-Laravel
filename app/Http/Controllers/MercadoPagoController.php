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
      $cart = session('objCart')->fresh();
      $arrayToJson = json_encode($request->all());
      $cart->update(['mp_response' => $arrayToJson]);
      return redirect(url('/homeHassen'));
    }

    public function purchaseFailure(Request $request)
    {
      $cart = session('objCart')->fresh();
      $arrayToJson = json_encode($request->all());
      $cart->update(['mp_response' => $arrayToJson]);
      return redirect(url('/myPurchase'));
    }

    public function purchasePending(Request $request)
    {
      $cart = session('objCart')->fresh();
      $arrayToJson = json_encode($request->all());
      $cart->update(['mp_response' => $arrayToJson]);
      return redirect(url('/homeHassen/availableProducts'));
    }
}
