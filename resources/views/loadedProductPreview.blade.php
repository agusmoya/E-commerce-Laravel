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

                {{--
                // Extra large devices (large desktops, 1200px and up)
                @media (min-width: 1200px) { ... }

                // Large devices (desktops, 992px and up)
                @media (min-width: 992px) { ... }

                // Medium devices (tablets, 768px and up)
                @media (min-width: 768px) { ... }

                // Small devices (landscape phones, 576px and up)
                @media (min-width: 576px) { ... }
                --}}

            <div class="card">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-7 col-xl-6">
                  <img src="{{asset('/storage/imagenes/imgProductos/'.$productForShow->photo)}}" class="card-img" alt="presentacionProducto">
                </div>

                <div class="col-sm-12 col-md-12 col-lg-5 col-xl-6">
                  <div class="card-body">
                    <h4 class="card-title text-center mt-3"> <b> <i>{{$productForShow->name}}</i> </b> </h4>
                    <p class="card-text">{{$productForShow->name_category}} {{"marca " . $productForShow->name_trademark}}.</p>
                    <p class="card-text">{{"Descripción: " . $productForShow->description}}</p>
                    <p class="card-text">{{"Precio: $" . $productForShow->price}}</p>
                    <p class="card-text" style="font-weight:bold;"> Stock: Alto(<span id="stockProd">{{$productForShow->stock}}</span>) </p>
                    {{-- <p class="card-text">{{"Stock: " . $productId["objProduct"]["stock"] . " unidades"}}</p> --}}
                    <p class="card-text">Material: Fantasía</p>
                    <p class="card-text">Efectivo/Mercado Pago</p>
                      @if (Auth::check() && Auth::user()->status == 1 && Auth::user()->type == 1)
                        <form class="" action="/shoppingCart/addItem" method="get">
                          @csrf
                          <input type="hidden" name="productId" value="{{$productForShow->id}}">
                          <input id="amount" name="amount" type="number" value="1" min="1" max="{{$productForShow->stock}}">
                          <button id="addToCart" type="submit" class="btn btn-danger btn-block mt-3"><b>Add to cart</b></button>
                        </form>
                        <div class="text-center">
                          <ul class="nav mt-2">
                            <li class="nav-item mr-auto">
                              <a class="nav-link active" href="/productManagment/crudProducts" class="btn btn-link" style="color:black"><i class="fas fa-chevron-left"></i><strong> Go to form</strong> </a>
                            </li>
                            <li class="nav-item ml-auto">
                              <a class="nav-link active" href="/myPurchase" class="btn btn-link" style="color:black"><strong> Go to cart </strong> <i class="fas fa-chevron-right"></i></a>
                            </li>
                          </ul>

                        </div>
                      @else
                    <form class="" action="/shoppingCart/addItem" method="get">
                      @csrf
                      <input type="hidden" name="productId" value="{{$productForShow->id}}">
                      <input class="mt-2" name="amount" type="number" value="1" min="1" max="{{$productForShow->stock}}">
                      <button id="addToCart" type="submit" class="btn btn-danger btn-block mt-4"><b>Add to cart</b></button>
                    </form>
                    <div class="text-center">
                      <ul class="nav mt-2">
                        <li class="nav-item mr-auto">
                          <a class="nav-link active" href="/homeHassen/availableProducts" class="btn btn-link" style="color:black"><i class="fas fa-chevron-left"></i><strong> See more...</strong> </a>
                        </li>
                        <li class="nav-item ml-auto">
                          <a class="nav-link active" href="/myPurchase" class="btn btn-link" style="color:black"><strong> Go to cart </strong> <i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </div>
                  @endif
                  </div>
                  {{-- <a href="/homeHassen" class="btn btn-outline-dark mt-3"><i class="fas fa-arrow-circle-left"></i> Back Home</a> --}}
                </div>
              </div>
            </div>
            @if (session()->has('maxStockAlert'))
              <div class="alert alert-warning mt-3 text-center" role="alert">
                {{session('maxStockAlert')}}
              </div>
            @endif
  </div>
@endsection
