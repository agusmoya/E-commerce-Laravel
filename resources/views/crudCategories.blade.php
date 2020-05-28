@extends('template')

@section('title')
  Hassen CRUD Categories - Online Store
@endsection

@section('crudCategories')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
  <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
      <li class="breadcrumb-item active" aria-current="page">CRUD Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark&Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li>
        <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
      </ol>
    </nav>
  </div>
    <div class="container" style="background-color:white;">
      <h1 class="text-center my-4 p-3" style="color:black;"><b>Categories management</b></h1>
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
      <div class="section">
        <h3 class="mt-4" style="color:black;"> <b>Categories in the system:</b> </h3>
        <div class="table-responsive">
          <table id="categories" class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col">ID</th> <th scope="col">Name</th> <th scope="col">Created at</th> <th scope="col">Updated at</th> <th scope="col">Update</th> <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>

              @forelse ($arrayCategories as $category)
                <tr class="text-center">
                  <th scope="row"> {{$category->id}} </th> <td>{{$category->name}}</td> <td>{{$category->created_at}}</td> <td>{{$category->updated_at}}</td>
                  <td>
                    <button type="button" class="btn btn-link">
                      <a href="/productManagment/updateCategory/{{$category->id}}" style="color:#12776f;font-size:1em;">
                        <i class="fas fa-pencil-alt" style="font-size:1.2em;"></i> Edit
                      </a>
                      </button> </td>
                    <td>
                      <form class="mb-0" action="/productManagment/deleteCategory" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <button id="btnDeleteCategory" type="submit" class="btn btn-link" style="color:#ff3434;font-size:1em;">
                          <i class="far fa-trash-alt" style="font-size:1.2em;"></i> Delete
                        </button>
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

          <!-- INICIA FORM CARGAR MARCA EN BD -->
          <form class="create_category mb-0" action="/productManagment/createCategory" method="post">
            @csrf
            <div class="form-group">
              <p><i> If the category is not among those listed in the table <b>follow the steps below: </b></i></p>
              <p><i><b>1°)</b> Enter a name.</i></p>
              <p><i><b>2°)</b> Click the "Create Category" button.</i></p>
              <h4 class="mt-3">Load Category:</h4>
              <label for="name_category">Enter a Category to load in the system: </label>
              <input name="name_category" type="text" class="form-control @error('name_category') is-invalid @enderror" id="name_category" placeholder="Category name..." value="{{old('name_category')}}">
                <small id="alertJsNameCategory" class="form-text " style="color:red">

                </small>
                @error('name_category')
                  <small id="alert" class="form-text " style="color:red">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="form-group text-center text-dark">
                <button id="btnCategory" type="submit" name="register_category" class="btn btn-lg btn-danger">Create Category</button>
              </div>
            </form>
            <!-- FIN FORMS CATEGORY -->
            <div class="form-group p-3 d-flex justify-content-between">
              <a class="btn btn-outline-dark m-1" href="/productManagment/crudTrademarks">
                <i class="fas fa-angle-double-left"></i> Trademarks </a>
              <a class="btn btn-outline-dark m-1" href="/productManagment/crudCategoryTrademark">
                  Trademark-Category Relationship <i class="fas fa-angle-double-right"></i></a>
            </div>
          </div>
        @endsection
