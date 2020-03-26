@extends('template')

@section('styleFaq')
  <link rel="stylesheet" href="{{asset('css/styleFaq.css')}}">
@endsection
@section('title') Hassen F.A.Q. - Online Store @endsection

@section('faq')
  <nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/homeHassen">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">F.A.Q.</li>
    </ol>
  </nav>

  <div class="container">
    <h1 class="mt-5 mb-4">Frequent questions</h1>
    <div class="row">
      <div class="col-12 col-md-10 col-lg-12">
        <ul>
          <li class="mb-4"><a href="#formasDePago"> ¿Que formas de pago aceptan? </a></li>
          <li class="mb-4"><a href="#enviosDomicilio"> ¿Hacen envíos a domicilio? </a></li>
          <li class="mb-4"><a href="#precioEnvío"> ¿Cuánto cuesta el envío? </a></li>
          <li class="mb-4"><a href="#recargoFinanciado"> ¿De cuanto es el recargo de compra financiada? </a></li>
          <li class="mb-4"><a href="#devoluciones"> ¿Los productos tienen devolución? </a></li>
        </ul>
        <div class="respuestas mt-5">
          <h3 id="formasDePago">¿Que formas de pago aceptan?</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente nobis temporibus possimus blanditiis commodi architecto expedita eos, voluptates voluptatum odit, similique culpa nulla voluptatem reprehenderit laboriosam pariatur harum nesciunt voluptate.</p>
          <h3 id="enviosDomicilio">¿Hacen envíos a domicilio?</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias autem, nobis consectetur amet, temporibus modi mollitia numquam praesentium perspiciatis quidem vero eos alias voluptatem repellat cupiditate quos possimus saepe quasi!</p>
          <h3 id="precioEnvío">¿Cuánto cuesta el envío?</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse doloribus accusamus dolorem, maxime corporis ipsam voluptas repellat officia quos distinctio illo sapiente eius aperiam reiciendis vel magni beatae, commodi ipsum.</p>
          <h3 id="recargoFinanciado">¿De cuanto es el recargo de compra financiada?</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus deserunt illum corrupti dolorum, porro nesciunt libero iure atque et aspernatur esse, dicta, odit excepturi suscipit! Earum dolores, totam debitis esse?</p>
          <h3 id="devoluciones">¿Los productos tienen devolución?</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione laborum similique doloribus, amet magnam, quae maiores adipisci, doloremque, nemo at provident! Mollitia numquam est non autem eligendi amet, dolore libero.</p>
        </div>
      </div>
    </div>
  </div>

@endsection
