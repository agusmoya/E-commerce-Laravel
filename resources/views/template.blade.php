<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  {{-- Necesario para poder enviar DATA vía fetch --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- my CSS -->
  <link rel="stylesheet" href="/css/styleHome.css">

  <!-- CDN sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
  <script src="{{ asset('js/cartJs.js') }}" type="text/javascript"></script>
  <link href="https://fonts.googleapis.com/css?family=Muli:400,700,800&display=swap" rel="stylesheet">
  <title> @yield('title') </title>
</head>
<body>

  <!-- NOTE: Inicia header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid mx-auto my-2" style="width: 70%">
        <a class="navbar m-auto m-5" href="/homeHassen"> <img class="img-fluid card-img logo" src="{{asset('/storage/imagenes/HassenAccesorios/logoWebBlack.png')}}" alt="logo Hassen"></a>
          <button class="navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div style="min-width: 500px;" class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto text-center">
          <li class="nav-item active">
            <a class="nav-link" href="/homeHassen"> <i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
          </li>
          {{-- El metodo check() devuelve true o false dependiendo de si el user está logueado o no
          y el metodo user() me trae al usuario logueado en ese momento
          AMBOS LOS SACAMOS DE LA CLASE Auth--}}
          @if (!Auth::check())
            <li class="nav-item active">
              <a id="linksUser" class="nav-link" href="/register">Register</a>
            </li>
          @endif
          @if (!Auth::check())
            <li class="nav-item active">
              <a id="linksUser" class="nav-link" href="/login"> Login <span class="sr-only">(current)</span></a>
            </li>
          @endif
          <li class="nav-item active linkMyPurchase">
            {{-- <a class="nav-link" href="/myPurchase"> <i class="fas fa-cart-plus"></i><span id="linkMyPurchase" > My purchase {{session('totalAmountCart') ? '('.session('totalAmountCart').')' : ''}}</span></a> --}}
            <a style="align-items: center;" class="d-flex nav-link text-center align-middle" href="/myPurchase" id="linkMyPurchase"> <i class="fas fa-cart-plus"> </i>
              <span style="background: white; color:black; border-radius:50%; height: 25px;
              width: 25px;
              border-radius: 50%;
              display: inline-block;
              align-items: center;">
               {{session('totalAmountCart') ? session('totalAmountCart'): '0'}}
              </span>
            </a>
          </li>

        @if (Auth::check() && Auth::user()->type == 1 && Auth::user()->status == 1)
          <li class="nav-item active">
            <div class="dropdown show mx-1 my-1">

              <a class="btn btn-danger dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks"></i> Managment </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a style="color:black;" class="nav-link ml-3" href="/productManagment/crudTrademarks"> <i class="fas fa-plus-circle"></i> Products <span class="sr-only">(current)</span></a>
                <div class="dropdown-divider"></div>
                <a style="color:black;" class="nav-link ml-3" href="/homeHassen/managmentUsers"> <i class="fas fa-users-cog"></i></i> Users <span class="sr-only">(current)</span></a>
              </div>
            </div>
          </li>
        @endif
        @if (Auth::check())
          <li class="nav-item active">
          <div class="dropdown">

            <a style="max-width:170px; min-width:170px" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {!!Auth::check() && Auth::user()->type == 1 && Auth::user()->status == 1 ? '<i class="fas fa-user-tag"></i>' : '<i class="fas fa-user"></i>' !!}
              {{ Auth::user() ->name }}
              <img id="center" class="rounded-circle" style="max-width:30%" src="{{asset('/storage/imagenes/imgUsers/'. Auth::user()->profilePhoto)}}" alt="profile-photo">
            </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a id="linksUser" style="color:black;" class="dropdown-item" href="/userProfile">Profile</a>

                  <div class="dropdown-divider"></div>
                  <a id="linksUser" style="color:black;" class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
        </li>
      @endif
        </ul>
      </div>
    </div>
  </nav>
  <!-- NOTE: Fin nav -->

  <nav class="navbar navbar-light bg-light navbar-expand-sm">
      <div class="container-fluid m-auto" style="width: 80%">
        <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#subMenuHassen" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
              <div class="collapse navbar-collapse" id="subMenuHassen">
                      <ul class="navbar-nav m-auto">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b style="color:black;">Catalog</b>
                              </a>
                              <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/homeHassen/availableProducts"><strong>Products</strong></a>
                                <div class="dropdown-divider"></div>
                                @if (isset($arrayCategoriesWithoutRepeating))
                                  @forelse ($arrayCategoriesWithoutRepeating as $category)
                                    <a class="dropdown-item" href="/homeHassen/availableCategory/{{$category->name_category}}">{{$category->name_category}}</a>
                                    <div class="dropdown-divider"></div>
                                  @empty
                                    <a class="dropdown-item">{{"Sin productos disponibles!"}} </a>
                                  @endforelse
                                @else
                                  <a class="dropdown-item">{{"¡Sin productos disponibles!"}} </a>
                                @endif
                              </div>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b style="color:black;">Info & Help</b>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('accesoriesCare')}}"> Accessories Care </a>
                                {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item"> Shipments </a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/faq"> F.A.Q. </a>
                              </div>
                            </li>
                            <li class="nav-item active">
                              <a class="nav-link" href="{{route('contactUs')}}"><b style="color:black;">Contact</b> <span class="sr-only">(current)</span></a>
                            </li>
                      </ul>
              </div>
      </div>
</nav>

</header>
<!-- NOTE: fin header -->
@yield('home')
<div class="container-fluid">
@yield('verifyEmail')
@yield('managmentUsers')
@yield('userProfile')
@yield('availableCategory')
@yield('catalog')
@yield('accesoriesCare')
@yield('faq')
@yield('contactUs')
@yield('loadedProduct')
@yield('myPurchase')
@yield('crudTrademarks')
@yield('crudCategories')
@yield('crudCategoryTrademark')
@yield('crudProducts')
@yield('loginLaravel')
@yield('registerLaravel')
</div>
<!-- NOTE: inicia footer -->
<footer id="footer" class="mt-5 p-4">

  <div class="container">
    <div class="row text-center text-xs-center text-sm-left text-md-left">
      <div id="aboutUs" class="col-12 col-sm-4 col-md-4">
        <h5>About Us</h5>
        <ul class="list-unstyled quick-links">
          <li><a href="/homeHassen"></i>Home</a></li>
          <li><a href="/homeHassen/availableProducts"></i>Catalog</a></li>
          <li><a href="/faq"></i>FAQ</a></li>
        </ul>
      </div>
      <div id="socNetworks" class="col-12 col-sm-4 col-md-4">
        <h5>Social Networks</h5>
        <ul class="list-unstyled quick-links">
          <li><a href="https://www.facebook.com/fb.me/hassenaccesorios" target="_blank"><i class="fab fa-facebook-square mr-1" style="font-size: 25px;"></i>Facebook</a></li>
          <li><a href="https://instagram.com/hassen_accesorios?igshid=12tcsxg35b87r" target="_blank"><i class="fab fa-instagram mr-1" style="font-size: 25px;"></i>Instagram</a></li>
          <li><a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter-square mr-1" style="font-size: 25px;" ></i>Twitter</a></li>
        </ul>
      </div>
      <div id="contactUs" class="col-12 col-sm-4 col-md-4">
        <h5>Contact us</h5>
        <ul class="list-unstyled quick-links">
            <li>
              <a class="nav-link" href="{{route('accesoriesCare')}}">Info & Help</a>
            </li>
            <li>
            <a class="nav-link" href="{{route('contactUs')}}"><b>Contact</b> <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </div>

    <div id="firma" class="row mt-5">
      <div class="col-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center">
        <p><a href="https://www.digitalhouse.com/"><i>Digital House</i></a> - Mendoza, Argentina.</p>
        <p class="h6">&copy All right Reversed.<a class="text-blue ml-2" href="#" target="_blank"><i>Luis Romano - Agustín Moya</i></a></p>
      </div>

    </div>
  </div>

</footer>
<!-- NOTE: fin footer -->
<script type="text/javascript" src="/js/paisesAPI.js"></script>
<script src="https://kit.fontawesome.com/46027ca747.js" crossorigin="anonymous"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
