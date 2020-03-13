@extends('template')

@section('title')
  Hassen CRUD Products - Online Store
@endsection

@section('crudProducts')

  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5" style="color:black;"><b>Gestión de Productos</b></h1>

    {{-- ARRAY DE ERRORES --}}
    <ul class="errors" style="color:red;">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    {{-- ARRAY DE ERRORES --}}
    <div class="section">
      <!-- INICIO FORMS PRODUCTO -->
      <!-- INICIA FORM ALTA PRODUCTOS EN BD-->

      <div class="section">

          <h2 class="mt-4"> <b>Productos en el sistema:</b> </h2>

          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col"> ID </th> <th scope="col">Nombre</th> <th scope="col">Precio</th> <th scope="col">Descripción</th> <th scope="col">Fecha de Alta</th> <th scope="col">Fecha de Modificación</th> <th scope="col">Stock</th>
                <th scope="col">Actualizar</th> <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=1;
              @endphp
              @forelse ($arrayProducts as $product)
                <tr>
                  <th scope="row"> {{$contador++}} </th> <td>{{$product->name}}</td> <td>{{$product->price}}</td> <td>{{$product->description}}</td>
                  <td>{{$product->created_at}}</td> <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td> <td>{{$product->stock}}</td>
                  <td> <button type="button" class="btn btn-link"> <a href="/productManagment/updateProduct/{{$product->id}}"> <i class="fas fa-pencil-alt"></i> Editar </a> </button> </td>
                  <td> <form class="" action="/productManagment/deleteProduct" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="product_id" value="{{$product->id}}"> <button type="submit" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Eliminar </button>
                  </form> </td>
                </tr>
              @empty
                <tr>
                  <th scope="row"> ** </th> <td colspan="8"> <i>NO HAY PRODUCTOS CARGADAS EN SISTEMA...</i> </td>
                </tr>
              @endforelse
            </tbody>
          </table>

      </div>

      <form class="register_product" action="/productManagment/createProduct" method="post" enctype="multipart/form-data">
        {{-- @method() --}}
        @csrf
        <h2 class="mt-4"> <b>Producto:</b> </h2>
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
            <p class="ml-3"> <strong> <i>¡¡No hay marcas relacionadas a categorias en el sistema!!</i> </strong> </p>
            <div class="alert alert-warning" role="alert">
              <strong>Nota: </strong>Si no existe ninguna relación entre marcas y categorias no podrá cargar ningún producto!
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

    </div>

    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Volver a Categoría</strong> </a>
      <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudProducts"> <strong>Continuar a Producto</strong> </a>
    </div>
  </div>
@endsection
