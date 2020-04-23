@extends('template')

@section('title') Hassen Contact Us - Online Store @endsection

  @section('contactUs')
    <div class="container-fluid my-4">

      <div class="row">
        <div id="contact_info" class="col-xs-12 col-sm-6 col-md-8">
          <h2 class="mb-4">Contact Us <i class="far fa-comments"></i></h2>
          {{-- <p><b>Opening hours</b>: Monday - Friday from 8 to 18 h. Saturday from 8 to 14 h.</p> --}}
          <p><b>Follow us: </b></p>
          <p><a href="https://www.facebook.com/fb.me/hassenaccesorios" target="_blank"><i class="fab fa-facebook-square mr-1" style="font-size: 25px;"></i> Hassen - Accesorios</a>  </p>
          <p><a href="https://instagram.com/hassen_accesorios?igshid=12tcsxg35b87r" target="_blank"><i class="fab fa-instagram mr-1" style="font-size: 25px;"></i> hassen_accesorios</a>  </p>
          <p><a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter-square mr-1" style="font-size: 25px;" ></i> Twitter</a>  </p>
          <p><b><i class="fab fa-whatsapp"></i> Whatsapp: </b>  0261-4525878 / 261-5789633</p>
          <p><b><i class="far fa-envelope"></i> Mail:</b>  hassenaccesorios@gmail.com</p>

          <h3 class="mt-5"> <i class="fas fa-map-marker-alt"></i> Delivery location:</h3>
          <iframe class="mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.947019831442!2d-68.84629968482672!3d-32.925997980927264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDU1JzMzLjYiUyA2OMKwNTAnMzguOCJX!5e0!3m2!1ses-419!2sar!4v1560388576285!5m2!1ses-419!2sar"
          width="80%" height="300" frameborder="4" allowfullscreen></iframe>
        </div>

        <div class="col-xs-6 col-md-4" style="color:white">
          <h3 class="mt-5 text-center">Ask us <i class="far fa-paper-plane"></i></h3>
          <form>
            <div class="form-group">
              <label for="name">Name </label>
              <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
            <div class="form-group">
              <label for="name">Celphone (optional)</label>
              <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Message (optional)</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" style="background-color:#588da8;border-color: white" class="btn btn-primary btn-block">Send</button>
          </form>
        </div>
      </div>
      <div class="row">

      </div>

    </div>

  @endsection
