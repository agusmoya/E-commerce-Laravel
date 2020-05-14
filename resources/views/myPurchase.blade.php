@extends('template')

@section('title')
  Hassen My Purchase - Online Store
@endsection

@section('myPurchase')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb text-uppercase">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen/availableProducts">Available Products</a></li>
      <li class="breadcrumb-item active" aria-current="page"> My purchase </a></li>
      {{-- <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li> --}}
    </ol>
  </nav>

<div class="container">
  <div class="row">

  <div class="table-responsive">
      <table id="cart" class="table mt-5 text-center">
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
            @if (session('shoppingCart'))
                  @forelse (session('shoppingCart') as $item)

                    @if (session()->has('maxStockAlert'))
                      <div class="alert alert-warning" role="alert">
                        {{session('maxStockAlert')}}
                      </div>
                    @endif
                    <tr id="rowItemCartId" data-item-id="{{$item['code']}}">
                      <td class="align-middle" class="container-fluid text-center" style="width:10%">
                      <img class="img-fluid card-img" src="{{asset('/storage/imagenes/imgProductos/'.$item['photo'])}}" alt="profile-photo">
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
                    <td class="text-right pr-5" colspan="6"><span style="font-size: 20px;font-weight:bold;" id="total">Total: $ </span> </td>
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
  <a href="/homeHassen/availableProducts" style="color:lightblue;" class="btn btn-link" name="button"><i style="font-size:20px;" class="fas fa-long-arrow-alt-left"></i> Seguir comprando</a>
</div>
@endsection
