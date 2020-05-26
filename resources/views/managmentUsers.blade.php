@extends('template')

@section('title') Hassen Managment Users - Online Store @endsection

  @section('managmentUsers')
    <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
      <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Managment Users</a></li>
        </ol>
      </nav>
    </div>

    <div class="container-fluid" style="background-color:white;">
      <h1 class="text-center my-4 p-5" style="color:black;"><b>Users in the system:</b></h1>
      <div class="section">
        <div class="form-group">
          <h3 class="mt-4" style="color:black;"> <b>Users details:</b> </h3>
          <div class="table-responsive">
            <table id="tableManagementUsers" class="table table-hover">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th scope="col">N°</th>
                  <th scope="col">ID</th>
                  <th scope="col">Photo</th>
                  <th scope="col">Name</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Province</th>
                  <th scope="col">Role</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created at</th>
                  <th scope="col">Updated at</th>
                  <th scope="col">State</th>
                  <th scope="col">Privileges</th>
                </tr>
              </thead>
              <tbody>
                @php
                $contador=1;
                @endphp
                @forelse ($arrayUsers as $user)
                  <tr class="text-center {{$user->status == 0 ? 'table-dark' :''}}">
                    <th class="align-middle" scope="row"> {{$contador++}} </th>
                    <td class="align-middle">{{$user->id}}</td>
                    <td class="align-middle">
                      <img id="center" style="min-width:160px; max-width:160px;" class="img-fluid card-img" src="{{asset('/storage/imagenes/imgUsers/'.$user->profilePhoto)}}" alt="profile-photo">
                    </td>
                    <td class="align-middle">{{$user->name}}</td>
                    <td class="align-middle">{{$user->surname}}</td>
                    <td class="align-middle">{{$user->province}}</td>
                    <td class="align-middle">{{$user->role == 1 ? 'Administrador' : 'Invitado'}}</td>
                    <td class="align-middle">{{$user->email}}</td>
                    <td class="align-middle">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                    <td class="align-middle">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y')}}</td>
                    <td class="align-middle">{{$user->status == 1 ? 'Activo' :'Inactivo' }}</td>

                    <td class="align-middle">
                      <div class="dropdown">
                        <button class="btn btn-ligth dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i style="color:#d63447;font-size:1.3em;" class="fas fa-cogs"></i> <b>Change Privileges</b>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">
                            <form class="" action="/homeHassen/editUserStatus" method="post">
                              @csrf
                              <input type="hidden" name="userStatus" value="{{$user->status}}">
                              <input type="hidden" name="userId" value="{{$user->id}}">
                              <button style="color: #222831" type="submit" class="btn btn-link btn-sm"> <i class="fas fa-user-cog"></i> Active/Inactive </button>
                            </form>
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">
                            <form class="" action="/homeHassen/editPrivileges" method="post">
                              @csrf
                              <input type="hidden" name="roleUser" value="1">
                              <input type="hidden" name="userId" value="{{$user->id}}">
                              <button style="color: #d63447" type="submit" class="btn btn-link btn-sm"> <i class="fas fa-user-cog"></i> Admin </button>
                            </form>
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">
                            <form class="" action="/homeHassen/editPrivileges" method="post">
                              @csrf
                              <input type="hidden" name="roleUser" value="0">
                              <input type="hidden" name="userId" value="{{$user->id}}">
                              <button style="color: #018383" type="submit" class="btn btn-link btn-sm"> <i class="fas fa-user-shield"></i> Guest </button>
                            </form>
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="text-center">
                    <th scope="row"> ** </th> <td colspan="10"> <i>There are not users in the system...</i> </td>
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

      <div class="form-group p-3 text-left">
        <a class="btn btn-outline-dark" href="/homeHassen"> <i class="fas fa-angle-double-left"></i> Home </a>
      </div>
    </div>

  @endsection
