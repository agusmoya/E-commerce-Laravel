@extends('template')

@section('title') Hassen Home - Online Store @endsection

  @section('home')

    <!-- NOTE: div jumbo PRESENTACION para describir quienes somos!-->
    <div class="jumbotron jumbotron-fluid p-5 my-5 mx-auto" style="max-width:75%;">
      @if (Auth::check())
        <h1 class="mb-3 text-center font-weight-bold" style="font-size: 5vw;"> ¡Hello {{Auth::user()->name}}!</h1>
      @else
        <h1 class="display-4 text-center" style="font-size: 5vw;"> Hello!! </h1>
      @endif
      <p class="lead text-center">Welcome to your online accessories store. <br>
        We invite you to explore our unique designs, made by and for you!</p>
    </div>
    <!-- NOTE: fin jumbo PRESENTACION -->
    <!-- NOTE: Inicia carrusel -->
    <div class="row d-none d-sm-block text-dark">
      <div class="col-md-12">
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
      <div class="container-fluid" style="width:85%;">
        <p style="font-size: 3em;" class="display-4 text-center my-5 text-light font-weight-bold"><strong>¡Recomended for you!</strong></p>
          <div class="row mt-2">
            @forelse ($arrayProducts as $product)
              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card text-center">
                  <a href="/productPreview/{{$product->id}}"> <img height="100%" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
                  <div class="card-body">
                    <h3 class="card-title font-weight-bold text-dark">{{$product->name}}</h3>
                    <p class="card-text mb-1">{{$product->name_category . " - " . $product->name_trademark}}</p>
                    {{-- <p><i>{{$product->description}}</i></p> --}}
                    {{-- <p class="card-text mb-1"> Stock: Alto </p> --}}
                    {{-- <p class="card-text mb-1"><b>Material:</b> Fantasía</p> --}}
                    <p class="card-text mb-1"><b>Precio:</b> ${{$product->price}}</p>
                    {{-- <p class="card-text mb-1"><b>Efectivo/MercadoPago</b></p> --}}
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
