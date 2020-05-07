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
      <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark&Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li>
      <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
    </ol>
  </nav>

  <div class="container" style="background-color:white;">

    <h1 class="text-center my-4 p-5" style="color:black;"><b>Categories management</b></h1>

    {{-- ARRAY DE ERRORES --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger mx-auto my-4" style="width:80%;">
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
        <h3 class="mt-4" style="color:black;"> <b>Categories in the system:</b> </h3>
        <div class="table-responsive">

          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col">ID</th> <th scope="col">Name</th> <th scope="col">Created at</th> <th scope="col">Updated at</th> <th scope="col">Update</th> <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=1;
              @endphp
              @forelse ($arrayCategories as $category)
                <tr class="text-center">
                  <th scope="row"> {{$contador++}} </th> <td>{{$category->name}}</td> <td>{{$category->created_at}}</td> <td>{{$category->updated_at}}</td>
                  <td>
                    <button type="button" class="btn btn-link"> <a href="/productManagment/updateCategory/{{$category->id}}"> <i class="fas fa-pencil-alt"></i> Edit </a> </button> </td>
                  <td>
                    <form class="" action="/productManagment/deleteCategory" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="category_id" value="{{$category->id}}">
                    <button id="btnDeleteCategory" type="submit" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Delete </button>
                  </form> </td>
                </tr>
              @empty
                <tr class="text-center">
                  <th scope="row"> ** </th> <td colspan="6"> <i>NO CATEGORIES LOADED IN SYSTEM...</i> </td>
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
        <p><i> If the category is not among those listed in the table <b>follow the steps below: </b></i></p>
        <p><i><b>1°)</b> Enter a name.</i></p>
        <p><i><b>2°)</b> Click the "Create Category" button.</i></p>
        <h4 class="mt-3">Load Category:</h4>
        <label for="name_category">Enter a Category to load in the system: </label>
        <input name="name_category" type="text" class="form-control @error('name_category') is-invalid @enderror" id="name_category" placeholder="Category name..." value="{{old('name_category')}}">
          <small id="alertJsNameCategory" class="form-text " style="color:red">
                <strong></strong>
            </small>
          @error('name_category')
            <small id="alert" class="form-text " style="color:red">
                  <strong>{{ $message }}</strong>
            </small>
          @enderror
      </div>
      <button type="submit" name="register_category" class="btn btn-dark mb-3">Create Category</button>
    </form>
    <!-- FIN FORM CARGAR CATEGORY EN BD -->
    <!-- FIN FORMS CATEGORY -->
    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/productManagment/crudTrademarks"> <strong>Back to Trademarks</strong> </a>
      <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudCategoryTrademark"> <strong>Continue to Trademark/Category Relationship</strong> </a>
    </div>
  </div>

@endsection
