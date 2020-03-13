@extends('template')

@section('title')
  Hassen CRUD Trademarks - Online Store
@endsection

@section('crudTrademarks')

  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5" style="color:black;"><b>Gestión de Marcas</b></h1>

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
        <h2 class="mt-4"> <b>Marcas en el sistema:</b> </h2>

        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col"> Marca ID</th> <th scope="col">Nombre Marca</th> <th scope="col">Fecha de Alta</th> <th scope="col">Fecha de Modificación</th> <th scope="col">Actualizar</th> <th scope="col">Eliminar</th>            </tr>
          </thead>
          <tbody>
            @php
            $contador=1;
            @endphp
            @forelse ($arrayTrademarks as $trademark)
              <tr>
                <th scope="row"> {{$contador++}} </th> <td>{{$trademark->name}}</td> <td>{{$trademark->created_at}}</td> <td>{{$trademark->updated_at}}</td>
                <td> <button type="button" class="btn btn-link"> <a href="/productManagment/updateTrademark/{{$trademark->id}}"> <i class="fas fa-pencil-alt"></i> Editar </a> </button> </td>
                <td> <form class="" action="/productManagment/deleteTrademark" method="post">
                  @csrf
                  @method('delete')
                   <input type="hidden" name="trademark_id" value="{{$trademark->id}}"> <button type="submit" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Eliminar </button>
                 </form> </td>
              </tr>
            @empty
              <tr>
                <th scope="row"> ** </th> <td> <i>NO HAY MARCAS CARGADAS EN SISTEMA...</i> </td>
              </tr>
            @endforelse
          </tbody>
        </table>
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
    <!-- FIN FORM CARGAR MARCA EN BD -->
    <!-- FIN FORMS MARCA -->

    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/homeHassen"> <strong>Volver a Home</strong> </a>
      <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Continuar a Categoría</strong> </a>
    </div>
  </div>

</div>


@endsection
