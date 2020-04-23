@extends('template')

@section('title')
  Hassen CRUD Categories - Online Store
@endsection

@section('crudCategories')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
      <li class="breadcrumb-item active" aria-current="page">CRUD Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark|Category</a></li>
      {{-- <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li> --}}
    </ol>
  </nav>

  <div class="container" style="background-color:white;">

    <h1 class="text-center my-4 p-5" style="color:black;"><b>Gestión de Categorías</b></h1>

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

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->
    <div class="section">
      <div class="form-group">
        <h3 class="mt-4" style="color:black;"> <b>Categorías en el sistema:</b> </h3>
        <div class="table-responsive">

          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col">ID</th> <th scope="col">Nombre</th> <th scope="col">Fecha de Alta</th> <th scope="col">Fecha de Modificación</th> <th scope="col">Actualizar</th> <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=1;
              @endphp
              @forelse ($arrayCategories as $category)
                <tr class="text-center">
                  <th scope="row"> {{$contador++}} </th> <td>{{$category->name}}</td> <td>{{$category->created_at}}</td> <td>{{$category->updated_at}}</td>
                  <td> <button type="button" class="btn btn-link"> <a href="/productManagment/updateCategory/{{$category->id}}"> <i class="fas fa-pencil-alt"></i> Editar </a> </button> </td>
                  <td> <form class="" action="/productManagment/deleteCategory" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="category_id" value="{{$category->id}}"> <button type="submit" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Eliminar </button>
                  </form> </td>
                </tr>
              @empty
                <tr class="text-center">
                  <th scope="row"> ** </th> <td colspan="6"> <i>NO HAY CATEGORIAS CARGADAS EN SISTEMA...</i> </td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="pagination justify-content-center">
            {{$arrayCategories->links()}}
          </div>
        </div>

      </div>
    </div>

    <!-- FIN FORM CONSULTA MARCAS EN BD -->
    <!-- INICIA FORM CARGAR MARCA EN BD -->
    <form class="create_category" action="/productManagment/createCategory" method="post">
      @csrf
      <div class="form-group">
        <p><i> Si el nombre de la categoría no se encuentra entre las opciones del menu desplegable <b>realice los pasos a continuación: </b></i></p>
        <p><i><b>1°)</b> Ingrese un nombre.</i></p>
        <p><i><b>2°)</b> Haga click en el botón "Crear Categoría".</i></p>
        <p><i><b>3°)</b> Seleccione la categoría en el menu desplegable.</i></p>
        <h4 class="mt-3">Cargar Categoría:</h4>
        <label for="exampleFormControlInput1">Ingrese una categoría a cargar en el sistema: </label>
        <input name="name_category" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de la categoría..." value="{{old('name_category')}}">

      </div>
      <button type="submit" name="register_category" class="btn btn-dark mb-3">Crear Categoría</button>
    </form>
    <!-- FIN FORM CARGAR CATEGORY EN BD -->
    <!-- FIN FORMS CATEGORY -->
    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/productManagment/crudTrademarks"> <strong>Volver a Marcas</strong> </a>
      <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudCategoryTrademark"> <strong>Continuar a Relación Marca/Categoría</strong> </a>
    </div>
  </div>

@endsection
