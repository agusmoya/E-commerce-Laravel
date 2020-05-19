<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trademark;
use Auth;

class TrademarkController extends Controller
{

  // if (Auth::check() && Auth::user()->type==0) {
  //   return redirect('/homeHassen');
  // }
  public function showTrademarks(){

    $arrayTrademarks = Trademark::where('status', 1)
    ->orderBy('name')
    ->paginate(4);
    return view('crudTrademarks', compact('arrayTrademarks'));
  }

  public function showUpdateGetTrademark($id){
    $trademark = Trademark::find($id);
    return view('updateTrademark', compact('trademark'));
  }

  public function createTrademark(Request $form){
    $rulesWithoutUnique = [
      "name_trademark" => "required|alpha|min:3|max:30"
    ];
    $rules = [
      "name_trademark" => "required|alpha|min:3|max:30|unique:trademarks,name"
    ];

    // $messages = [
      // "alpha" => "El campo :attribute no puede ser numerico ni tener espacios",
      // "unique" => "El campo :attribute ya ha sido ingresado",
      // "min" => "El campo :attribute no puede tener menos de :min caracteres",
      // "max" => "El campo :attribute no puede tener mas de :max caracteres",
      // "required" => "El campo :attribute no puede estar vacío"
    // ];
    // $this->validate($form, $rules);

    $arrayTrademarks = Trademark::all();
    $trademarkFound = null;
    foreach ($arrayTrademarks as $trademark) {
      if($trademark['name']==$form['name_trademark'] && $trademark['status'] == 0){
        $trademarkFound = $trademark;
        break;
      }
    }

    if (isset($trademarkFound)) {
      $this->validate($form, $rulesWithoutUnique);
      $trademarkFound->status = true;
      $trademarkFound->save();
      return redirect('/productManagment/crudTrademarks');
    } else {
      $this->validate($form, $rules);
      $newTrademark = new Trademark();
      $newTrademark->name = $form["name_trademark"];
      $newTrademark->save();
      return redirect('/productManagment/crudTrademarks');
    }
  }

  public function updateTrademark(Request $form){
    $rules = [
      "name_trademark" => "required|alpha|min:3|max:50|unique:trademarks,name"
    ];

    $this->validate($form, $rules);
    $trademark = Trademark::find($form["update_trademark_id"]);
    $trademark->name = $form["name_trademark"];
    $trademark->save();
    return redirect('/productManagment/crudTrademarks');
  }

  public function deleteTrademark(Request $form){
    // if ($trademark==null) {
    //   $rules = [
    //     "id_trademark_delete" => "required"
    //   ];
    //   $messages = [
    //     "required" => "You must select a trademark to remove it!"
    //   ];
    //   $this->validate($form, $rules, $messages);
    // } else {}
    $trademark = Trademark::find($form["trademark_id"]);
    $trademark->status = 0;
    $trademark->save();
    return redirect('/productManagment/crudTrademarks');

  }


}
