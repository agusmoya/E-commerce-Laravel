@extends('template')

{{-- @section('styleLoadedProduct')
<link rel="stylesheet" href="{{asset('css/styleLoadedProduct.css')}}">
@endsection --}}

@section('title')
  Hassen Product Preview - Online Store
@endsection

@section('loadedProduct')

  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item"><a href="/homeHassen/availableProducts">Available Products</a></li>
      <li class="breadcrumb-item active" aria-current="page">Product Preview</li>
    </ol>
  </nav>
  <div id="loaded_product_preview" class="container mb-5">


      <div class="card my-5 p-3">
        <div class="row no-gutters">

          <div class="col-md-5 p-2 ml-2">
            <img src="{{asset('/storage/imagenes/imgProductos/'.$productForShow->photo)}}" class="card-img mt-1" alt="presentacionProducto">
          </div>
          <div class="col-md-6 ml-3">
            <div class="card-body p-2 my-3">
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

                @if (Auth::check() && Auth::user()->status == 1 && Auth::user()->type == 1)
                  <p> <a href="/productManagment/crudProducts" class="btn btn-secondary"><strong>Volver al formulario</strong> </a> </p>
                @else
              <a href="#" class="btn btn-danger">Add to my purchase</a>
            @endif

            </div>
            <a href="/homeHassen" class="btn btn-outline-dark mt-5"><i class="fas fa-arrow-circle-left"></i> Back Home</a>

          </div>
        </div>
      </div>

  </div>
@endsection
