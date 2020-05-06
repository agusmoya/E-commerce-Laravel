@extends('template')

@section('title')
  Hassen CRUD Trademarks - Online Store
@endsection

@section('crudTrademarks')
  <div class="container my-5" style="background-color:white;">
    <h1 class="text-center my-3 py-3" style="color:black;"><b>Update trademark</b></h1>

    {{-- ARRAY DE ERRORES --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger mx-auto my-4"  style="width:80%;">
        <p style="color:black; font-weight: bold;">{{"Please correct the following errors:"}}</p>
        <ul class="errors">
          @foreach ($errors->all() as $error)
            <li style="color:#e43f5a">{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    {{-- ARRAY DE ERRORES --}}

    <!-- INICIA FORMS MARCAS -->
    <!-- INICIA FORM CONSULTA MARCAS EN BD -->
    <form class="update_trademark_get" name="update_trademark" action="/productManagment/updateTrademark" method="post">
      @csrf
      @method('put')
      <div class="form-group mb-4 text-center">
        <h5 style="color:black;">Enter a new name for the trademark:</h5>
        <div class="input-group">
          <input type="hidden" name="update_trademark_id" value="{{$trademark->id}}">
          <input type="text" id="name_trademark" name="name_trademark" class="col-8 m-auto form-control @error('name_trademark') is-invalid @enderror" value="{{$trademark->name}}" aria-describedby="button-addon2">
        </div>
        @error('name_trademark')
          <small id="alert" class="form-text" style="color:red">
            <strong>{{ $message }}</strong>
          </small>
        @enderror
        <small id="alertJsNameTrademark" class="text-center form-text" style="color:red">
              <strong></strong>
        </small>
      </div>
        <button name="register_trademark" class="btn btn-dark btn-block col-4 m-auto" type="submit" id="button-addon2">Update</button>
      </form>
      <!-- FIN FORM MODIFICAR MARCAS EN BD -->
    <a class="btn btn-secondary mb-2" style="text-decoration: none;color:white;" href="/productManagment/crudTrademarks"> <strong>Back to trademark</strong> </a>

  </div>

  @endsection
