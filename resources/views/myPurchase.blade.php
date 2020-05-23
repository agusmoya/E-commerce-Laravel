@extends('template')

@section('title')
  Hassen My Purchase - Online Store
@endsection

@section('myPurchase')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen/availableProducts">Available Products</a></li>
        <li class="breadcrumb-item active" aria-current="page"> My purchase </a></li>
      </ol>
    </nav>
  </div>
  <div class="container-fluid mb-5 pb-5" style="width:80%">
    <div class="row">

      <div class="table-responsive mt-5">
        <table id="cart" class="table mt-3 text-center">
          <thead class="">
            <tr>
              <th class="text-left" scope="col">Product</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Amount</th>
              <th scope="col">Subtotal</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody id="items">
            {{-- {{dd(session('shoppingCart'))}} --}}
            @if (session('shoppingCart'))
              @forelse (session('shoppingCart') as $item)

                @if (session()->has('maxStockAlert'))
                  <div class="alert alert-warning" role="alert">
                    {{session('maxStockAlert')}}
                  </div>
                @endif
                <tr id="rowItemCartId" data-item-id="{{$item['code']}}">
                  <td class="align-middle" class="container-fluid text-center">
                    <img class="img-fluid card-img" style="min-width:160px; max-width:160px;" src="{{asset('/storage/imagenes/imgProductos/'.$item['photo'])}}" alt="profile-photo">
                  </td>
                  <td class="align-middle" ><a style="color: black;" href="/productPreview/{{$item['code']}}"> {{$item['name']}} </a></td>
                  <td id="tdItemCartPrice" class="align-middle" data-prod-price="{{$item['price']}}">$<span id="price">{{$item['price']}}</span></td>

                  <td id="tdItemCartAmount" class="align-middle">
                    <input class="text-center" style="width:80px;" id="amountItemCart" data-item-id="{{$item['code']}}" data-prod-price="{{$item['price']}}"
                    type="number" value="{{$item['amount']}}" min="1" data-stock="{{$item['stock']}}">
                  </td>
                  <td id="tdItemCartSubtotal" class="align-middle">$ <span id="subtotal" data-item-id="{{$item['code']}}">{{$item['price'] * $item['amount']}}</span></td>

                  <td class="align-middle">
                    <form class="" action="myPurchase/removeItem" method="post">
                      @csrf
                      <input type="hidden" name="itemId" value="{{$item['code']}}">
                      <input type="hidden" name="itemAmount" value="{{$item['amount']}}">
                      <button class="btn btn-link" type="submit"><i style="font-size:20px; color:black;" class="far fa-trash-alt"></i> </button>
                    </form>
                  </td>
                </tr>

              @empty
                <tr class="text-center">
                  <td class="align-middle" colspan="6"> The cart is empty! <a href="/homeHassen/availableProducts">See more products...</a> </td>
                </tr>

              @endforelse
              <tr>
                <td class="text-center text-sm-right" colspan="6"><span style="font-size: 20px;font-weight:bold;" id="total">Total: $ </span> </td>
              </tr>
            @else
              <tr class="text-center">
                <td class="align-middle" colspan="6"> The cart is empty! <a href="/homeHassen/availableProducts">See more products...</a></td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <div class="d-block d-sm-flex justify-content-between">
      <a href="/homeHassen/availableProducts" style="color:lightblue;" class="btn btn-link" name="button"><i style="font-size:20px;" class="fas fa-long-arrow-alt-left"></i> Continue shopping </a>
      <form action="{{ url('myPurchase/confirm') }}" method="post">
        @csrf
        <button id="btnConfrimPurchase" type="submit" class="btn btn-light text-uppercase btn-block mt-2 mt-sm-0" name="button"> Confirm purchase </button>
      </form>
    </div>
  </div>
@endsection
