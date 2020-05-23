<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    public function addItem(Request $form) {
      // $itemsCart=array();
      // $totalAmountCart=0;
      // if(session()->has('shoppingCart')){
      //   $itemsCart = session('shoppingCart');
      // } else {
      //   session()->put('shoppingCart', $itemsCart);
      // }
      // // $infoProd = request()->all(); equivale a poner Request $infoProd como parametro de la funcion
      //
      // $prod = Product::find($form['productId']);
      // $item = array();
      // if ($prod->stock != 0 && $prod->stock >= $form['amount']) {
      //   $item = array(
      //     'code' => $prod['id'],
      //     'name' => $prod['name'],
      //     'photo' => $prod['photo'],
      //     'price' => $prod['price'],
      //     'stock' => $prod['stock'],
      //     'amount' => $form['amount']
      //   );
      //
      //   if (!empty($itemsCart)) {
      //     foreach ($itemsCart as $it) {
      //       if ($item['code'] == $it['code']) {
      //         $item['amount'] = $item['amount'] + $it['amount'];
      //       }
      //     }
      //
      //     if ($item['amount'] > $prod->stock) {
      //       return back()->with('maxStockAlert', 'We do not have enough stock to add the product to the cart!');
      //     }
      //   }
      //
      //   $item['subtotal'] = $item['price'] * $item['amount'];
      //   $itemsCart[$item['code']] = $item;
      //
      //   if (!empty($itemsCart)) {
      //     $totalAmountCart=0;
      //     foreach ($itemsCart as $it) {
      //       $totalAmountCart += $it['amount'];
      //       }
      //     }
      //   session()->put('shoppingCart', $itemsCart);
      //   session()->put('totalAmountCart', $totalAmountCart);
      //   return redirect('myPurchase');
      // } else {
      //   return back()->with('maxStockAlert', "There are only $prod->stock units for this product!");
      // }
      // dd(session());
      $flag=true;//var para comprobar si el producto que ingresa, no ha sido relacionado antes en tabla pivot(prod-cart)
      $itemsCart=array();
      $totalAmountCart=0;
      $cart = session('objCart');
      if(isset($cart) && session()->has('shoppingCart')){
        $itemsCart = session('shoppingCart');
        $cart = session('objCart');
      } else {
        $cart = ShoppingCart::create();
        $cart->user_id = Auth::user()->id;
        session()->put('shoppingCart', $itemsCart);
        session()->put('objCart', $cart);
      }
      // $infoProd = request()->all(); equivale a poner Request $infoProd como parametro de la funcion
      $product = Product::find($form['productId']);
      $item = array();
      if ($product->stock != 0 && $product->stock >= $form['amount']) {
        $item = array(
          'code' => $product['id'],
          'name' => $product['name'],
          'photo' => $product['photo'],
          'price' => $product['price'],
          'stock' => $product['stock'],
          'amount' => $form['amount']
        );

        if (!empty($itemsCart)) {
          foreach ($itemsCart as $it) {
            if ($item['code'] == $it['code']) {
              $flag=false;
              $item['amount'] = $item['amount'] + $it['amount'];
            }
          }

          if ($item['amount'] > $product->stock) {
            return back()->with('maxStockAlert', 'We do not have enough stock to add the product to the cart!');
          }
        }

        $item['subtotal'] = $item['price'] * $item['amount'];
        $itemsCart[$item['code']] = $item;

        if (!empty($itemsCart)) {
          $totalAmountCart=0;
          foreach ($itemsCart as $it) {
            $totalAmountCart += $it['amount'];
            }
          }
        session()->put('shoppingCart', $itemsCart);
        session()->put('totalAmountCart', $totalAmountCart);

          // dd($cart);
          if ($flag) {
            $cart->products()->attach($product);
          }
          $cart->save();
          return redirect('myPurchase');

      } else {
        return back()->with('maxStockAlert', "There are only $product->stock units for this product!");
      }

    }

    //Actualizar cantidad de produtos del carrito en session
    public function updateTotalAmountCart(){
      session()->put('totalAmountCart', $_POST['totalAmountCart']);
      echo json_encode(session('totalAmountCart'));
    }

    /*Actualiza el valor que modifique el usuario en el carrito para la vista previa del
    producto en caso de que vuelva a modificar la cantidad desde loadedProductPreview*/
    public function updateItemAmountCart(){
      $itemsCart = session('shoppingCart');
      $itemsCart[$_POST['itemId']]['amount'] = intval($_POST['itemAmountCart']);
      session()->put('shoppingCart', $itemsCart);
      $totalAmountCart=0;
      foreach ($itemsCart as $it) {
        $totalAmountCart += $it['amount'];
        }
      session()->put('totalAmountCart', $totalAmountCart);
      echo json_encode(session('shoppingCart'));
    }

    //Elimian item del carrito, de la session y de BD
    public function removeItem(Request $req){
      $itemsCart = session('shoppingCart');
      $cart = session('objCart');
      $cart->products()->detach($req['itemId']);

      unset($itemsCart[$req['itemId']]);
      $totalAmountCart=0;
      foreach ($itemsCart as $it) {
        $totalAmountCart += $it['amount'];
        }
      session()->put('shoppingCart', $itemsCart);
      session()->put('objCart', $cart);
      session()->put('totalAmountCart', $totalAmountCart);

      return redirect('myPurchase');
    }

    public function confirm(){
      dd(session('shoppingCart'));

    }

}
