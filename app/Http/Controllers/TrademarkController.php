<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trademark;

class TrademarkController extends Controller
{
  public function showTrademarks(){
    $arrayTrademarks = Trademark::where('status', 1)->orderBy('name')->get();
    return view('crudTrademarks', compact('arrayTrademarks'));
  }

  public function showUpdateGetTrademark($id){
    $trademark = Trademark::find($id);
    return view('updateTrademark', compact('trademark'));
  }

  public function createTrademark(Request $form){
    $rules = [
      "name_trademark" => "required|alpha|min:3|max:30"
    ];

    $messages = [
      "alpha" => "El campo :attribute no puede ser numerico",
      "unique" => "El campo :attribute ya ha sido ingresado",
      "min" => "El campo :attribute no puede tener menos de :min caracteres",
      "max" => "El campo :attribute no puede tener mas de :max caracteres",
      "required" => "El campo :attribute no puede estar vacío"
    ];

    $arrayTrademarks = Trademark::all();
    $trademarkFound = null;
    foreach ($arrayTrademarks as $trademark) {
      if($trademark['name']==$form['name_trademark']){
        $trademarkFound = $trademark;
        break;
      }
    }

    if (isset($trademarkFound)) {
      $trademarkFound->status = true;
      $trademarkFound->save();
      return redirect('/productManagment/crudTrademarks');
    } else {
      $this->validate($form, $rules, $messages);
      $newTrademark = new Trademark();
      $newTrademark->name = $form["name_trademark"];
      $newTrademark->save();
      return redirect('/productManagment/crudTrademarks');
    }
  }

  public function updateTrademark(Request $form){
    $trademark = Trademark::find($form["update_trademark_id"]);
    $trademark->name = $form["name_trademark"];
    $trademark->save();
    return redirect('/productManagment/crudTrademarks');
  }

  public function deleteTrademark(Request $form){
    $trademark = Trademark::find($form["trademark_id"]);
    if ($trademark==null) {
      $rules = [
        "id_trademark_delete" => "required"
      ];
      $messages = [
        "required" => "Debe seleccionar una marca para eliminarla!"
      ];
      $this->validate($form, $rules, $messages);
    } else {
      $trademark->status = 0;
      $trademark->save();
      return redirect('/productManagment/crudTrademarks');
    }
  }

}
