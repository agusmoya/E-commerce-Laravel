@extends('template')

@section('title') Hassen Home - Online Store @endsection

  @section('home')
    
    <nav class="navbar navbar-light bg-light navbar-expand-sm">
    <div class="container-fluid m-auto" style="width: 80%">
      <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#subMenuHassen" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="subMenuHassen">
        <ul class="navbar-nav m-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <b style="color:black;">Catalog</b>
            </a>
            <div class="dropdown-menu " aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/homeHassen/availableProducts"><strong>Products</strong></a>
              <div class="dropdown-divider"></div>
              @if (isset($arrayCategories))
                @forelse ($arrayCategories as $category)
                  <a class="dropdown-item" href="/homeHassen/availableCategory/{{$category->name}}">{{$category->name}}</a>
                  <div class="dropdown-divider"></div>
                @empty
                  <a class="dropdown-item">{{"Sin productos disponibles!"}} </a>
                @endforelse
              @else
                <a class="dropdown-item">{{"¡Sin productos disponibles!"}} </a>
              @endif
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <b style="color:black;">Info & Help</b>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{route('accesoriesCare')}}"> Accessories Care </a>
              {{-- <div class="dropdown-divider"></div>
              <a class="dropdown-item"> Shipments </a> --}}
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/faq"> F.A.Q. </a>
            </div>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('contactUs')}}"><b style="color:black;">Contact</b> <span class="sr-only">(current)</span></a>
          </li>


        </ul>

      </div>
    </div>
  </nav>
  <div class="container-fluid" style="width:90%">
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
                <h3 style="font-weight: bolder; color:black;" class="card-title">{{$product->name}}</h3>
                <p>{{$product->name_category . " - " . $product->name_trademark}}</p>
                <p><i>{{$product->description}}</i></p>
                <p class="card-text" style="color:black; font-weight: bold;"> Stock: Alto </p>
                <p class="card-text"><b>Material:</b> Fantasía</p>
                <p class="card-text"><b>Precio:</b> ${{$product->price}}</p>
                <p class="card-text"><b>Efectivo/MercadoPago</b></p>
              </div>
            </div>
          </div>
        @empty
          <div class="alert alert-warning mt-4" style="margin: 0 auto;" role="alert">
            ¡No hay productos cargados en el sistema!
          </div>
        @endforelse
      </div>
</div>
  @endsection
