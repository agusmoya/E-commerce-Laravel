<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{

    public function addItem(){
      $data = request()->all();
      $cart = ShoppingCart::find(session('cartId'));
      $itemCart = Product::find($data['productId']);
      if (isset(session('cartId'))) {

      } else {
        $newCart = new ShoppingCart();
        $newCart->user_id = Auth::user()->id;
        $newCart->shipping_price = 0;
        $newCart->subtotal = 0;
        $newCart->total = 0;
        $newCart->save();
        
        session(['cartId' => $newCart->id,
        'itemsCart' => $itemsCart = $items
      ]);

      }

      return view('myPurchase', compact('itemCart'));
    }



    public function getTotalItems(){

    }

    public function getTotalPayment(){

    }
}
