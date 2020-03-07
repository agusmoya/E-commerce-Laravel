@extends('template')

{{-- @section('styleLoadedProduct')
  <link rel="stylesheet" href="{{asset('css/styleLoadedProduct.css')}}">
@endsection --}}

@section('title')
  Hassen Product Preview - Online Store
@endsection

@section('loadedProduct')
  <div class="container mb-5">

    <div class="card my-5 p-3">
      <div class="row no-gutters">

        <div class="col-md-5 p-2 ml-2">
          <img src="" alt="">
          <img src="{{asset('/storage/imagenes/imgProductos/'.$newProduct->photo)}}" class="card-img mt-1" alt="presentacionProducto">
        </div>
        <div class="col-md-6 ml-3">
          <div class="card-body p-5 m-5">
            <h4 class="card-title"> <b> <i>{{"Nombre: " . $newProduct->name}}</i> </b> </h4>
            <p class="card-text">{{"Categoría: " .  $newProduct->category_id}}</p>
            <p class="card-text">{{"Marca: " . $newProduct->trademark_id}}</p>
            <p class="card-text">{{"Precio: $" . $newProduct->price}}</p>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
            <a href="#" class="btn btn-dark">Add to my purchase</a>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection
