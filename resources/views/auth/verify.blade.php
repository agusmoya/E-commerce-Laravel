{{-- @extends('layouts.app') --}}
@extends('template')

@section('verifyEmail')
<div id="verify" class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 my-3">
          <h3 class=" text-center my-5">Last Step, you almost ready...</h3>
            <div class="card">
                <div class="card-header" style="font-size:1vw;font-weight:bold;">{{ __('Verify Your Email Address...') }} <i class="fas fa-user-check" style="font-size:1.5vw;color:#1089ff;"></i></div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <span display="inline">
                      <i class="fas fa-quote-right" style="font-size:1.5vw;color:#5d5b6a;"></i>
                      {{ __('Before proceeding, please check your email for a verification link.') }}
                      {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                      <i class="fas fa-quote-left" style="font-size:1.5vw;color:#5d5b6a;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
