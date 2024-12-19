@extends('wallet::layouts.master')

@section('content')
<script src="{!! secure_asset('vendor/webauthn/webauthn.js') !!}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<div class="row justify-content-center">
    <div class="col-xs-12 col-md-6 col-md-offset-3 col-md-offset-3-right  ">
      <div class="card">
        <div class="card-header">{{ trans('webauthn::messages.auth.title') }}</div>

        <div class="card-body">
          <div class="alert alert-danger d-none" role="alert" id="error"></div>
          <div class="alert alert-success d-none" role="alert" id="success">
            {{ trans('webauthn::messages.success') }}
          </div>

          <h3 class="card-title">
            {{ trans('webauthn::messages.insertKey') }}
          </h3>

          <p class="card-text text-center">
            <img src="https://ssl.gstatic.com/accounts/strongauth/Challenge_2SV-Gnubby_graphic.png" alt=""/>
          </p>

          <p class="card-text">
            {{ trans('webauthn::messages.buttonAdvise') }}
            <br />
            {{ trans('webauthn::messages.noButtonAdvise') }}
          </p>

          <a href="/" class="card-link" aria-pressed="true">{{ trans('webauthn::messages.cancel') }}</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    var publicKey = {!! json_encode($publicKey) !!};

    var errors = {
      key_already_used: "{{ trans('webauthn::errors.key_already_used') }}",
      key_not_allowed: "{{ trans('webauthn::errors.key_not_allowed') }}",
      not_secured: "{{ trans('webauthn::errors.not_secured') }}",
      not_supported: "{{ trans('webauthn::errors.not_supported') }}",
    };

    function errorMessage(name, message) {
      switch (name) {
      case 'InvalidStateError':
        return errors.key_already_used;
      case 'NotAllowedError':
        return errors.key_not_allowed;
      default:
        return message;
      }
    }

    function error(message) {
      $('#error').text(message).removeClass('d-none');
    }

    var webauthn = new WebAuthn((name, message) => {
       error(errorMessage(name, message));
    });

    if (! webauthn.webAuthnSupport()) {
      switch (webauthn.notSupportedMessage()) {
        case 'not_secured':
          error(errors.not_secured);
          break;
        case 'not_supported':
          error(errors.not_supported);
          break;
      }
    }

    webauthn.sign(
      publicKey,
      function (data) {
        $('#success').removeClass('d-none');
        axios.post("{{ route('wallet.webautn.checkvar') }}", data)
          .then(function (response) {
            if (response.data.callback) {
              window.location.href = response.data.callback;
              console.log(response.data.callback);
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    );
  </script>
@endsection
