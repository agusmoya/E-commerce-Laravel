@extends('template')

@section('title') Hassen Managment Users - Online Store @endsection

  @section('managmentUsers')

    <nav id="breadcrumb" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Managment Users</a></li>
      </ol>
    </nav>

    <div class="container-fluid" style="background-color:white;">
      <h1 class="text-center my-4 p-5" style="color:black;"><b>Usuarios en el sistema:</b></h1>

      {{-- ARRAY DE ERRORES --}}
      <ul class="errors" style="color:red;">
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
      {{-- ARRAY DE ERRORES --}}

      <!-- INICIA FORMS MARCAS -->
      <!-- INICIA FORM CONSULTA MARCAS EN BD -->
      <div class="section">
        <div class="form-group">
          <h3 class="mt-4" style="color:black;"> <b>Detalles de usuarios:</b> </h3>
          <div class="table-responsive">

            <table class="table table-hover">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th scope="col">ID</th>
                  <th scope="col">Foto:</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Provincia</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Email</th>
                  <th scope="col">Fecha de Alta</th>
                  <th scope="col">Fecha de Modificacion</th>
                  <th scope="col">Provilegios</th>
                  <th scope="col">Eliminar</th>
                  <th scope="col">Estado</th>
                </tr>
              </thead>
              <tbody>
                @php
                $contador=1;
                @endphp
                @forelse ($arrayUsers as $user)

                  <tr class="text-center {{$user->status == 0 ? 'table-dark' :''}}">
                    <th class="align-middle" scope="row"> {{$contador++}} </th>
                    <td class="container-fluid" style="width:10%">
                    <img id="center" class="img-fluid card-img" src="{{asset('/storage/imagenes/imgUsers/'.$user->profilePhoto)}}" alt="profile-photo">
                    </td>
                    <td class="align-middle">{{$user->name}}</td>
                    <td class="align-middle">{{$user->surname}}</td>
                    <td class="align-middle">{{$user->province}}</td>
                    <td class="align-middle">{{$user->type == 1 ? 'Administrador' : 'Invitado'}}</td>
                    <td class="align-middle">{{$user->email}}</td>
                    <td class="align-middle">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                    <td class="align-middle">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y')}}</td>
                    <td class="align-middle">

                      <div class="dropdown">
                        <button class="btn btn-ligth dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i style="color:red" class="fas fa-cogs"></i> <b>Cambiar Privilegios</b>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">
                              <a class="dropdown-item btn btn-link btn-sm" href="/userProfile/updateUserProfile/{{$user->id}}"> <i class="fas fa-user-edit"></i> Editar Perfil</a>
                            </a>                              
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                                <form class="" action="/homeHassen/editUserStatus" method="post">
                                  @csrf
                                  <input type="hidden" name="userStatus" value="{{$user->status}}">
                                  <input type="hidden" name="userId" value="{{$user->id}}">
                                    <button style="color: #222831" type="submit" class="btn btn-link btn-sm"> <i class="fas fa-user-cog"></i> Activar/Desactivar </button>
                                  </form>
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                                <form class="" action="/homeHassen/editPrivileges" method="post">
                                  @csrf
                                  <input type="hidden" name="roleUser" value="1">
                                  <input type="hidden" name="userId" value="{{$user->id}}">
                                    <button style="color: #fa163f" type="submit" class="btn btn-link btn-sm"> <i class="fas fa-user-cog"></i> Administrador</button>
                                  </form>
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                                <form class="" action="/homeHassen/editPrivileges" method="post">
                                  @csrf
                                <input type="hidden" name="roleUser" value="0">
                                <input type="hidden" name="userId" value="{{$user->id}}">
                                  <button style="color: #018383" type="submit" class="btn btn-link btn-sm"> <i class="fas fa-user-shield"></i> Invitado</button>
                              </form>
                            </a>
                        </div>
                      </div>



                    </td>
                    <td class="align-middle">
                      <form class="" action="/managmentUsers/deleteUser/" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="userId" value="{{$user->id}}">
                        <button type="submit" class="btn btn-link btn-sm"> <i class="far fa-trash-alt"></i> <b>Eliminar</b> </button>
                      </form>
                    </td>
                    <td class="align-middle">{{$user->status == 1 ? 'Activo' :'Inactivo' }}</td>
                  </tr>
                @empty
                  <tr class="text-center">
                    <th scope="row"> ** </th> <td colspan="10"> <i>NO HAY USUARIOS EN SISTEMA...</i> </td>
                  </tr>
                @endforelse
              </tbody>
          </table>
          <div class="pagination justify-content-center">
            {{$arrayUsers->links()}}
          </div>
        </div>
        </div>

      </div>

      <div class="form-group p-3 text-right">
        <a class="btn btn-secondary" style="text-decoration: none;color:white;" href="/homeHassen"> <strong>Volver a Home</strong> </a>
      </div>
    </div>

    @endsection
