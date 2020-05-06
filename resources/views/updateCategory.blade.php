@extends('template')

@section('title')
  Hassen CRUD Categories - Online Store
@endsection

@section('crudCategories')
  <div class="container my-5" style="background-color:white;">
    <h1 class="text-center my-3 py-3" style="color:black;"><b>Update Category</b></h1>

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

    <!-- INICIA FORM Category -->
    <!-- INICIA FORM CONSULTA Category EN BD -->
    <form class="update_category" action="/productManagment/updateCategory" method="post">
      @csrf
      @method('put')
      <div class="form-group mb-4 text-center">
        <h5 style="color:black;">Enter a new name for the category:</h5>
        <div class="input-group">
          <input type="hidden" name="category_id" value="{{$category->id}}">
          <input id="name_category" type="text" class="col-8 m-auto form-control @error('name_category') is-invalid @enderror" name="name_category" value="{{$category->name}}" aria-describedby="button-addon2">
        </div>
        <small id="alertJsNameCategory" class="text-center form-text" style="color:red">
              <strong></strong>
          </small>
        </div>
          <button name="register_category" class="btn btn-dark btn-block col-4 m-auto" type="submit" id="button-addon2">Update</button>
      </form>
      <!-- FIN FORM MODIFICAR CATEGORIES EN BD -->
    <a class="btn btn-secondary mb-2" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Volver a Categoría</strong> </a>

  </div>
  @endsection
