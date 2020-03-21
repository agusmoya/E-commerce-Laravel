@extends('template')

@section('title')
  Hassen CRUD Products - Online Store
@endsection

@section('crudProducts')
  <div class="container my-5" style="background-color:white;">
    <h1 class="text-center py-4 " style="color:black;"><b>Actualizar Producto</b></h1>

    {{-- ARRAY DE ERRORES --}}
    <ul class="errors" style="color:red;">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    {{-- ARRAY DE ERRORES --}}
    <form class="update_product" action="/productManagment/updateProduct" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div class="form-group">
        <div class="col-md-3 m-auto">
          <img src="{{asset('/storage/imagenes/imgProductos/'.$product->photo)}}" class="card-img" alt="presentacionProducto">
        </div>
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el nombre: </i></label>
        <input name="name_product" type="text" class="form-control" id="exampleFormControlInput1" value="{{$product->name}}">
        <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el precio: </i></label>
        <input name="price" type="text" class="form-control" id="exampleFormControlInput1" value="{{$product->price}}">
        <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese descripción: </i></label>
        <input name="description" type="text" class="form-control" id="exampleFormControlInput1" value="{{$product->description}}">
        <label for="exampleFormControlInput1" class="mt-3"><i> Ingrese el stock disponible: </i></label>
        <input name="stock" type="text" class="form-control" id="exampleFormControlInput1" value="{{$product->stock}}">
      </div>
      <!-- CARGAR IMAGEN -->
      <div class="form-group">
        <label for="exampleFormControlFile1"><i> Elija una imagen para el producto: </i></label>
        <input name="photo" type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
      <!-- FIN CARGAR IMAGEN -->
      <div class="form-group text-center">
        <button type="submit" name="register_producto" class="btn btn-danger btn-lg mt-4 mb-5">Actualizar Producto</button>
      </div>
      <a class="btn btn-dark mb-2" style="text-decoration: none;color:white;" href="/productManagment/crudCategories"> <strong>Volver a Categoría</strong> </a>
    </form>

  </div>
@endsection
