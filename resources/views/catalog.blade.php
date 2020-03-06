@extends('template')

@section('styleCatalog')
  <link rel="stylesheet" href="{{asset('css/styleCatalog.css')}}">
@endsection

@section('title')
  Hassen Catalog - Online Store
@endsection

@section('catalog')
  <?php  /*
  <div class="container-fluid ">
  <!-- NOTE: catalogo con cards -->
  <div id="deck-contenedor" class="card-deck m-2">
  <h2>Collares</h2>
  <div id="collares" class="row"><?php // NOTE: en catalogo esta grilla funciona como: 12/el nro de "col-medida-n°. Ej.: col-md-6 --> 12/6=2 objetos por fila" ?>

  <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
  <div class="card mt-4">
  <img src="img\HassenAccesorios\collar-1.jpg" class="card-img-top" alt="Collar1">
  <div class="text-center card-body mt-1">
  <h5 class="card-title">Collar 1</h5>
  <p class="card-text">Material: Fantasía</p>
  <p class="card-text">$300</p>
  <p class="card-text">Efectivo/Mercado Pago</p>
  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  <a href="vistaProducto.php" class="btn btn-primary">Description</a>
  </div>
  </div>
  </div>
  </div><!-- NOTE: fin div row-collares -->
  </div><!-- NOTE: fin card-deck Collares -->*/
  ?>
  <div class="container-fluid">

    <h2>Collares</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 m-2">
      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\collar-1.jpg" class="card-img-top" alt="..."> </a>
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

    </div><!-- NOTE: fin div-row-collares -->

    <h2>Pulseras</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 m-2">
      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\pulsera-1.jpg" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Pulsera 1</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\pulsera-2.jpg" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Pulsera 2</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\pulsera-1.jpg" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Pulsera 3</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card text-center">
          <a href="vistaProducto.php"> <img src="..\..\imagenes\HassenAccesorios\pulsera-2.jpg" class="card-img-top" alt="..."> </a>
          <div class="card-body">
            <h5 class="card-title">Pulsera 4</h5>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">$300</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
          </div>
        </div>
      </div>

    </div><!-- NOTE: fin div-row -->

  </div><!-- NOTE: fin container-fluid -->
@endsection
