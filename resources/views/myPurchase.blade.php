@extends('template')

@section('title')
  Hassen My Purchase - Online Store
@endsection

@section('myPurchase')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"> My purchase </a></li>
      {{-- <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li> --}}
    </ol>
  </nav>

<div class="container-fluid" style="width:75%">
  <div class="table-responsive">
  <table id="cart" class="table mt-5 text-center">
  <thead>
    <tr>
      <th class="text-left" scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="container-fluid text-center" style="width:10%">
      <img class="img-fluid card-img" src="{{asset('/storage/imagenes/imgProductos/'.$itemCart->photo)}}" alt="profile-photo">

      </td>
      <td><a href="/productPreview/{{$itemCart->id}}"> {{$itemCart->name}} </a></td>
      <td>${{$itemCart->price}}</td>
      <td>${{$itemCart->price}}</td>
    </tr>
  </tbody>
</table>
</div>
</div>
@endsection
