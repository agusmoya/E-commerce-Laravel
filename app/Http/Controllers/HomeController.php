<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth'); //esto es para que solo podamos acceder a los metodos de abajo si estamos autenticados!
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $arrayProducts = Product::join('categories', 'category_id', '=', 'categories.id')
        ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
        ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
        ->where('products.status', 1)
        ->limit(5)
        ->inRandomOrder()
        ->get();
        $arrayCategories = Category::orderBy('name')->get();
        return view('homeHassen', compact('arrayProducts', 'arrayCategories'));
    }

    public function goInfoHelp(){
      return view('infoHelp');
    }

    public function goAccesoriesCare(){
      return view('accesoriesCare');
    }



}
