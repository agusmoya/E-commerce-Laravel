@extends('template')

@section('title')
  Hassen CRUD Trademarks - Online Store
@endsection

@section('crudTrademarks')
  <div class="container my-5" style="background-color:white;">
    <h1 class="text-center my-5 py-5" style="color:black;"><b>Actualizar Marca</b></h1>

    {{-- ARRAY DE ERRORES --}}
    <ul class="errors" style="color:red;">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    {{-- ARRAY DE ERRORES --}}

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->
    <form class="update_trademark_get" action="/productManagment/updateTrademark" method="post">
      @csrf
      @method('put')

      <div class="form-group mb-4">
        <h4 class="ml-4 pb-3" style="color:black;"> <b><i>Aquí podrá modificar el nombre de la marca:</i></b> </h4>

        <div class="input-group m-2 p-2">
          <input type="hidden" name="update_trademark_id" value="{{$trademark->id}}">
          <input type="text" class="form-control" name="name_trademark" value="{{$trademark->name}}" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-dark" type="submit" id="button-addon2">Actualizar Marca</button>
          </div>
        </div>
      </form>
      <!-- FIN FORM MODIFICAR MARCAS EN BD -->
    </div>
    <a class="btn btn-secondary mb-2" style="text-decoration: none;color:white;" href="/productManagment/crudTrademarks"> <strong>Volver a Marcas</strong> </a>

  </div>

  @endsection
