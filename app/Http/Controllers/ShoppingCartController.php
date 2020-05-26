<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    public function addItem(Request $form) {
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
      $cart = session('objCart')->fresh();
      $cart->products()->detach($req['itemId']);

      unset($itemsCart[$req['itemId']]);
      $totalAmountCart=0;
      foreach ($itemsCart as $it) {
        $totalAmountCart += $it['amount'];
      }
      // dd($itemsCart);
      if (empty($itemsCart)) {
        session()->forget('shoppingCart');
        session('objCart')->fresh()->delete();
        session()->forget('objCart');
        session()->forget('totalAmountCart');
      } else {
        session()->put('shoppingCart', $itemsCart);
        session()->put('objCart', $cart);
        session()->put('totalAmountCart', $totalAmountCart);
      }
      return redirect('myPurchase');
    }

    public function confirm(){
      $itemsCart = session('shoppingCart');

      // Agrega credenciales
      \MercadoPago\SDK::setAccessToken(env('MP_TEST_ACCESS_TOKEN'));

      if (!empty($itemsCart)) {
        // Crea un objeto de preferencia
        $preference = new \MercadoPago\Preference();
        $products = [];
        $cart = session('objCart')->fresh();
        $cart->subtotal=0;
        $cart->total=0;
        foreach ($cart->products as $product) {
          // Crea un ítem en la preferencia
          $item = new \MercadoPago\Item();
          $item->id = $product->id;
          $item->title = $product->title;
          $item->currency_id = $product->currency_id;
          $item->picture_url = $product->photo;
          $item->description = $product->description;
          $item->category_id = $product->category_id;
          $item->quantity = $itemsCart[$product->id]['amount'];//amount está almacenado en itemsCart
          $item->unit_price = $product->price;
          $products[] = $item;

          $cart->subtotal += $itemsCart[$product->id]['amount'] * $product->price;
          $cart->total += $itemsCart[$product->id]['amount'] * $product->price + 0; //el cero es el shipping-price por ahora
          // $cart->save();
        }
        $cart->update(['subtotal' => $cart->subtotal,
                       'total' => $cart->total
                      ]);
        $preference->items = $products;
        $preference->back_urls = [
          "success" => url("/MercadoPago/purchaseSuccess"),
          "failure" => url("/MercadoPago/purchaseFailure"),
          "pending" => url("/MercadoPago/purchasePending"),
        ];

        $preference->save();
        return redirect($preference->init_point);
      } else {
        return back()->with('emptyCartAlert', "The cart is empty. Please, add at least one product for confirm the purchase.");
      }

    }

}
