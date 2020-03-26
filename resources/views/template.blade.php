<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/styleHome.css">

  <link href="https://fonts.googleapis.com/css?family=Muli:400,700,800&display=swap" rel="stylesheet">
  <title> @yield('title') </title>
</head>
<body>

  <!-- NOTE: Inicia header -->
  <header>

    <!-- NOTE: Inicia header -->
    <script src="https://kit.fontawesome.com/46027ca747.js" crossorigin="anonymous"></script>
    <!-- NOTE: Nav sacado de bootstrap -->
    <nav class="navbar navbar-expand-md navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
      </button>
          <a class="navbar-brand" href="/homeHassen"> <img src="{{asset('/storage/imagenes/HassenAccesorios/logoWebBlack.png')}}" class="logo" alt="logo Hassen"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/homeHassen"> Home <span class="sr-only">(current)</span></a>
          </li>

          {{-- El metodo check() devuelve true o false dependiendo de si el user está logueado o no
          y el metodo user() me trae al usuario logueado en ese momento
          AMBOS LOS SACAMOS DE LA CLASE Auth--}}

          @if (!Auth::check())
            <li class="nav-item active">
              <a class="nav-link" href="/register">Register</a>
            </li>
          @endif
          @if (!Auth::check())
            <li class="nav-item active">
              <a class="nav-link" href="/login"> Login <span class="sr-only">(current)</span></a>
            </li>
          @endif
          @if (Auth::check() && Auth::user()->type == 1 && Auth::user()->status==1)
            <li class="nav-item active">
              <a class="nav-link" href="/productManagment/crudTrademarks"> Managment Product <span class="sr-only">(current)</span></a>
            </li>
          @endif
          <li class="nav-item active">
            <a class="nav-link" href="/myPurchase"> <i class="fas fa-cart-plus"></i> My purchase <span class="sr-only">(current)</span></a>
          </li>

          @if (Auth::check())
            <div class="dropdown show">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user() ->name }}
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/userProfile">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        @endif

        <li class="nav-item active">
          <a class="nav-link" href="/faq">F.A.Q.</a>
        </li>

      </ul>
    </div>
  </nav>
  <!-- NOTE: Fin nav -->
</header>
<!-- NOTE: fin header -->

@yield('userProfile')
@yield('home')
@yield('catalog')
@yield('faq')
@yield('login')
@yield('registration')
@yield('loadedProduct')
@yield('myPurchase')
@yield('crudTrademarks')
@yield('crudCategories')
@yield('crudCategoryTrademark')
@yield('crudProducts')

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
          <li><a class="nav-link active" href="#" data-toggle="modal" data-target="#formularioModal">Send us your questions</a>
            <!--- modal formulario --->
            <div class="modal fade" id="formularioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONSULT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="fomulario">
                      <div class="row">
                        <div class="row">
                          <div class="col-10"><input class="form-control" id="nombre" type="text" placeholder="Name" required="Campo Obligatorio"></div>
                          <div class="col-10"><input class="form-control" id="apellido" type="text" placeholder="Lastname" required="required"></div>
                          <div class="col-10"><input class="form-control" id="mail" type="email" placeholder="E-mail" required></div>
                          <div class="col-10"><input class="form-control" id="tel" type="text" placeholder="Phone"></div>
                          <div class="col-10"><textarea class="form-control" id="txt" rows="20" type="text" placeholder="Consult" required></textarea></div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Send Message</button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!--- fin modal formulario --->
          <!--- modal ubicacion -->
          <li>
            <a id="linkLocation" class="nav-link" href="#" data-toggle="modal" data-target="#ubicacion">Location</a>
            <div class="modal fade" id="ubicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LOCATION</h5>
                  </div>
                  <div class="modal-body">
                    <div id="ubicacion"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.947019831442!2d-68.84629968482672!3d-32.925997980927264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDU1JzMzLjYiUyA2OMKwNTAnMzguOCJX!5e0!3m2!1ses-419!2sar!4v1560388576285!5m2!1ses-419!2sar" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- fin modal ubicacion --->
          <li>
            <a class="nav-link" href="#" data-toggle="modal" data-target="#info">Info</a>
            <!-- modal info --->
            <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">INFO</h5>
                  </div>
                  <div class="modal-body">
                    <p id="datos">Opening hours: Monday - Friday from 8 to 18 h. Saturday from 8 to 14 h.</p>
                    <p id="datos">Phones: 0261-4525878 / 261-5789633</p>
                    <p id="datos">E-mail: consultas@tienda-online.com</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- finmodal info --->
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

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
