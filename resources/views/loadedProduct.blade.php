<?php
declare(strict_types=1);
// require_once("../../app/Http/Controllers/logicaProvisoria/DBconnection.php");
// require_once("funciones.php");
$arrayDetalleProducto=null;
if (isset($_GET["id_producto"])) {
  $arrayDetalleProducto=traerDetalleProducto($db, $_GET["id_producto"]);
  // var_dump($arrayDetalleProducto);
}

 ?>

@extends('template')

{{-- @section('styleLoadedProduct')
  <link rel="stylesheet" href="{{asset('css/styleLoadedProduct.css')}}">
@endsection --}}

@section('title')
  Hassen Loaded Product - Online Store
@endsection

@section('loadedProduct')
  <div class="container mb-5">

    <div class="card my-5 p-3">
      <div class="row no-gutters">

        <div class="col-md-5 p-2 ml-2">
          <img src="img\imgProductos\<?= $arrayDetalleProducto['foto'] ?>" class="card-img mt-2" alt="presentacionProducto">
        </div>
        <div class="col-md-6 ml-3">
          <div class="card-body p-5 m-5">
            <h4 class="card-title"> <b> <i><?= "Nombre: " . $arrayDetalleProducto["nombre"] ?></i> </b> </h4>
            <p class="card-text"><?= "Categoría: " .  $arrayDetalleProducto["categoria"] ?></p>
            <p class="card-text"><?= "Marca: " . $arrayDetalleProducto["marca"] ?></p>
            <p class="card-text"><?= "Precio: $" . $arrayDetalleProducto["precio"] ?></p>
            <p class="card-text">Material: Fantasía</p>
            <p class="card-text">Efectivo/Mercado Pago</p>
            <a href="#" class="btn btn-dark">Add to my purchase</a>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection
