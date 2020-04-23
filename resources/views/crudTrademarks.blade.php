@extends('template')

@section('title')
  Hassen CRUD Trademarks - Online Store
@endsection

@section('crudTrademarks')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">CRUD Trademark</li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategories">CRUD Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark|Category</a></li>
      {{-- <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li> --}}
    </ol>
  </nav>
  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5" style="color:black;"><b>Gestión de Marcas</b></h1>

    {{-- ARRAY DE ERRORES --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger m-auto"  style="width:80%;">
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

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->

        <h3 class="mt-4" style="color:black;"> <b>Marcas en el sistema:</b> </h3>
        <div class="table-responsive">

          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col"> Marca ID</th> <th scope="col">Nombre Marca</th> <th scope="col">Fecha de Alta</th>
                <th scope="col">Fecha de Modificación</th> <th scope="col">Actualizar</th> <th scope="col">Eliminar</th>
              </tr>
              </thead>
              <tbody>
                @php
                $contador=1;
                @endphp
                @forelse ($arrayTrademarks as $trademark)
                  <tr class="text-center">
                    <th scope="row"> {{$contador++}} </th> <td>{{$trademark->name}}</td> <td>{{$trademark->created_at}}</td> <td>{{$trademark->updated_at}}</td>
                    <td> <button type="button" class="btn btn-link btn-sm"> <a href="/productManagment/updateTrademark/{{$trademark->id}}"> <i class="fas fa-pencil-alt"></i> <b>Editar</b> </a> </button> </td>
                    <td> <form class="" action="/productManagment/deleteTrademark" method="post">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="trademark_id" value="{{$trademark->id}}"> <button type="submit" class="btn btn-link btn-sm"> <i class="far fa-trash-alt"> </i> <b>Eliminar</b> </button>
                    </form> </td>
                  </tr>
                @empty
                  <tr class="text-center">
                    <th scope="row"> ** </th> <td colspan="5"> <i>NO HAY MARCAS CARGADAS EN SISTEMA...</i> </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <div class="pagination justify-content-center">
              <div>{{$arrayTrademarks->links()}}</div>
            </div>
          </div>


      <!-- FIN FORM CONSULTA MARCAS EN BD -->
      <!-- INICIA FORM CARGAR MARCA EN BD -->
      <form class="create_trademark" action="/productManagment/createTrademark" method="post">
        @csrf
        <div class="form-group">
          <p><i> Si el nombre de la marca no se encuentra entre las opciones del menu desplegable <b>realice los pasos a continuación: </b></i></p>
          <p><i><b>1°)</b> Ingrese un nombre.</i></p>
          <p><i><b>2°)</b> Haga click en el botón "Crear Marca".</i></p>
          <p><i><b>3°)</b> Seleccione la marca en el menu desplegable.</i></p>
          <h4 class="mt-3">Cargar marca:</h4>
          <label for="exampleFormControlInput1">Ingrese una marca a cargar en el sistema: </label>
          <input name="name_trademark" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de la marca..." value="{{old('name_trademark')}}">

        </div>
        <button type="submit" name="register_trademark" class="btn btn-dark mb-3">Crear Marca</button>
      </form>
    </div>

      <!-- FIN FORM CARGAR MARCA EN BD -->
      <!-- FIN FORMS MARCA -->

      <div class="form-group p-3 text-right">
        <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/homeHassen"> <strong>Volver a Home</strong> </a>
        <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Continuar a Categoría</strong> </a>
      </div>
    </div>

@endsection
