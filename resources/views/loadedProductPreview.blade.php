@extends('template')

{{-- @section('styleLoadedProduct')
  <link rel="stylesheet" href="{{asset('css/styleLoadedProduct.css')}}">
@endsection --}}

@section('title')
  Hassen Product Preview - Online Store
@endsection

@section('loadedProduct')
  <div id="loaded_product_preview" class="container mb-5">

    <div class="card my-5 p-3">
      <div class="row no-gutters">

        <div class="col-md-5 p-2 ml-2">
          <img src="" alt="">
          <img src="{{asset('/storage/imagenes/imgProductos/'.$productDetail['objProduct']->photo)}}" class="card-img mt-1" alt="presentacionProducto">
        </div>
        <div class="col-md-6 ml-3">
          <div class="card-body p-5 m-5">
            <h4 class="card-title"> <b> <i>{{"Nombre: " . $productDetail["objProduct"]->name}}</i> </b> </h4>
            <p class="card-text">{{"Categoría: " .  $productDetail["nameTrademark"]}}</p>
            <p class="card-text">{{"Marca: " . $productDetail["nameCategory"]}}</p>
            <p class="card-text">{{"Precio: $" . $productDetail["objProduct"]->price}}</p>
            <p class="card-text">{{"Descripcón: " . $productDetail["objProduct"]->description}}</p>
            <p class="card-text">{{"Stock: " . $productDetail["objProduct"]->stock . " unidades"}}</p>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
            {{-- <a href="#" class="btn btn-dark">Add to my purchase</a> --}}
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection
