@extends('template')

@section('title')
  Hassen CRUD Product - Online Store
@endsection

@section('productForm')
  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5"><b>Gestión de Productos</b></h1>

    {{-- ARRAY DE ERRORES --}}
    <ul class="errors" style="color:red;">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    {{-- ARRAY DE ERRORES --}}

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->
    <form class="show_trademarks" action="/productForm" method="GET">
      @csrf
      <div class="form-group">
        <h2 class="mt-4"> <b>Marcas:</b> </h2>
        <label class="mt-3" for="exampleFormControlSelect1"><i>Aquí podrá observar las marcas cargadas en el sistema:</i> </label>
        <select class="form-control" id="exampleFormControlSelect1" name="id_marca" >
          <option value="">Listado de marcas existentes...</option>
          @forelse ($arrayTrademarks as $trademark)
            <option value="{{$trademark->id}}"> {{ $trademark->name }} </option>
          @empty
            <option value="" selected>No hay marcas cargadas en el sistema!</option>
          @endforelse
        </select>
        {{-- <span style="color: red;"class="help-block" id="error"><i></i></span> --}}
      </div>
    </form>
    <!-- FIN FORM CONSULTA MARCAS EN BD -->
    <!-- INICIA FORM CARGAR MARCA EN BD -->
    <form class="register_trademark" action="/productForm/registerTrademark" method="post">
      @csrf
      <div class="form-group">
        <p><i> Si el nombre de la marca no se encuentra entre las opciones del menu desplegable <b>realice los pasos a continuación: </b></i></p>
        <p><i><b>1°)</b> Ingrese un nombre.</i></p>
        <p><i><b>2°)</b> Haga click en el botón "Crear Marca".</i></p>
        <p><i><b>3°)</b> Seleccione la marca en el menu desplegable.</i></p>
        <h4 class="mt-3">Cargar marca:</h4>
        <label for="exampleFormControlInput1">Ingrese una marca a cargar en el sistema: </label>
        <input name="name_trademark" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de la marca..." value="{{old('name_trademark')}}">
        <span style="color: red;"class="help-block" id="error"><i></i></span>
      </div>
      <button type="submit" name="register_trademark" class="btn btn-dark mb-3">Crear Marca</button>
    </form>
    <!-- FIN FORM CARGAR MARCA EN BD -->
    <!-- INICIA FORM ELIMINAR MARCA EN BD -->
    <form class="delete_trademark" action="/productForm/deleteTrademark" method="post">
      {{-- {{csrf_field()}}
      {{method_field('DELETE')}} --}}
      @method('delete')
      @csrf
      <h4 class="mt-3">Eliminar marca:</h4>
      <p>Seleccione una marca de la lista a continuación, y haga click en el botón "Eliminar Marca".</p>
      <div class="form-group">
        <select class="form-control" id="exampleFormControlSelect1" name="id_trademark_delete" >
          <option value="">Seleccione la marca que desea eliminar...</option>
          @forelse ($arrayTrademarks as $trademark)
            <option value="{{$trademark->id}}"> {{ $trademark->name }} </option>
          @empty
            <option value="" selected>No hay marcas cargadas en el sistema!</option>
          @endforelse
        </select>
      </div>
      <button type="submit" name="delete_trademark" class="btn btn-danger mb-3">Eliminar Marca</button>
    </form>
    <!-- FIN FORM ELIMINAR MARCAS EN BD -->
    <!-- FIN FORMS MARCA -->

    <!-- INICIA FORMS CATEGORIA -->
    <!-- INCICIO FORM CONSULTA CATEGORIAS -->
    <form class="show_categories" action="/productForm" method="get">
      @csrf
      <div class="form-group">
        <h2 class="mt-4"> <b>Categorías:</b> </h2>
        <label class="mt-3" for="exampleFormControlSelect1"><i>Aquí podrá observar las categorías cargadas en el sistema: </i></label>
        <select class="form-control" id="exampleFormControlSelect1" name="id_categoria" >
          <option value="">Listado de categorías existentes...</option>
          @forelse ($arrayCategories as $category)
            <option value="{{$category->id}}"> {{ $category->name }} </option>
          @empty
            <option value="" selected>No hay categorías cargadas en el sistema!</option>
          @endforelse
        </select>
      </div>
    </form>
    <!-- FIN FORM CONSULTA CATEGORIAS -->
    <!-- INICIA FORM CARGAR CATEGORIAS EN BD-->
    <form class="register_category" action="/productForm/registerCategory" method="post">
      @csrf
      <div class="form-group">
        <p ><i> Si el nombre de la categoría no se encuentra entre las opciones del menu desplegable <b>realice los pasos a continuación: </b></i></p>
        <p><i><b>1°)</b> Ingrese un nombre.</i></p>
        <p><i><b>2°)</b> Haga click en el botón "Crear Categoría".</i></p>
        <p><i><b>3°)</b> Seleccione la Categoría en el menu desplegable.</i></p>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Ingrese una Categoría a cargar en el sistema: </label>
        <input name="name_category" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de Categoría..." value="">
        <span style="color: red;"class="help-block" id="error"> </span>
      </div>
      <button type="submit" name="register_category" class="btn btn-dark mb-3">Crear Categoría</button>
    </form>
    <!-- FIN FORM CARGAR CATEGORIAS EN BD-->
    <!-- INICIA FORM BAJA CATEGORIAS EN BD-->
    <form class="delete_category" action="/productForm/deleteCategory" method="post">
      @csrf
      @method('delete')
      <h4 class="mt-3">Eliminar categoría:</h4>
      <p>Seleccione una categoría de la lista a continuación, y haga click en el botón "Eliminar Categoría".</p>
      <div class="form-group">
        <select class="form-control" id="exampleFormControlSelect1" name="id_category_delete">
          <option value="">Seleccione la categoría que desea eliminar...</option>
          @forelse ($arrayCategories as $category)
            <option value="{{$category->id}}"> {{ $category->name }} </option>
          @empty
            <option value="" selected>No hay categorías cargadas en el sistema!</option>
          @endforelse
        </select>
      </div>
      <button type="submit" name="delete_category" class="btn btn-danger mb-3">Eliminar Categoría</button>
    </form>
    <!-- FIN FORM BAJA CATEGORIAS EN BD-->
    <!-- FIN CATEGORIA -->

    <!-- INICIA FORM RELACION CATEGORIA/MARCA EN BD -->
    <form class="show_categories_trademarks" action="/productForm/registerCategoryAndTrademark" method="post">
      @csrf
      <h2 class="mt-4"> <b>Relación Catgoría/Marca:</b> </h2>
      <div class="form-group">
        <h3 class="mt-4"> <b>Listado de Categorías:</b> </h3>
        <label class="mt-3" for="exampleFormControlSelect1"><i>Listado de categorías cargadas en el sistema: </i></label>
        <select class="form-control" id="exampleFormControlSelect1" name="category_id" >
          <option value="">Seleccione una categoría...</option>
          @forelse ($arrayCategories as $category)
            <option value="{{$category->id}}"> {{ $category->name }} </option>
          @empty
            <option value="" selected>No hay categorías cargadas en el sistema!</option>
          @endforelse
        </select>
        <span style="color: red;"class="help-block" id="error"><i></i></span>
      </div>

      <div class="form-group">
        <h3 class="mt-4"> <b>Listado de Marcas:</b> </h3>
        <label class="mt-3" for="exampleFormControlSelect1"><i>Listado de marcas cargadas en el sistema:</i> </label>
        <select class="form-control" id="exampleFormControlSelect1" name="trademark_id" >
          <option value="">Seleccione una marca...</option>
          @forelse ($arrayTrademarks as $trademark)
            <option value="{{$trademark->id}}"> {{ $trademark->name }} </option>
          @empty
            <option value="" selected>No hay marcas cargadas en el sistema!</option>
          @endforelse
        </select>
      </div>
      <button type="submit" name="register_category_trademark" class="btn btn-dark mb-3">Relacionar Marca con Categoría</button>
    </form>
    <!-- FIN FORM RELACION CATEGORIA/MARCA EN BD -->

    <!-- INICIO FORMS PRODUCTO -->
    <!-- INICIA FORM ALTA PRODUCTOS EN BD-->
    <form class="register_product" action="/productForm/registerProduct" method="post" enctype="multipart/form-data">
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
          {{"No hay marcas relacionadas a categorias en el sistema!"}}
        @endforelse
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el nombre: </i></label>
        <input name="name_product" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre del producto..."  value="{{old('name_product')}}">
        <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el precio: </i></label>
        <input name="price" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Precio del producto..."  value="{{old('price')}}">
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
    {{-- FIN FORM ALTA PRODUCTO --}}

    {{-- INICIA FORM ELIMINAR PRODUCTO --}}
    <form class="delete_product" action="/productForm/deleteProduct" method="post">
      @csrf
      @method('DELETE')
      <div class="form-group">
        <h4 class="mt-3">Eliminar producto:</h4>
        <p>Seleccione un producto de la lista a continuación, y haga click en el botón "Eliminar Producto".</p>
        <select class="form-control" id="exampleFormControlSelect1" name="id_producto" >
          <option value="">Productos...</option>
          @forelse ($arrayProducts as $product)
            <option value="{{$product->id}}"> {{ $product->name }} </option>
          @empty
            <option value="" selected>No hay productos cargados en el sistema!</option>
          @endforelse
        </select>
        <span style="color: red;"class="help-block" id="error"><i></i></span>
      </div>
      <div class="form-group text-center">
        <button type="submit" name="delete_product" class="btn btn-danger btn-lg mt-2 mb-3">Eliminar Producto</button>
      </div>
    </form>
    <!-- FIN ELIMINAR PRODUCTO -->
    <!-- FIN FORMULARIO GESTION PRODUCTO -->
  </div>
@endsection
