@extends('template')

@section('title')
  Hassen CRUD Products - Online Store
@endsection

@section('crudProducts')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudCategories">CRUD Category</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark&Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">CRUD Products</li>
        <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
      </ol>
    </nav>
  </div>
  <div class="container-fluid p-4" style="background-color:white;">
    <h1 class="text-center my-3 p-3" style="color:black;"><b>Products management</b></h1>
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
    <!-- INICIO FORMS PRODUCTO -->
    <!-- INICIA FORM ALTA PRODUCTOS EN BD-->
    <div class="table-responsive">
      <h3 class="mt-4" style="color:black"> <b>Products in the system:</b> </h3>
      <table id="products" class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Trademark</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Stock</th>
            <th scope="col">Show</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @php
          $contador=1;
          @endphp
          @forelse ($arrayProducts as $product)
            <tr class="text-center">
              <th class="align-middle" scope="row"> {{$contador++}} </th>
              <td class="align-middle" class="container-fluid text-center">
                <img id="center" style="min-width:160px; max-width:160px;" class="img-fluid card-img" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" alt="profile-photo">
              </td>
              <td class="align-middle">{{$product->name}}</td>
              <td class="align-middle">${{$product->price}}</td>
              <td class="align-middle">{{$product->name_trademark}}</td>
              <td class="align-middle">{{$product->name_category}}</td>
              <td class="align-middle">{{$product->description}}</td>
              <td class="align-middle">{{$product->created_at}}</td>
              <td class="align-middle">{{ \Carbon\Carbon::parse($product->updated_at)->format('d/m/Y')}}</td>
              <td class="align-middle">{{$product->stock}}</td>
              <td class="align-middle">
                <a href="/productPreview/{{$product->id}}" class= "btn btn-link" style="color:#005792;font-size:1em;">
                  <i class="fas fa-search-plus" style="font-size:1.2em;"></i> Show
                </a>
              </td>
              <td class="align-middle">
                <a href="/productManagment/updateProduct/{{$product->id}}" class= "btn btn-link" style="color:#12776f;font-size:1em;">
                  <i class="fas fa-pencil-alt" style="font-size:1.2em;"></i> Edit
                </a>
              </td>
              <td class="align-middle">
                <form class="my-0" action="/productManagment/deleteProduct" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="product_id" value="{{$product->id}}">
                  <button name="btnDeleteProd" id="btnDeleteProd" type="submit" class="btn btn-link" style="color:#ff3434;font-size:1em;">
                    <i class="far fa-trash-alt" style="font-size:1.2em;"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr class="text-center">
              <th scope="row"> ** </th> <td colspan="12"> <i>NO PRODUCTS LOADED IN SYSTEM...</i> </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <div class="pagination justify-content-center">
        <p>{{$arrayProducts->links()}}</p>
      </div>
    </div>
    <fieldset {{ count($arrayCategoryTrademark) == 0 ? 'disabled' : '' }}>
      <form name="register_product" class="register_product mb-0" action="/productManagment/createProduct" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="my-4 text-center font-weight-bold text-dark"> <b>Create Product:</b> </h2>
        <h5> Available categories by Trademark: </h5>
        <div class="row">
          @forelse ($arrayTrademarks as $trademark)
            <div class="col-12 col-sm-6 col-lg-4 border p-3">
              <label for="inlineFormCustomSelectPref">
                <h3><i>{{$trademark->name . ":"}}</i></h3>
              </label>
              @forelse ($trademark->categories as $category)
                <div class="form-check">
                  <input class="form-check-input @error('trademarkId_categoryId') is-invalid @enderror" type="radio" name="trademarkId_categoryId" id="{{$trademark->name . $category->name}}" value="{{$trademark->id . ',' .$category->id}}">
                    <label class="form-check-label" for="{{$trademark->name . $category->name}}">
                      {{$category->name}}
                    </label>
                  </div>
                @empty
                  <div class="form-check alert alert-warning text-center col-10 mx-auto">
                    {{"There are no categories related to the trademark $trademark->name!"}}
                  </div>
                @endforelse
                @error('trademarkId_categoryId')
                  <small id="alert" class="form-text" style="color:red">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            @empty
              <div class="col-10 m-auto">
                <div class="alert alert-warning text-center m-3 p-3" role="alert">
                  <strong>Note: </strong>If there is no relationship between trademarks and categories you will not be able to upload any product!
                </div>
              </div>
            @endforelse
          </div>
          <div class="form-group mt-4">
            <label for="exampleFormControlInput1"><i> Enter a name: </i></label>
            <input name="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror @error('name_product') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product name..."  value="{{old('name_product')}}">
              @error('name_product')
                <small id="alert" class="form-text" style="color:red">
                  {{ $message }}
                </small>
              @enderror
              <small id="alertJsCrudProd" class="form-text" style="color:red"></small>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1"><i> Enter a price: </i></label>
              <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product price..."  value="{{old('price')}}">
                @error('price')
                  <small id="alert" class="form-text" style="color:red">
                    {{ $message }}
                  </small>
                @enderror
                <small id="alertJsCrudProd" class="form-text" style="color:red"></small>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1"><i> Enter a description: </i></label>
                <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Description..."  value="{{old('description')}}">
                  @error('description')
                    <small id="alert" class="form-text" style="color:red">
                      {{ $message }}
                    </small>
                  @enderror
                  <small id="alertJsCrudProd" class="form-text" style="color:red"></small>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1"><i> Enter available stock: </i></label>
                  <input name="stock" type="text" class="form-control @error('stock') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Product stock..."  value="{{old('stock')}}">
                    @error('stock')
                      <small id="alert" class="form-text" style="color:red">
                        {{ $message }}
                      </small>
                    @enderror
                    <small id="alertJsCrudProd" class="form-text" style="color:red"></small>
                  </div>
                  <!-- CARGAR IMAGEN -->
                  <div class="form-group">
                    <label for="exampleFormControlFile1"><i> Choose an image for the product: </i></label>
                    <input name="photo" type="file" class="form-control-file @error('photo') is-invalid @enderror" id="exampleFormControlFile1">
                      @error('photo')
                        <small id="alert" class="form-text" style="color:red">
                          {{ $message }}
                        </small>
                      @enderror
                      <small id="alertJsCrudProd" class="form-text" style="color:red"></small>
                    </div>
                    <!-- FIN CARGAR IMAGEN -->
                    <div class="form-group text-center">
                      <small id="alertJsBtnCrudProd" class="form-text" style="color:red"></small>
                      <button id="btnCreateProduct" type="submit" name="register_producto" class="btn btn-danger btn-lg my-3">Create Product</button>
                    </div>
                  </form>
                </fieldset>
                <div class="form-group text-center text-sm-left">
                  <a class="btn btn-outline-dark" href="/productManagment/crudCategoryTrademark"><i class="fas fa-angle-double-left"></i> Categories/Trademark </a>
                </div>
              </div>
            @endsection
