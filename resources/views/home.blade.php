@extends('template')

@section('title') Hassen Home - Online Store @endsection

@section('home')
  <!-- NOTE: div jumbo PRESENTACION para describir quienes somos!-->
  <div class="container-fluid ">
    <div class="jumbotron jumbotron-fluid mt-4 pl-5 pr-5">
      <h1 class="display-4"> Hassen </h1>
      <p class="lead">Welcome to your online accessories store. We invite you to explore our unique designs, made by and for you!</p>
    </div>

    <!-- NOTE: fin jumbo PRESENTACION -->

    <!-- NOTE: Inicia carrusel -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="..\..\imagenes\bannerHome\banner1.jpg" class="d-block w-100" alt="banner1">
        </div>
        <div class="carousel-item">
          <img src="..\..\imagenes\bannerHome\banner2.jpg" class="d-block w-100" alt="banner2">
        </div>
        <div class="carousel-item">
          <img src="..\..\imagenes\bannerHome\banner3.jpg" class="d-block w-100" alt="banner3">
        </div>
        <div class="carousel-item">
          <img src="..\..\imagenes\bannerHome\banner4.jpg" class="d-block w-100" alt="banner4">
        </div>
        <div class="carousel-item">
          <img src="..\..\imagenes\bannerHome\banner5.jpg" class="d-block w-100" alt="banner5">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- NOTE: Fin carrusel -->

    <!-- NOTE: catalogo con cards -->
    <?php // NOTE: en home la grilla funciona como: row-cols-md-3 --> 3 objetos por fila en pantallas con medida md. El numero indica literalmente cuantos productos entran por fila. Es mas mantenible que el de catalogo" ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mt-2">

      <div class="col mb-4">
        <div class="card">
          <img src="..\..\imagenes\HassenAccesorios\collar-1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card">
          <img src="..\..\imagenes\HassenAccesorios\collar-2.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card">
          <img src="..\..\imagenes\HassenAccesorios\collar-3.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
          </div>
        </div>
      </div>

      <div class="col mb-4">
        <div class="card">
          <img src="..\..\imagenes\HassenAccesorios\collar-3.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>

    </div><!-- NOTE: fin div-row -->

  </div><!-- NOTE: fin container-fluid -->
@endsection
