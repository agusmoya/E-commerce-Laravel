@extends('template')

@section('title') Hassen Home - Online Store @endsection

  @section('availableCategory')
    <div class="d-flex justify-content-between flex-column flex-md-row align-items-center mt-5 mt-sm-3">
      <nav id="breadcrumb" class="mr-auto" aria-label="breadcrumb" style="font-size:1em;">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Available Products</li>
        </ol>
      </nav>
    </div>
    <div class="container-fluid mb-5 pb-5">
        @if (isset($arrayProductsByCategory[0]))
                <h1 class="text-center text-light font-weight-bold my-3" style="font-size: 45px;">{{$arrayProductsByCategory[0]->name_category}}</h1>
                <div class="row">
                      @forelse ($arrayProductsByCategory as $product)
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                  <div class="card text-center">
                                    <a href="/productPreview/{{$product->id}}"> <img height="100%" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
                                      <div class="card-body">
                                          <h5 style="font-weight: bolder" class="card-title">{{$product->name}}</h5>
                                              <p class="card-text m-1">{{$product->name_category . " - " . $product->name_trademark}}</p>
                                              {{-- <p class="card-text m-1"><b>Description: </b><i>{{$product->description}}</i></p>
                                              @if ($product->stock >= 10)
                                                <p class="card-text m-1" style="color:black; font-weight: bold;"> Stock: Alto ({{$product->stock}})</p>
                                              @elseif($product->stock < 10 && $product->stock >= 5)
                                                <p class="card-text m-1" style="color:black; font-weight: bold;"> Stock: Medio ({{$product->stock}})</p>
                                              @else
                                                <p class="card-text m-1" style="color:black; font-weight: bold;"> Stock: Bajo ({{$product->stock}})</p>
                                              @endif --}}
                                              <p class="card-text m-1"><b>Precio:</b> ${{$product->price}}</p>
                                      </div>
                                  </div>
                              </div>
                      @empty
                        <div class="alert alert-warning mt-4"  style="margin: 0 auto;" role="alert">
                          No hay productos cargados en el sistema!
                        </div>
                      @endforelse
                    </div>
        @endif
  </div>
  @endSection
