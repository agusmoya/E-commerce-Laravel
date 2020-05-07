@extends('template')

@section('title')
  Hassen CRUD Relationship Category/Trademarks - Online Store
@endsection

@section('crudCategoryTrademark')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudTrademarks">CRUD Trademark</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudCategories">CRUD Category</a></li>
      <li class="breadcrumb-item active" aria-current="page">CRUD Trademark&Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li>
        <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
    </ol>
  </nav>

  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5" style="color:black;"><b>Trademark/Category Relationship</b></h1>

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
      <div class="form-group">
        <h3 class="mt-4" style="color:black;"> <b>Trademark/Category Relationships in the system:</b> </h3>
        <div class="table-responsive">

          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col">ID</th> <th scope="col">Trademark</th> <th scope="col">Category</th>
                <th scope="col">Created at</th> <th scope="col">Delete a relationship</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=1;
              @endphp
              @forelse ($arrayCategoryTrademark as $categoryTrademark)
                <tr class="text-center">
                  <th scope="row"> {{$contador++}} </th> <td>{{$categoryTrademark->name_trademark}}</td> <td>{{$categoryTrademark->name_category}}</td> <td>{{$categoryTrademark->created_at}}</td>
                  <td> <form class="" action="/productManagment/deleteCategoryTrademark" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="trademark_id" value="{{$categoryTrademark->trademark_id}}">
                    <input type="hidden" name="category_id" value="{{$categoryTrademark->category_id}}">
                    <button type="submit" name="btnDeleteRelationship" class="btn btn-link"> <i class="far fa-trash-alt"> </i> Delete </button>
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
      </div>

      <!-- INICIA FORM RELACION CATEGORIA/MARCA EN BD -->
      <form class="show_categories_trademarks" action="/productManagment/createCategoryTrademark" method="post">
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
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsSelectTrademark" class="form-text" style="color:red">
              <strong></strong>
          </small>
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
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
          <small id="alertJsSelectCategory" class="form-text" style="color:red">
                <strong></strong>
            </small>
        </div>
          <small id="alertEmptySubmit" class="form-text m-2" style="color:red">
            <strong></strong>
          </small>
          <button type="submit" name="registerCategoryTrademark" class="btn btn-dark mb-3">Match Trademark to Category</button>
      </form>
      <!-- FIN FORM RELACION CATEGORIA/MARCA EN BD -->
    </div>
    <div class="form-group p-3 text-right">
      <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/productManagment/crudCategories">
        <strong>Back to Categories</strong>
      </a>
      <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudProducts">
        <strong>Continue to Products</strong>
      </a>
    </div>
  </div>
@endsection
