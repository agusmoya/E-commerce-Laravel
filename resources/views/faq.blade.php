@extends('template')

@section('styleFaq')
  <link rel="stylesheet" href="{{asset('css/styleFaq.css')}}">
@endsection
@section('title') Hassen F.A.Q. - Online Store @endsection

  @section('faq')
    <div class="d-flex justify-content-between flex-column flex-md-row align-items-center mt-5 mt-sm-3">
      <nav id="breadcrumb" class="mr-auto" aria-label="breadcrumb" style="font-size:1em;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">F.A.Q.</li>
      </ol>
    </nav>
  </div>
    <div class="container mb-5 pb-5">
      <h1 class="my-4 text-light"> Frequent questions</h1>
      <div class="row">
        <div id="preguntas" class="col-12 col-md-10 col-lg-12">
          <ul class="pl-2" id="listPreguntas">
            <li class="mb-4"><i class="far fa-comment" style="font-size: 20px"></i></i></i>
              <a href="#formasDePago"> What are the payment methods? </a>
            </li>
            <li class="mb-4"><i class="far fa-comment" style="font-size: 20px"></i></i></i>
              <a href="#enviosDomicilio"> Shipments are made at home? </a>
            </li>
            <li class="mb-4"><i class="far fa-comment" style="font-size: 20px"></i></i></i>
              <a href="#precioEnvío"> How much is the shipping? </a>
            </li>
            <li class="mb-4"><i class="far fa-comment" style="font-size: 20px"></i></i></i>
              <a href="#recargoFinanciado"> How much is the purchase surcharge financed? </a>
            </li>
            <li class="mb-4"><i class="far fa-comment" style="font-size: 20px"></i></i></i>
              <a href="#devoluciones"> Do the products have a return? </a>
            </li>
          </ul>
          <div class="respuestas mt-5 text-light">
            <h4 id="formasDePago"> <b>¿What are the payment methods?</b> </h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h4 id="enviosDomicilio"> <b>¿Shipments are made at home?</b> </h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h4 id="precioEnvío"> <b>¿How much is the shipping?</b> </h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h4 id="recargoFinanciado"> <b>¿How much is the purchase surcharge financed?</b> </h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h4 id="devoluciones"> <b>¿Do the products have a return?</b> </h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
        </div>
      </div>
    </div>

  @endsection
