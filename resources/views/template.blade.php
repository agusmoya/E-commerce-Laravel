<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSRF Token para poder enviar DATA vía fetch-->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title> @yield('title') </title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- my CSS -->
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">

  <!-- CDN sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>

  <!-- NOTE: Inicia header principal-->
  <header>
    <nav class="navbar navbar-dark navbar-expand-md text-white text-uppercase align-items-center">
      <div class="container col-10 text-center my-2">
        <a class="navbar-brand mx-auto mx-sm-0 mr-sm-5" href="/homeHassen">
        <img class="logo img-fluid" width="230" height="auto" src="{{asset('/storage/imagenes/HassenAccesorios/logoWebBlack.png')}}" alt="logo Hassen">
        </a>
        <button class="navbar-toggler mx-auto mx-sm-0 ml-sm-auto" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu-principal">
          <ul class="navbar-nav ml-sm-auto mt-4 mt-md-0 align-items-center text-center">
              <li class="nav-item d-none d-lg-inline">
                  <a class="nav-link active" href="/homeHassen">
                    <i style="font-size: 1.3em;" class="fas fa-home"></i> Home
                  </a>
              </li>
            {{-- El metodo check() devuelve true o false dependiendo de si el user está logueado o no
            y el metodo user() me trae al usuario logueado en ese momento
            AMBOS LOS SACAMOS DE LA CLASE Auth--}}
            @if (!Auth::check())
              <li class="nav-item">
                  <a id="linksUser" class="nav-link active" href="/register"> Register </a>
              </li>
            @endif
            @if (!Auth::check())
              <li class="nav-item">
                  <a id="linksUser" class="nav-link active" href="/login"> Login </a>
              </li>
            @endif

          @if (Auth::check() && Auth::user()->type == 1 && Auth::user()->status == 1)
              <li class="nav-item">
                    <div class="dropdown show m-1">
                        <a class="btn btn-danger dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i style="font-size: 1.3em;" class="fas fa-tasks"></i> Managment
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="nav-link ml-3 text-dark" href="/productManagment/crudTrademarks">
                              <i style="font-size: 1.1em;" class="fas fa-plus-circle"></i> Products
                            </a>
                        <div class="dropdown-divider"></div>
                            <a class="nav-link ml-3 text-dark" href="/homeHassen/managmentUsers">
                              <i style="font-size: 1.1em;" class="fas fa-users-cog"></i></i> Users
                            </a>
                        </div>
                    </div>
              </li>
            @endif
            @if (Auth::check())
              <li class="nav-item">
                <div class="dropdown">
                  <a class="btn btn-outline-light dropdown-toggle m-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {!!Auth::check() && Auth::user()->type == 1 && Auth::user()->status == 1 ? '<i style="font-size: 1.3em;" class="fas fa-user-tag"></i>' : '<i style="font-size: 1.3em;" class="fas fa-user"></i>' !!}
                    {{ Auth::user()->name }}
                    {{-- <img id="center" class="rounded-circle" width="35" height="35" src="{{asset('/storage/imagenes/imgUsers/'. Auth::user()->profilePhoto)}}" alt="profile-photo"> --}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a id="linksUser" class="dropdown-item" href="/userProfile">Profile</a>

                    <div class="dropdown-divider"></div>
                    <a id="linksUser" style="color:black;" class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                  </form>
                </div>
              </div>
            </li>
          @endif
          <li class="nav-item linkMyPurchase" style="min-width:66px;">
            {{-- <a class="nav-link" href="/myPurchase"> <i class="fas fa-cart-plus"></i><span id="linkMyPurchase" > My purchase {{session('totalAmountCart') ? '('.session('totalAmountCart').')' : ''}}</span></a> --}}
              <a class="nav-link active align-middle" href="/myPurchase" id="linkMyPurchase">
                <i class="fas fa-cart-plus" style="font-size: 1.3em;"></i>
                  <span style="background: white; color:black; border-radius:50%; height: 25px;
                  width: 25px; border-radius: 50%; display: inline-block; align-items: center;">
                  {{session('totalAmountCart') ? session('totalAmountCart'): '0'}}
                 </span>
             </a>
         </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- NOTE: Inicia header secundario-->
  <nav class="navbar navbar-light bg-light navbar-expand-sm text-uppercase">
    <div class="container m-auto" style="width:80%">
      <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#subMenuHassen" aria-controls="subMenuHassen" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="subMenuHassen">
        <ul class="navbar-nav text-center mx-auto mt-3 mt-sm-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Catalog
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item font-weight-bold text-dark" href="/homeHassen/availableProducts"> See All </a>
              <div class="dropdown-divider"></div>
              @if (isset($arrayCategoriesWithoutRepeating))
                @forelse ($arrayCategoriesWithoutRepeating as $category)
                  <a class="dropdown-item" href="/homeHassen/availableCategory/{{$category->name_category}}">{{$category->name_category}}</a>
                  <div class="dropdown-divider"></div>
                @empty
                  <a class="dropdown-item"> {{"Sin productos disponibles!"}} </a>
                @endforelse
              @else
                <a class="dropdown-item"> {{"¡Sin productos disponibles!"}} </a>
              @endif
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Info & Help
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
            <a class="nav-link" href="{{route('contactUs')}}"> Contact </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</header>
<!-- NOTE: fin header -->
@yield('home')
  <div class="container-fluid" style="width:85%;">
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
    <div class="row text-center text-sm-left text-md-left">
      <div id="aboutUs" class="col-12 col-sm-4">
        <h5 class="text-center">About Us</h5>
        <ul class="list-unstyled text-center">
          <li><a href="/homeHassen"></i>Home</a></li>
          <li><a href="/homeHassen/availableProducts"></i>Catalog</a></li>
          <li><a href="/faq"></i>FAQ</a></li>
        </ul>
      </div>
      <div id="socNetworks" class="col-12 col-sm-4 mt-3 mt-sm-0">
        <h5 class="text-center">Social Networks</h5>
        <ul class="list-unstyled text-center">
          <li><a href="https://www.facebook.com/fb.me/hassenaccesorios" target="_blank"><i class="fab fa-facebook-square mr-2" style="font-size: 25px;"></i>Facebook</a></li>
          <li><a href="https://instagram.com/hassen_accesorios?igshid=12tcsxg35b87r" target="_blank"><i class="fab fa-instagram mr-2" style="font-size: 25px;"></i>Instagram</a></li>
          <li><a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter-square mr-2" style="font-size: 25px;" ></i>Twitter</a></li>
        </ul>
      </div>
      <div id="contactUs" class="col-12 col-sm-4 mt-3 mt-sm-0">
        <h5 class="text-center">Contact us</h5>
        <ul class="list-unstyled text-center">
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
<!-- Scripts -->
<script src="{{ asset('js/cartJs.js') }}" type="text/javascript"></script>
<!-- Iconos -->
<script src="https://kit.fontawesome.com/46027ca747.js" crossorigin="anonymous"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
