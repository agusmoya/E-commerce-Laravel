@extends('template')

@section('title')
  Hassen CRUD Products - Online Store
@endsection

@section('crudProducts')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Products</li>
          <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </nav>
    </div>
  <div class="container my-5" style="background-color:white; width:85%;">
    <h1 class="text-center py-4 " style="color:black;"><b>Edit Product</b></h1>

    {{-- ARRAY DE ERRORES --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger mx-auto my-4" style="width:80%;">
        <p style="color:black">{{"Please correct the following errors:"}}</p>
        <ul class="errors" style="color:red;">
          @foreach ($errors->all() as $error)
            <li style="color:#900c3f">{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    {{-- ARRAY DE ERRORES --}}
    <form class="update_product" name="update_product" action="/productManagment/updateProduct" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="form-group">
        <div class="col-md-5 m-auto">
          <img src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img img-thumbnail border-dark" alt="product_photo">
        </div>
      </div>
      <div class="form-group">
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <label for="exampleFormControlInput1" class="mt-3"><i> Enter a name: </i></label>
        <input name="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" id="exampleFormControlInput1" value="{{$product->name}}">
          @error('name_product')
            <small id="alert" class="form-text " style="color:red">
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsCrudProd" class="form-text" style="color:red">
            <strong></strong>
          </small>
        </div>
        <div class="form-group">
        <label for="exampleFormControlInput1" class="mt-3"><i> Enter a price: </i></label>
        <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" id="exampleFormControlInput1" value="{{$product->price}}">
          @error('price')
            <small id="alert" class="form-text" style="color:red">
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsCrudProd" class="form-text" style="color:red">
            <strong></strong>
          </small>
        </div>
        <div class="form-group">
        <label for="exampleFormControlInput1" class="mt-3"><i> Enter a description: </i></label>
        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="exampleFormControlInput1" value="{{$product->description}}">
          @error('description')
            <small id="alert" class="form-text" style="color:red">
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsCrudProd" class="form-text" style="color:red">
            <strong></strong>
          </small>
        </div>
        <div class="form-group">
        <label for="exampleFormControlInput1" class="mt-3"><i> Enter available stock: </i></label>
        <input name="stock" type="text" class="form-control @error('stock') is-invalid @enderror" id="exampleFormControlInput1" value="{{$product->stock}}">
          @error('stock')
            <small id="alert" class="form-text" style="color:red">
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsCrudProd" class="form-text" style="color:red">
            <strong></strong>
          </small>
      </div>
      <!-- CARGAR IMAGEN -->
      <div class="form-group">
        <label for="exampleFormControlFile1"><i> Choose an image for the product: </i></label>
        <input name="photo" type="file" class="form-control-file @error('photo') is-invalid @enderror" id="exampleFormControlFile1">
          @error('photo')
            <small id="alert" class="form-text" style="color:red">
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsBtnUpdateProd" class="form-text text-center" style="color:red"></small>
      </div>
      <!-- FIN CARGAR IMAGEN -->
      <div class="form-group text-center">
        <button id="btnUpdateProd" type="submit" name="register_producto" class="btn btn-block my-4 col-12 col-md-6 mx-auto text-white"> Update </button>
      </div>
      <a class="btn btn-outline-dark mb-2" href="/productManagment/crudProducts"> <i class="fas fa-angle-double-left"></i> Products </a>
    </form>

  </div>
@endsection
