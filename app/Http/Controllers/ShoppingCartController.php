<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{

    public function addItem() {
      $itemsCart=array();
      $totalAmountCart=0;
      if(session()->has('shoppingCart')){
        $itemsCart = session('shoppingCart');
      } else {
        session()->put('shoppingCart', $itemsCart);
      }
      $infoProd = request()->all();
      $prod = Product::find($infoProd['productId']);
      $item = array();
      if ($prod->stock != 0 && $prod->stock >= $infoProd['amount']) {
        $item = array(
          'code' => $prod['id'],
          'name' => $prod['name'],
          'photo' => $prod['photo'],
          'price' => $prod['price'],
          'stock' => $prod['stock'],
          'amount' => $infoProd['amount']
        );

        if (!empty($itemsCart)) {
          foreach ($itemsCart as $it) {
            if ($item['code'] == $it['code']) {
              $item['amount'] = $item['amount'] + $it['amount'];
            }
          }

          if ($item['amount'] > $prod->stock) {
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
        return redirect('myPurchase');
      } else {
        return back()->with('maxStockAlert', "There are only $prod->stock units for this product!");
      }

    }

    public function updateTotalAmountCart(){
      session()->put('totalAmountCart', $_POST['totalAmountCart']);
      echo json_encode(session('totalAmountCart'));
    }

    /*esto es para actualizar el valor que modifique
    el usuario en el carrito para la vista previa del producto
    en caso de que vuelva a modificar la cantidad desde loadedProductPreview*/
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

    public function removeItem(Request $req){
      $itemsCart = session('shoppingCart');
      unset($itemsCart[$req['itemId']]);
      $totalAmountCart=0;
      foreach ($itemsCart as $it) {
        $totalAmountCart += $it['amount'];
        }
      session()->put('shoppingCart', $itemsCart);
      session()->put('totalAmountCart', $totalAmountCart);

      return redirect('myPurchase');
    }

}
