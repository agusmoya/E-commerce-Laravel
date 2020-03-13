@extends('template')

@section('title')
  Hassen CRUD Categories - Online Store
@endsection

@section('crudCategories')

  <div class="container" style="background-color:white;">

    <h1 class="text-center my-4 p-5" style="color:black;"><b>Gestión de Categorías</b></h1>

    {{-- ARRAY DE ERRORES --}}
    <ul class="errors" style="color:red;">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    {{-- ARRAY DE ERRORES --}}

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->
    <div class="section">
      <div class="form-group">
        <h2 class="mt-4"> <b>Categorías en el sistema:</b> </h2>

        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col"> Categoría ID</th> <th scope="col">Nombre Categoría</th> <th scope="col">Fecha de Alta</th> <th scope="col">Fecha de Modificación</th> <th scope="col">Actualizar</th> <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            @php
            $contador=1;
            @endphp
            @forelse ($arrayCategories as $category)
              <tr>
                <th scope="row"> {{$contador++}} </th> <td>{{$category->name}}</td> <td>{{$category->created_at}}</td> <td>{{$category->updated_at}}</td>
                <td> <button type="button" class="btn btn-link"> <a href="/productManagment/updateCategory/{{$category->id}}"> <i class="fas fa-pencil-alt"></i> Editar </a> </button> </td>
                <td> <form class="" action="/productManagment/deleteCategory" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="category_id" value="{{$category->id}}"> <button type="submit" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Eliminar </button>
                </form> </td>
              </tr>
            @empty
              <tr>
                <th scope="row"> ** </th> <td> <i>NO HAY CATEGORIAS CARGADAS EN SISTEMA...</i> </td>
              </tr>
            @endforelse
          </tbody>
        </table>
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
