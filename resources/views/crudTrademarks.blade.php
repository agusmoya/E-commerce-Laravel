@extends('template')

@section('title')
  Hassen CRUD Trademarks - Online Store
@endsection

@section('crudTrademarks')
  <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
    <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">CRUD Trademark</li>
        <li class="breadcrumb-item"><a href="/productManagment/crudCategories">CRUD Category</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudCategoryTrademark">CRUD Trademark&Category</a></li>
        <li class="breadcrumb-item"><a href="/productManagment/crudProducts">CRUD Products</li>
          <li style="display:none" class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </nav>
    </div>


    <div class="container bg-light">
      <h1 class="text-center my-4 p-3" style="color:black;"><b>Trademarks management</b></h1>

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
        <h3 class="mt-4"> <b>Trademarks in the system:</b> </h3>
        <div class="table-responsive">
          <table id="trademark" class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col"> ID </th> <th scope="col">Name</th> <th scope="col">Created at</th>
                <th scope="col">Updated at</th> <th scope="col">Update</th> <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              @php
              $contador=0;
              @endphp
              @forelse ($arrayTrademarks as $trademark)
                @php
                $contador++;
                @endphp

                <tr class="text-center">
                  <th scope="row"> {{$contador}} </th> <td>{{$trademark->name}}</td> <td>{{$trademark->created_at}}</td> <td>{{$trademark->updated_at}}</td>
                  <td><button type="button" class="btn btn-link">
                    <a href="/productManagment/updateTrademark/{{$trademark->id}}" style="color:#12776f;font-size:1em;">
                      <i class="fas fa-pencil-alt" style="font-size:1.2em;"></i> Edit
                    </a></button> </td>
                    <td>
                      <form class="mb-0" name="formDeleteTrademark" action="/productManagment/deleteTrademark" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="trademark_id" value="{{$trademark->id}}">
                        <button id="btnDeleteTrademark" type="submit" class="btn btn-link"  style="color:#ff3434;font-size:1em;">
                          <i class="far fa-trash-alt" style="font-size:1.2em;"></i> Delete
                        </button>
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
                <small id="alertJsNameTrademark" class="form-text " style="color:red"></small>
                @error('name_trademark')
                  <small id="alert" class="form-text " style="color:red">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="form-group text-center text-dark">
                <button id="btnTrademark" type="submit" name="register_trademark" class="btn btn-lg btn-danger">Create Trademark</button>
              </div>
            </form>
          </div>

          <!-- FIN FORM CARGAR MARCA EN BD -->
          <!-- FIN FORMS MARCA -->

          <div class="form-group p-3 d-flex justify-content-between">
            <a class="btn btn-outline-dark mb-2" href="/homeHassen"> <i class="fas fa-angle-double-left"></i> Home </a>
            <a class="btn btn-outline-dark mb-2" href="/productManagment/crudCategories">Categories <i class="fas fa-angle-double-right"></i>
            </a>
          </div>
        </div>

      @endsection
