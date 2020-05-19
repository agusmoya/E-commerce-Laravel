@extends('template')

@section('title')
  Hassen CRUD Trademarks - Online Store
@endsection

@section('crudTrademarks')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Trademark</li>
        <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </nav>
    </div>
  <div class="container my-4" style="background-color:white;">
    <h1 class="text-center my-3 py-3" style="color:black;"><b>Edit trademark</b></h1>

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
            {{ $message }}
          </small>
        @enderror
        <small id="alertJsNameTrademark" class="text-center form-text" style="color:red"></small>
      </div>
      <div class="form-group text-center text-dark">
        <button name="register_trademark" class="btn btn-dark btn-block col-8 col-sm-6 mx-auto my-3" type="submit" id="btnUpdateTrad">Update</button>
      </div>
      </form>
      <!-- FIN FORM MODIFICAR MARCAS EN BD -->
    <a class="btn btn-outline-dark mb-2" href="/productManagment/crudTrademarks"> <i class="fas fa-angle-double-left"></i> Trademark </a>

  </div>

  @endsection
