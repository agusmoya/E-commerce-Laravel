@extends('template')

@section('title') Hassen Home - Online Store @endsection

  @section('availableCategory')
    <div class="container-fluid">

  {{--
  Pantallas grandes (lo que llaman LG) a partir de 1200 pixels
  Pantlallas medias (serán las MD) a partir de 992 pixels
  Pantallas tipo tablet (las SM) a partir de 768 pixels
  Pantallas móviles (o pantallas XS), de 575 pixels para abajo.
   --}}

        <h2 class="text-center m-5">{{$arrayProductsByCategory[0]->name_category}}</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mt-2">
              @forelse ($arrayProductsByCategory as $product)

                      <div class="col mb-4">
                          <div class="card text-center">
                            <a href="/productPreview/{{$product->id}}"> <img height="100%" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
                              <div class="card-body">
                                  <h5 style="font-weight: bolder" class="card-title">{{$product->name}}</h5>
                                      <p class="card-text m-1">{{$product->name_category . " - " . $product->name_trademark}}</p>
                                      <p class="card-text m-1"><b>Description: </b><i>{{$product->description}}</i></p>
                                      @if ($product->stock >= 10)
                                        <p class="card-text m-1" style="color:#21bf73; font-weight: bold;"> Stock: Alto ({{$product->stock}})</p>
                                      @elseif($product->stock < 10 && $product->stock >= 5)
                                        <p class="card-text m-1" style="color:#ffe196; font-weight: bold;"> Stock: Medio ({{$product->stock}})</p>
                                      @else
                                        <p class="card-text m-1" style="color:#fd5e53; font-weight: bold;"> Stock: Bajo ({{$product->stock}})</p>
                                      @endif
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

  </div>

  @endSection
