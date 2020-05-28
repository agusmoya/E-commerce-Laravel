@extends('template')
->type
@section('title')
  Hassen Product Preview - Online Store
@endsection

@section('loadedProduct')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-0">
  <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item"><a href="/homeHassen/availableProducts">Available Products</a></li>
      <li class="breadcrumb-item active" aria-current="page">Product Preview</li>
    </ol>
  </nav>
</div>
  <div id="loaded_product_preview" class="container pt-4">

            <div class="card">
              <div class="row">
                <div class="col-12 col-lg-6 col-xl-6">
                  <img src="{{asset('/storage/imagenes/imgProductos/'.$productForShow->photo)}}" class="card-img" alt="presentacionProducto">
                </div>

                <div class="col-12 col-lg-6 col-xl-6">
                  <div class="card-body text-center text-lg-left">
                    <h4 class="card-title text-center mt-3"> <b> <i>{{$productForShow->name}}</i> </b> </h4>
                    <p class="card-text">{{$productForShow->name_category}} {{" / " . $productForShow->name_trademark}}</p>
                    <p class="card-text">{{"Descripción: " . $productForShow->description}}</p>
                    <p class="card-text">{{"Precio: $" . $productForShow->price}}</p>
                    <p class="card-text" style="font-weight:bold;"> Stock: Alto(<span id="stockProd">{{$productForShow->stock}}</span>) </p>
                    {{-- <p class="card-text">{{"Stock: " . $productId["objProduct"]["stock"] . " unidades"}}</p> --}}
                    <p class="card-text">Material: Acero Quirúrgico</p>
                    <p class="card-text">Efectivo/Mercado Pago</p>
                      @if (Auth::check() && Auth::user()->status == 1 && Auth::user()->role == 1)
                        <form action="/shoppingCart/addItem" method="get">
                          @csrf
                          <input type="hidden" name="productId" value="{{$productForShow->id}}">
                          <input id="amount" name="amount" type="number" value="1" min="1" max="{{$productForShow->stock}}">
                          <button id="addToCart" type="submit" class="btn btn-dark btn-block mt-2 mt-md-3">ADD TO CART</button>
                        </form>
                        <div class="text-center">
                          <ul class="nav mt-3">
                            <li class="nav-item mr-auto">
                              <a href="/productManagment/crudProducts" class="btn btn-link" style="color:black"><i class="fas fa-chevron-left"></i> Go to form </a>
                            </li>
                            <li class="nav-item ml-auto">
                              <a href="/myPurchase" class="btn btn-link" style="color:black"> Go to cart  <i class="fas fa-chevron-right"></i></a>
                            </li>
                          </ul>

                        </div>
                      @else
                    <form action="/shoppingCart/addItem" method="get">
                      @csrf
                      <input type="hidden" name="productId" value="{{$productForShow->id}}">
                      <input class="mt-2" name="amount" type="number" value="1" min="1" max="{{$productForShow->stock}}">
                      <button id="addToCart" type="submit" class="btn btn-dark btn-block mt-2 mt-md-3">ADD TO CART</button>
                    </form>
                    <div class="text-center">
                      <ul class="nav mt-3">
                        <li class="nav-item mr-auto">
                          <a href="/homeHassen/availableProducts" class="btn btn-link text-dark"><i class="fas fa-chevron-left"></i> Back </a>
                        </li>
                        <li class="nav-item ml-auto">
                          <a href="/myPurchase" class="btn btn-link text-dark"> Go to cart <i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </div>
                  @endif
                  </div>
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
