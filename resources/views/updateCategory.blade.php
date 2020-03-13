@extends('template')

@section('title')
  Hassen CRUD Categories - Online Store
@endsection

@section('crudCategories')
  <div class="container my-5" style="background-color:white;">
    <h1 class="text-center " style="color:black;"><b>Actualizar Marca</b></h1>

    {{-- ARRAY DE ERRORES --}}
    <ul class="errors" style="color:red;">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    {{-- ARRAY DE ERRORES --}}

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->
    <form class="update_category" action="/productManagment/updateCategory" method="post">
      @csrf
      @method('put')
      <div class="form-group">
        <h4 class="ml-5" style="color:black;"> <b><i>Aquí podrá modificar el nombre de la categoría:</i></b> </h4>
        <div class="input-group m-2 p-2">
          <input type="hidden" name="category_id" value="{{$category->id}}">
          <input type="text" class="form-control" name="name_category" value="{{$category->name}}" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-dark" type="submit" id="button-addon2">Actualizar Categoría</button>
          </div>
        </div>
      </form>
      <!-- FIN FORM MODIFICAR CATEGORIES EN BD -->
    </div>
    <a class="btn btn-secondary mb-2" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Volver a Categoría</strong> </a>

  </div>
  @endsection
