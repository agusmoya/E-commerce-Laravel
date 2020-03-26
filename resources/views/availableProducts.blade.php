@extends('template')

{{-- @section('styleCatalog')
<link rel="stylesheet" href="{{asset('css/styleCatalog.css')}}">
@endsection --}}

@section('title')
  Hassen Catalog - Online Store
@endsection

@section('catalog')
  <div class="d-flex flex-row pr-2 justify-content-between">
    <nav id="breadcrumb" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Available Products</li>
      </ol>
    </nav>

    <form class="form-inline my-2 my-lg-0 ml-5">
      <div class="form-group">
        <label class="mr-2" for="exampleFormControlSelect1" style="color:white;">Order by:</label>
        <select class="form-control" id="exampleFormControlSelect1">
          <option>Precio de Menor a Mayor</option>
          <option>Precio de Mayor a Menor</option>
          <option>A - Z</option>
          <option>Z - A</option>
          <option>Más nuevo al más viejo</option>
          <option>Más viejo al más nuevo</option>
        </select>
      </div>
      {{-- <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button> --}}
    </form>

  </div>

  <div class="container-fluid">

    <?php // NOTE: en home la grilla funciona como: row-cols-md-3 --> 3 objetos por fila en pantallas con medida md. El numero indica literalmente cuantos productos entran por fila. Es mas mantenible que el de catalogo" ?>
    @foreach ($arrayCategories as $category)
      <h2>{{$category->name}}</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 row-cols-xl-6 mt-2">

        @forelse ($arrayProducts as $product)
          @if ($product->name_category == $category->name)

            <div class="col mb-4">
              <div class="card text-center">
                <a href="/productPreview/{{$product->id}}"> <img height="100%" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
                <div class="card-body">
                  <h3 style="font-weight: bolder" class="card-title">{{$product->name}}</h3>
                  <p>{{$product->name_category . " - " . $product->name_trademark}}</p>
                  <p class="card-text"><i>{{$product->description}}</i></p>
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
          @endif
        @empty
          <div class="alert alert-warning mt-4"  style="margin: 0 auto;" role="alert">
            No hay productos cargados en el sistema!
          </div>
        @endforelse

      </div><!-- NOTE: fin div-row -->
    @endforeach
  </div><!-- NOTE: fin container-fluid -->
@endsection
