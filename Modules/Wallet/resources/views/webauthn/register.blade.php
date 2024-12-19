@extends('wallet::layouts.master')

@section('content')
<script src="{!! secure_asset('vendor/webauthn/webauthn.js') !!}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<main class="py-4">
    <form id="form">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xs-12 col-md-6">
            <div class="card">
              <div class="card-header">Đăng ký OTPless+</div>

              <div class="card-body">
                <div class="alert alert-danger d-none" role="alert" id="error"></div>
                <div class="alert alert-success d-none" role="alert" id="success">
                  {{ trans('webauthn::messages.success') }}
                </div>

                <h3 class="card-title">
                Cắm khóa bảo mật của bạn hoặc sử dụng điện thoại & windows hello để đăng ký OTPless+
                </h3>

                <p class="card-text">
                  <input type="hidden" id="name" placeholder="{{ trans('webauthn::messages.key_name') }}" value="{{ Auth::user()->full_name }}" />
                </p>

                <p class="card-text text-center">
                  <img src="https://ssl.gstatic.com/accounts/strongauth/Challenge_2SV-Gnubby_graphic.png" alt=""/>
                </p>

                <p class="card-text">
                  {{ trans('webauthn::messages.buttonAdvise') }}
                  <br />
                  {{ trans('webauthn::messages.noButtonAdvise') }}
                </p>

                <button type="submit" class="btn btn-primary" aria-pressed="true">{{ trans('webauthn::messages.submit') }}</button>
                <a href="{{ route('wallet.profile') }}" class="card-link ms-3" aria-pressed="true">{{ trans('webauthn::messages.cancel') }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </main>
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

    function start() {
      webauthn.register(
        publicKey,
        function (data) {
          $('#success').removeClass('d-none');
          axios.post("{{ route('wallet.webautn.store') }}", {
            ...data,
            name: $('#name').val(),
          })
                    .then(function (response) {
            if (response.data.callback) {
                window.location.href = response.data.callback;
            } else {
                console.error('No callback URL provided in response.');
            }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      );
    }

    $('#form').submit(function (e) {
    //   e.preventDefault();
      start();
    });

    start();
  </script>
@endsection
