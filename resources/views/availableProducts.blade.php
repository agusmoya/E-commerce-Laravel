@extends('template')

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

    <form class="form-inline my-2 my-lg-0 ml-5" action="/homeHassen/availableProducts" method="post">
      @csrf
      <div class="form-group">
        <label class="mr-2" for="exampleFormControlSelect1" style="color:white;">Order by:</label>
        <select name="order" class="form-control" id="exampleFormControlSelect1">
          <option>Select an option...</option>
          <option value="1">Precio de Menor a Mayor</option>
          <option value="2">Precio de Mayor a Menor</option>
          <option value="3">A - Z</option>
          <option value="4">Z - A</option>
          <option value="5">Más nuevo al más viejo</option>
          <option value="6">Más viejo al más nuevo</option>
        </select>
      </div>
      <button class="btn btn-outline-secondary m-2" type="submit">Search</button>
    </form>
    {{-- <form class="form-inline my-2 my-lg-0 ml-5">
      <div class="form-group">
        <label class="mr-2" for="exampleFormControlSelect1" style="color:white;">Order by:</label>
        <ul>
          <a href="/homeHassen/availableProducts/{{1}}">Precio de Menor a Mayor</a>
          <a href="/homeHassen/availableProducts/{{2}}">Precio de Mayor a Menor</a>
          <a href="/homeHassen/availableProducts/{{3}}">A - Z</a> </option>
          <a href="/homeHassen/availableProducts/{{4}}">Z - A</a> </option>
          <a href="/homeHassen/availableProducts/{{5}}">Más nuevo al más viejo</a>
          <a href="/homeHassen/availableProducts/{{6}}">Más viejo al más nuevo</a>
        </ul>
      </div>
    </form> --}}

  </div>

  <div class="container-fluid" style="width:80%">

    <?php // NOTE: la grilla funciona como: row-cols-md-3 --> 3 objetos por fila en pantallas con medida md. El numero indica literalmente cuantos productos entran por fila. Es mas mantenible que el de catalogo" ?>
    @foreach ($arrayCategories as $category)
      
      <h2 class="text-center my-5">{{$category->name}}</h2>
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
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mt-2">

        @forelse ($arrayProducts as $product)
          @if ($product->name_category == $category->name)
            <div class="col mb-4">
              <div class="card text-center">
                <a href="/productPreview/{{$product->id}}"> <img src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
                <div class="card-body" >
                  <h3 style="font-weight: bolder; color:black;" class="card-title">{{$product->name}}</h3>
                  {{-- <p>{{$product->name_category . " - " . $product->name_trademark}}</p> --}}
                  {{-- <p class="card-text"><i>{{$product->description}}</i></p> --}}
                  @if ($product->stock >= 10)
                    <p class="card-text" style="color:black; font-weight: bold;"> Stock: High({{$product->stock}})</p>

                  @elseif($product->stock >= 6)
                    <p class="card-text" style="color:black; font-weight: bold;"> Stock: Medium({{$product->stock}})</p>
                  @else
                    <p class="card-text" style="color:black; font-weight: bold;"> Stock: Low({{$product->stock}})</p>
                  @endif
                  <p class="card-text">Material: Fantasy</p>
                  <p class="card-text">Price: ${{$product->price}}</p>
                  {{-- <p class="card-text">Efectivo/Mercado Pago</p> --}}
                </div>
              </div>
            </div>
          @endif
        @empty
          <div class="alert alert-warning mt-4 d-block text-center my-5 p-4"  style="font-size: 3vw;margin: 0 auto; width: 80%;" role="alert">
            There are no products loaded in the system!
          </div>
        @endforelse

      </div><!-- NOTE: fin div-row -->
    @endforeach
  </div><!-- NOTE: fin container-fluid -->
@endsection
