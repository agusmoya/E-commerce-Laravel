@extends('template')

@section('styleCatalog')
  <link rel="stylesheet" href="{{asset('css/styleCatalog.css')}}">
@endsection

@section('title')
  Hassen Catalog - Online Store
@endsection

@section('catalog')
  <div class="container-fluid">

    <h2 >Collares</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 m-2">
      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="{{asset('/storage/imagenes/imgProductos/'.$newProduct->photo)}}" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Collar 1</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\collar-2.jpg" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Collar 2</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\collar-3.jpg" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Collar 3</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

    </div><!-- NOTE: fin div-row-categoría -->

  </div><!-- NOTE: fin container-fluid -->
@endsection
