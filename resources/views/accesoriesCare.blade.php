@extends('template')

@section('title') Hassen Accesories Care - Online Store @endsection

  @section('accesoriesCare')
    <div class="d-flex justify-content-between flex-column flex-md-row mt-5 mt-sm-3">
      <nav id="breadcrumb" aria-label="breadcrumb" style="font-size:1em;">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"> Accesories Care</li>
        </ol>
      </nav>
    </div>

    <h2 class="text-center my-5 text-light font-weight-bold">Take care of your hassen <i class="fas fa-hand-sparkles"></i></h2>
    <div id="care" class="container-fluid mb-5 pb-5" style="color: white; width: 70%">
      <p> <i class="fas fa-exclamation"></i> Every <b>HASSEN</b> product is designed and created with love, so it deserves to be taken care of.</p>
      <p class="mt-4"> <i class="fas fa-exclamation"></i> After using them, we can use our ecological bags to preserve them and that they do not get tanned.</p>
      <p class="mt-4"> <i class="fas fa-exclamation"></i> Avoid getting wet. If they get wet, be sure to dry them quickly to prevent rust.</p>
      <p class="mt-4"> <i class="fas fa-exclamation"></i> Do not expose your accessories to extreme temperatures.</p>
      <p class="mt-4"> <i class="fas fa-exclamation"></i> We recommend that you put on your accessories a while after having had contact with substances such as: chlorine from the sink, sea water, beauty products, perfumes or lotions, to avoid wear and tear.</p>
      <p class="mt-4"> <i class="fas fa-exclamation"></i> Products made from natural stones are unique and differ in size and shape. We suggest special care when handling them as they are very sensitive to knocks or falls.</p>
    </div>
@endsection
