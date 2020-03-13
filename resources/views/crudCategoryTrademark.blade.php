@extends('template')

@section('title')
  Hassen CRUD Relationship Category/Trademarks - Online Store
@endsection

@section('crudCategoryTrademark')

  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5" style="color:black;"><b>Relación Marca/Categoría</b></h1>

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
          <h2 class="mt-4"> <b>Relaciones Marca/Categorías en el sistema:</b> </h2>

          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col"> Relación ID</th> <th scope="col">Nombre Marca</th> <th scope="col">Nombre Categoría</th> <th scope="col">Fecha de Alta</th> <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=1;
              @endphp
              @forelse ($arrayCategoryTrademark as $categoryTrademark)
                <tr>
                  <th scope="row"> {{$contador++}} </th> <td>{{$categoryTrademark->name_trademark}}</td> <td>{{$categoryTrademark->name_category}}</td> <td>{{$categoryTrademark->created_at}}</td>
                  <td> <form class="" action="/productManagment/deleteCategoryTrademark" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="trademark_id" value="{{$categoryTrademark->trademark_id}}">
                    <input type="hidden" name="category_id" value="{{$categoryTrademark->category_id}}">
                    <button type="submit" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Eliminar </button>
                  </form> </td>
                </tr>
              @empty
                <tr>
                  <th scope="row"> ** </th> <td  colspan="5"> <i>NO HAY RELACIONES ENTRE MARCAS Y CATEGORIAS CARGADAS EN SISTEMA...</i> </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- INICIA FORM RELACION CATEGORIA/MARCA EN BD -->
        <form class="show_categories_trademarks" action="/productManagment/createCategoryTrademark" method="post">
          @csrf
          <h2 class="mt-4"> <b>Relación Categoría/Marca:</b> </h2>
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


      </div>

    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Volver a Categoría</strong> </a>
      <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudProducts"> <strong>Continuar a Producto</strong> </a>
    </div>
  </div>
@endsection
