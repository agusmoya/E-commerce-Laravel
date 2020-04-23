@extends('template')

@section('title')
  Hassen CRUD Products - Online Store
@endsection

@section('crudProducts')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategories">CRUD Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark|Category</a></li>
      <li class="breadcrumb-item active" aria-current="page">CRUD Products</li>
    </ol>
  </nav>

  <div id="container_crud_products" class="container-fluid" style="background-color:white;">
    <h1 class="text-center my-3 p-3" style="color:black;"><b>Gestión de Productos</b></h1>

    {{-- ARRAY DE ERRORES --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger m-auto" style="width:80%;">
        <p style="color:black">{{"Please correct the following errors:"}}</p>
        <ul class="errors" style="color:red;">
          @foreach ($errors->all() as $error)
            <li style="color:#900c3f">{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    {{-- ARRAY DE ERRORES --}}
    <div class="section">
      <!-- INICIO FORMS PRODUCTO -->
      <!-- INICIA FORM ALTA PRODUCTOS EN BD-->

      <div class="table-responsive table-bordered">

          <h3 class="mt-4" style="color:black"> <b>Productos en el sistema:</b> </h3>
          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Marca</th>
                <th scope="col">Categoría</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha de Alta</th>
                <th scope="col">Fecha de Modificación</th>
                <th scope="col">Stock</th>
                <th scope="col">Ver</th>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=1;
              @endphp
              @forelse ($arrayProducts as $product)
                <tr class="text-center">
                  <th class="align-middle" scope="row"> {{$contador++}} </th>
                      <td class="container-fluid" style="width:10%">
                      <img id="center" class="img-fluid card-img" src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" alt="profile-photo">
                      </td>
                      <td class="align-middle">{{$product->name}}</td>
                      <td class="align-middle">{{$product->price}}</td>
                      <td class="align-middle">{{$product->name_trademark}}</td>
                      <td class="align-middle">{{$product->name_category}}</td>
                      <td class="align-middle">{{$product->description}}</td>
                      <td class="align-middle">{{$product->created_at}}</td>
                      <td class="align-middle">{{ \Carbon\Carbon::parse($product->updated_at)->format('d/m/Y')}}</td>
                      <td class="align-middle">{{$product->stock}}</td>
                      <td class="align-middle"> <a href="/productPreview/{{$product->id}}" class= "btn btn-link btn-sm" style="color:#0f4c75; "> <i class="fas fa-eye"></i> <b>Ver</b> </a> </td>
                      <td class="align-middle"> <a href="/productManagment/updateProduct/{{$product->id}}" class= "btn btn-link btn-sm" style="color:#64b2cd; "> <i class="fas fa-pencil-alt"></i> <b>Editar</b> </a> </td>
                      <td class="align-middle"> <form class="" action="/productManagment/deleteProduct" method="post">
                                                  @csrf
                                                  @method('delete')
                                                  <input type="hidden" name="product_id" value="{{$product->id}}"> <button type="submit" class="btn btn-link btn-sm" style="color:#e32249;"> <i class="far fa-trash-alt"></i> <b>Eliminar</b> </button>
                                                </form>
                    </td>
                </tr>
              @empty
                <tr class="text-center">
                  <th scope="row"> ** </th> <td colspan="12"> <i>NO HAY PRODUCTOS CARGADAS EN SISTEMA...</i> </td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="pagination justify-content-center">
            <p>{{$arrayProducts->links()}}</p>
          </div>
      </div>

      <fieldset {{ isset($arrayCategoryTrademark['trademark_id']) && isset($arrayCategoryTrademark['category_id']) ? 'disabled' : '' }}>
      <form class="register_product" action="/productManagment/createProduct" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="mt-4" style="color:black;"> <b>Producto:</b> </h2>
        <h5> Categorías disponibles por Marca: </h5>
        <div class="row">
          @forelse ($arrayTrademarks as $trademark)
            <div class="col-6">
              <label class="my-1 mx-2" for="inlineFormCustomSelectPref"><strong><h4><i>{{$trademark->name . ":"}}</i></h4></strong></label>
              @forelse ($trademark->categories as $category)
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="trademarkId_categoryId" id="{{$trademark->name . $category->name}}" value="{{$trademark->id . ',' .$category->id}}">
                  <label class="form-check-label" for="{{$trademark->name . $category->name}}">
                    {{$category->name}}
                  </label>
                </div>
              @empty
                {{"No hay categorías relacinadas a la marca $trademark->name!"}}
              @endforelse
            </div>
          @empty
            <div class="col-10 m-auto">
            {{-- <p class="ml-3"> <strong> <i>¡¡No hay marcas relacionadas a categorías en el sistema!!</i> </strong> </p> --}}
            <div class="alert alert-warning text-center m-3 p-3" role="alert">
              <strong>Nota: </strong>Si no existe ninguna relación entre marcas y categorías no podrá cargar ningún producto!
            </div>
            </div>
          @endforelse
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el nombre: </i></label>
          <input name="name_product" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre del producto..."  value="{{old('name_product')}}">
          <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el precio: </i></label>
          <input name="price" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Precio del producto..."  value="{{old('price')}}">
          <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese descripción: </i></label>
          <input name="description" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Descripción..."  value="{{old('description')}}">
          <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el stock disponible: </i></label>
          <input name="stock" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Stock del producto..."  value="{{old('stock')}}">
        </div>
        <!-- CARGAR IMAGEN -->
        <div class="form-group">
          <label for="exampleFormControlFile1"><i> Elija una imagen para el producto: </i></label>
          <input name="photo" type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <!-- FIN CARGAR IMAGEN -->
        <div class="form-group text-center">
          <button type="submit" name="register_producto" class="btn btn-dark btn-lg mt-4 mb-5">Crear Producto</button>
        </div>

      </form>
    </fieldset>

    </div>

    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Volver a Categoría</strong> </a>
    </div>
  </div>
@endsection
