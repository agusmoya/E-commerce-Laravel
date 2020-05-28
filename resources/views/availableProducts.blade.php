@extends('template')

@section('title')
  Hassen Catalog - Online Store
@endsection

@section('catalog')
  <div class="d-flex justify-content-between flex-column flex-md-row align-items-center mt-5 mt-sm-3">
    <nav id="breadcrumb" class="mr-auto" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Available Products</li>
      </ol>
    </nav>

    <form class="form-inline ml-auto align-item-center m-1" action="/homeHassen/availableProducts" method="post">
      @csrf
      <div class="form-group m-1">
        <select name="order" class="form-control" id="exampleFormControlSelect1">
          <option>Oreder by...</option>
          <option value="1">Price from lowest to highest</option>
          <option value="2">Price from highest to lowest</option>
          <option value="3">A - Z</option>
          <option value="4">Z - A</option>
          <option value="5">Newest to oldest</option>
          <option value="6">Oldest to newest</option>
        </select>
      </div>
      <button class="btn btn-outline-light m-1 font-weight-bold" type="submit">Search</button>
    </form>

  </div>

  <div class="container-fluid">
    @if (session()->has('alertUnavailableCategory'))
      <div class="alert alert-warning p-4 text-center mx-auto mt-5" style="font-size: 1.1em; width: 75%;">
        <strong>{{session('alertUnavailableCategory')}}</strong>
        </div>
    @endif
    @forelse ($arrayCategories as $category)
      {{$flag=true}}
      <h2 class="text-center text-light font-weight-bold my-3" style="font-size: 45px;">{{$category->name_category}}</h2>

        <div class="row">
          @forelse ($arrayProducts as $product)
            @if ($product->name_category == $category->name_category)
              {{$flag=false}}
              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card text-center">
                  <a href="/productPreview/{{$product->id}}"> <img src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img-top" alt="img_product"> </a>
                  <div class="card-body" >
                    <h3 style="font-weight: bolder; color:black;" class="card-title">{{$product->name}}</h3>
                    {{-- <p>{{$product->name_category . " - " . $product->name_trademark}}</p> --}}
                    {{-- <p class="card-text"><i>{{$product->description}}</i></p> --}}
                    {{-- @if ($product->stock >= 10)
                      <p class="card-text" style="color:black; font-weight: bold;"> Stock: High({{$product->stock}})</p>
                    @elseif($product->stock >= 6)
                      <p class="card-text" style="color:black; font-weight: bold;"> Stock: Medium({{$product->stock}})</p>
                    @else
                      <p class="card-text" style="color:black; font-weight: bold;"> Stock: Low({{$product->stock}})</p>
                    @endif --}}
                    {{-- <p class="card-text">Material: Fantasy</p> --}}
                    <p class="card-text">Price: ${{$product->price}}</p>
                    {{-- <p class="card-text">Efectivo/Mercado Pago</p> --}}
                  </div>
                </div>
              </div>
            @endif
          @empty
            <div class="alert alert-warning mt-4 d-block text-center my-5 p-4" style="font-size: 2.5em;margin: 0 auto; width: 80%;" role="alert">
              There are no products loaded in the system!
            </div>
          @endforelse
        </div>
      <!-- NOTE: fin div-row -->
      @if ($flag)
        <div class="alert alert-warning p-4 text-center m-auto" style="font-size: 1.1em; width: 75%;" role="alert">
        <strong>¡There are no products associated to this category!</strong>
        </div>
      @endif
    @empty
      <div class="alert alert-warning mt-4 d-block text-center mx-auto my-5 p-5" style="font-size: 2.5em;width: 75%;" role="alert">
        <strong>Sorry, there are no products loaded <br>in the system yet...</strong>
      </div>
    @endforelse
  </div>
  <!-- NOTE: fin container-fluid -->
@endsection
