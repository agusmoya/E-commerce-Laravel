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
      <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark&Category</a></li>
      <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li>
      <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
    </ol>
  </nav>


  <div class="container" style="background-color:white;">
    <h1 class="text-center my-4 p-5" style="color:black;"><b>Trademarks management</b></h1>

    {{-- ARRAY DE ERRORES --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger mx-auto my-4"  style="width:80%;">
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

        <h3 class="mt-4" style="color:black;"> <b>Trademarks in the system:</b> </h3>
        <div class="table-responsive">

          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col"> ID </th> <th scope="col">Name</th> <th scope="col">Created at</th>
                <th scope="col">Updated at</th> <th scope="col">Update</th> <th scope="col">Delete</th>
              </tr>
              </thead>
              <tbody>
                @php
                $contador=1;
                @endphp
                @forelse ($arrayTrademarks as $trademark)
                  <tr class="text-center">
                    <th scope="row"> {{$contador++}} </th> <td>{{$trademark->name}}</td> <td>{{$trademark->created_at}}</td> <td>{{$trademark->updated_at}}</td>
                    <td> <button type="button" class="btn btn-link btn-sm"> <a href="/productManagment/updateTrademark/{{$trademark->id}}"> <i class="fas fa-pencil-alt"></i> <b>Edit</b> </a> </button> </td>
                    <td>
                      <form class="" name="formDeleteTrademark" action="/productManagment/deleteTrademark" method="post">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="trademark_id" value="{{$trademark->id}}">
                      <button id="btnDeleteTrademark" type="submit" class="btn btn-link btn-sm"> <i class="far fa-trash-alt"></i> <b>Delete</b> </button>
                    </form>
                  </td>
                  </tr>
                @empty
                  <tr class="text-center">
                    <th scope="row"> ** </th> <td colspan="5"> <i>NO TRADEMARKS LOADED IN SYSTEM...</i> </td>
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
          <p><i> If the Trademark is not among those listed in the table, <b>follow the steps below: </b></i></p>
          <p><i><b>1°)</b> Enter a name.</i></p>
          <p><i><b>2°)</b> Click the "Create Trademark" button.</i></p>
          <h4 class="mt-3">Load trademark:</h4>
          <label for="name_trademark">Enter a Trademark to load in the system: </label>
          <input name="name_trademark" type="text" class="form-control @error('name_trademark') is-invalid @enderror" id="name_trademark" placeholder="Trademark name..." value="{{old('name_trademark')}}" required>
            <small id="alertJsNameTrademark" class="form-text " style="color:red">
                  <strong></strong>
              </small>
          @error('name_trademark')
            <small id="alert" class="form-text " style="color:red">
                  <strong>{{ $message }}</strong>
              </small>
          @enderror
        </div>
        <button type="submit" name="register_trademark" class="btn btn-dark mb-3">Create Trademark</button>
      </form>
    </div>

      <!-- FIN FORM CARGAR MARCA EN BD -->
      <!-- FIN FORMS MARCA -->

      <div class="form-group p-3 text-right">
        <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/homeHassen"> <strong>Back Home</strong> </a>
        <a class="btn btn-danger" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Continue to Categories</strong> </a>
      </div>
    </div>

@endsection
