@extends('template')

@section('title') Hassen Home - Online Store @endsection

  @section('home')
    <div class="d-flex flex-row justify-content-center bg-light">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <b style="color:black;">Catalog</b>
            </a>
            <div class="dropdown-menu " aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/homeHassen/availableProducts"><strong>Products</strong></a>
              <div class="dropdown-divider"></div>

              @forelse ($arrayCategories as $category)
                <a class="dropdown-item" href="#">{{$category->name}}</a>
                <div class="dropdown-divider"></div>
              @empty
                {{"Sin productos disponibles!"}}
              @endforelse
            </div>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"> Accessories Care <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"> Shipments <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"> Contact <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        
      </div>
    </nav>

  </div>
  <div class="container-fluid ">
    <!-- NOTE: div jumbo PRESENTACION para describir quienes somos!-->
    <div class="jumbotron jumbotron-fluid mt-4 pl-5 pr-5">
      @if (Auth::check())
        <h1> ¡Hello {{Auth::user()->name}}!</h1>
      @else
        <h1 class="display-4"> Hello!! </h1>
      @endif
      <p class="lead">Welcome to your online accessories store. We invite you to explore our unique designs, made by and for you!</p>
    </div>

    <!-- NOTE: fin jumbo PRESENTACION -->

    <!-- NOTE: Inicia carrusel -->
    <div class="row">
      <div class="col-md-10 mx-auto">

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{asset('/storage/imagenes/imgBanner/banner1.jpg')}}" class="d-md-block w-100 mx-auto" alt="banner1">
            </div>
            <div class="carousel-item">
              <img src="{{asset('/storage/imagenes/imgBanner/banner2.jpg')}}" class="d-md-block w-100 mx-auto" alt="banner2">
            </div>
            <div class="carousel-item">
              <img src="{{asset('/storage/imagenes/imgBanner/banner3.jpg')}}" class="d-md-block w-100 mx-auto" alt="banner3">
            </div>
            <div class="carousel-item">
              <img src="{{asset('/storage/imagenes/imgBanner/banner4.jpg')}}" class="d-md-block w-100 mx-auto" alt="banner4">
            </div>
            <div class="carousel-item">
              <img src="{{asset('/storage/imagenes/imgBanner/banner5.jpg')}}" class="d-md-block w-100 mx-auto" alt="banner5">
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
      </div>
    </div>
    <!-- NOTE: Fin carrusel -->

    <!-- NOTE: catalogo con cards -->
    <?php // NOTE: en home la grilla funciona como: row-cols-md-3 --> 3 objetos por fila en pantallas con medida md. El numero indica literalmente cuantos productos entran por fila. Es mas mantenible que el de catalogo" ?>
     <h2 class="display-4 text-center my-5"><strong>¡Recomended for you!</strong></h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mt-2">
      @forelse ($arrayProducts as $product)
        <div class="col mb-4">
          <div class="card text-center">
            <a href="/productPreview/{{$product->id}}"> <img height="100%" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
            <div class="card-body">
              <h3 style="font-weight: bolder" class="card-title">{{$product->name}}</h3>
              <p>{{$product->name_category . " - " . $product->name_trademark}}</p>
              <p><i>{{$product->description}}</i></p>
              @if ($product->stock >= 10)
                <p class="card-text" style="color:#21bf73; font-weight: bold;"> Stock: Alto </p>
              @elseif($product->stock < 10 && $product->stock >= 5)
                <p class="card-text" style="color:#ffe196; font-weight: bold;"> Stock: Medio </p>
              @else
                <p class="card-text" style="color:#fd5e53; font-weight: bold;"> Stock: Bajo </p>
              @endif
              <p class="card-text">Material: Fantasía</p>
              <p class="card-text">Precio: ${{$product->price}}</p>
              <p class="card-text">Efectivo/Mercado Pago</p>
            </div>
          </div>
        </div>
      @empty
        <div class="alert alert-warning mt-4"  style="margin: 0 auto;" role="alert">
          No hay productos cargados en el sistema!
        </div>
      @endforelse

    </div><!-- NOTE: fin div-row -->

  </div><!-- NOTE: fin container-fluid -->
@endsection
