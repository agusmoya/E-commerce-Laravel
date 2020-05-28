@extends('template')

@section('title')
  Hassen CRUD Relationship Category/Trademarks - Online Store
@endsection

@section('crudCategoryTrademark')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudCategories">CRUD Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">CRUD Trademark&Category</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li>
          <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </nav>
    </div>

    <div class="container" style="background-color:white;">
      <h1 class="text-center my-4 p-3" style="color:black;"><b>Trademark-Category Relationship</b></h1>

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

      @if (session('status'))
        <div class="alert alert-warning m-auto text-center" style="width:80%;">
          {{ session('status') }}
        </div>
      @endif

      <!-- INICIA FORMS MARCAS -->
      <!-- INICIA FORM CONSULTA MARCAS EN BD -->
      <div class="section">
        <h3 class="mt-4" style="color:black;"> <b>Relationships in the system:</b> </h3>
        <div class="table-responsive">

          <table id="categoryTrademark" class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                {{-- <th scope="col">ID</th>  --}}
                <th scope="col">Trademark</th> <th scope="col">Category</th>
                <th scope="col">Created at</th> <th scope="col">Delete a relationship</th>
              </tr>
            </thead>
            <tbody>

              @forelse ($arrayCategoryTrademark as $categoryTrademark)
                <tr class="text-center">
                  {{-- <th scope="row"> {{$categoryTrademark->trademark_id}}/{{$categoryTrademark->category_id}} </th>  --}}
                  <td>{{$categoryTrademark->name_trademark}}</td> <td>{{$categoryTrademark->name_category}}</td> <td>{{$categoryTrademark->created_at}}</td>
                  <td> <form class="mb-0" action="/productManagment/deleteCategoryTrademark" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="trademark_id" value="{{$categoryTrademark->trademark_id}}">
                    <input type="hidden" name="category_id" value="{{$categoryTrademark->category_id}}">
                    <button type="submit" name="btnDeleteRelationship" class="btn btn-link" style="color:#ff3434;font-size:1em;">
                      <i class="far fa-trash-alt" style="font-size:1.2em;"></i> Delete
                    </button>
                  </form> </td>
                </tr>
              @empty
                <tr class="text-center">
                  <th scope="row"> ** </th> <td colspan="5"> <i>THERE ARE NO RELATIONSHIPS BETWEEN TRADEMARKS AND CATEGORIES UPLOADED IN THE SYSTEM...</i> </td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="pagination justify-content-center">
            {{$arrayCategoryTrademark->links()}}
          </div>
        </div>

        <!-- INICIA FORM RELACION CATEGORIA/MARCA EN BD -->
        <form class="show_categories_trademarks mb-0" action="/productManagment/createCategoryTrademark" method="post">
          @csrf
          <div id="listTrad" class="form-group">
            <h3 class="mt-4"> <b>List of Trademarks:</b> </h3>
            <label class="mt-3" for="selectTrademarks"><i>Trademarks loaded in the system:</i> </label>
            <select class="form-control @error('trademark_id') is-invalid @enderror" id="selectTrademarks" name="trademark_id">
              <option value="" selected>Select a Trademark...</option>
              @forelse ($arrayTrademarks as $trademark)
                <option value="{{$trademark->id}}"> {{ $trademark->name }} </option>
              @empty
                <option value="" selected>There are no trademarks loaded in the system!</option>
              @endforelse
            </select>
            @error('trademark_id')
              <small id="alert" class="form-text " style="color:red">
                {{ $message }}
              </small>
            @enderror
            <small id="alertJsSelectTrademark" class="form-text" style="color:red"></small>
          </div>

          <div id="listCat" class="form-group">
            <h3 class="mt-4"> <b>List of Categories:</b> </h3>
            <label class="mt-3" for="selectCategories"><i>Categories loaded into the system: </i></label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="selectCategories" name="category_id">
              <option value="" selected>Select a Category...</option>
              @forelse ($arrayCategories as $category)
                <option value="{{$category->id}}"> {{ $category->name }} </option>
              @empty
                <option value="" selected>There are no categories loaded in the system!</option>
              @endforelse
            </select>
            <span style="color: red;"class="help-block" id="error"><i></i></span>
            @error('category_id')
              <small id="alert" class="form-text " style="color:red">
                {{ $message }}
              </small>
            @enderror
            <small id="alertJsSelectCategory" class="form-text" style="color:red"></small>
          </div>
          <small id="alertEmptySubmit" class="form-text m-2 text-center" style="color:red"></small>
          <div class="form-group p-2 text-center text-dark">
            <button id="btnCatTrad" type="submit" name="registerCategoryTrademark" class="btn btn-lg btn-danger">Match Trademark to Category</button>
          </div>
        </form>
        <!-- FIN FORM RELACION CATEGORIA/MARCA EN BD -->
      </div>
      <div class="form-group p-3 text-dark d-flex justify-content-between">
        <a class="btn btn-outline-dark mb-2" href="/productManagment/crudCategories">
          <i class="fas fa-angle-double-left"></i> Categories
        </a>
        <a class="btn btn-outline-dark mb-2" href="/productManagment/crudProducts">
          Products <i class="fas fa-angle-double-right"></i>
        </a>
      </div>
    </div>
  @endsection
