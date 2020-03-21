@extends('template')

{{-- @section('styleLoadedProduct')
<link rel="stylesheet" href="{{asset('css/styleLoadedProduct.css')}}">
@endsection --}}

@section('title')
  Hassen Product Preview - Online Store
@endsection

@section('loadedProduct')
  <div id="loaded_product_preview" class="container mb-5">

    @if (Auth::check() && Auth::user()->status == 1 && Auth::user()->type == 1)
      <div class="card my-5 p-3">
        <div class="row no-gutters">

          <div class="col-md-5 p-2 ml-2">
            <img src="" alt="">
            <img src="{{asset('/storage/imagenes/imgProductos/'.$productForShow->photo)}}" class="card-img mt-1" alt="presentacionProducto">
          </div>
          <div class="col-md-6 ml-3">
            <div class="card-body p-5 m-5">
              <h4 class="card-title"> <b> <i>{{"Nombre: " . $productForShow->name}}</i> </b> </h4>
              <p class="card-text">{{"Categoría: " .  $productForShow->name_category}}</p>
              <p class="card-text">{{"Marca: " . $productForShow->name_trademark}}</p>
              <p class="card-text">{{"Precio: $" . $productForShow->price}}</p>
              <p class="card-text">{{"Descripcón: " . $productForShow->description}}</p>
              @if ($productForShow->stock >= 10)
                <p class="card-text" style="color:#21bf73; font-weight: bold;"> Stock: Alto </p>
              @elseif($productForShow->stock < 10 && $productForShow->stock >= 5)
                <p class="card-text" style="color:#ffe196; font-weight: bold;"> Stock: Medio </p>
              @else
                <p class="card-text" style="color:#fd5e53; font-weight: bold;"> Stock: Bajo </p>
              @endif
              {{-- <p class="card-text">{{"Stock: " . $productId["objProduct"]["stock"] . " unidades"}}</p> --}}
              <p class="card-text">Material: Fantasía</p>
              <p class="card-text">Efectivo/Mercado Pago</p>
              <p> <a href="/productManagment/crudProducts"><strong>Volver al formulario...</strong> </a> </p>
            </div>
            <a href="/homeHassen" class="btn btn-outline-dark"><i class="fas fa-arrow-circle-left"></i> Back Home</a>

          </div>
        </div>
      </div>
    @else

      <div class="card my-5 p-3">
        <div class="row no-gutters">

          <div class="col-md-5 p-2 ml-2">
            <img src="" alt="">
            <img src="{{asset('/storage/imagenes/imgProductos/'.$productForShow->photo)}}" class="card-img mt-1" alt="presentacionProducto">
          </div>
          <div class="col-md-6 ml-3">
            <div class="card-body p-5 m-5">
              <h4 class="card-title"> <b> <i>{{"Nombre: " . $productForShow->name}}</i> </b> </h4>
              <p class="card-text">{{"Categoría: " .  $productForShow->name_category}}</p>
              <p class="card-text">{{"Marca: " . $productForShow->name_trademark}}</p>
              <p class="card-text">{{"Precio: $" . $productForShow->price}}</p>
              <p class="card-text">{{"Descripción: " . $productForShow->description}}</p>
              @if ($productForShow->stock >= 10)
                <p class="card-text" style="color:#21bf73; font-weight: bold;"> Stock: Alto </p>
              @elseif($productForShow->stock < 10 && $productForShow->stock >= 5)
                <p class="card-text" style="color:#ffe196; font-weight: bold;"> Stock: Medio </p>
              @else
                <p class="card-text" style="color:#fd5e53; font-weight: bold;"> Stock: Bajo </p>
              @endif
              {{-- <p class="card-text">{{"Stock: " . $productId["objProduct"]["stock"] . " unidades"}}</p> --}}
              <p class="card-text">Material: Fantasía</p>
              <p class="card-text">Efectivo/Mercado Pago</p>
              <a href="#" class="btn btn-danger">Add to my purchase</a>
            </div>
            <a href="/homeHassen" class="btn btn-outline-dark"><i class="fas fa-arrow-circle-left"></i> Back Home</a>
          </div>
        </div>

      </div>
    @endif
  </div>
@endsection
