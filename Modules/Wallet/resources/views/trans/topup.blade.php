@extends('wallet::layouts.master')

@section('content')
<div class="">
    <h3 class="text-center">Nạp tiền vào tài khoản</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
</div>
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Nạp tiền Vào tài khoản</h4>
            <p class="card-title-desc">Vui lòng nhập số tiền và chọn phương thức thanh toán để nạp tiền vào Ví</p>
        </div>
        <div class="card-body">
            <form class="needs-validation" method="POST" action="{{ route('wallet.charge') }}" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="validationAmmout">Số Tiền cần nạp</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ammount" id="validationAmmout" placeholder="0 VND" min="50000" required>
                                <div class="input-group-text">VND</div>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">
                                    Vui lòng nhập số tiền cần nạp tối thiểu 50.000 VND
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <div class="form-check">
                            <label class="form-check-label" for="paymentinvalidCheck">Phương thức thanh toán</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="vnpay" name="payment" value="vnpay" required>
                                <label class="form-check-label" for="vnpay">VnPay</label>
                            </div>
                            {{-- <div class="form-check">
                                <input type="radio" class="form-check-input" id="creditcard" name="payment" value="creditcard" required>
                                <label class="form-check-label" for="creditcard">Thẻ Tín dụng</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">
                                    Vui lòng chọn phương thức thanh toán
                                </div>
                                <div id="ccinput" style="display: none;">
                                    <div class="mb-3">
                                        @if (isset($creditCard))
                                        <h5 class="mb-3">Saved Cards</h5>
                                        @foreach ($creditCard as $item)
                                        <div class="form-check d-flex align-items-center mb-2">
                                            <input class="form-check-input me-2" type="radio" name="card_id" id="card_{{ $item->card_id }}" value="{{ $item->card_id }}">
                                            <label class="form-check-label" for="card_{{ $item->card_id }}">
                                                <i class="bi bi-credit-card-fill me-2"></i>{{ $item->brand }} **** **** **** {{ $item->last4 }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="card_holder_name" class="form-label">Card Holder</label>
                                        <input type="text" class="form-control" id="card_holder_name" name="card_holder_name">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập Tên chủ thẻ
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="card_number" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" pattern="\d{16}" maxlength="16">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            Vui lòng nhập số thẻ
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="month" class="form-label">Month</label>
                                            <input type="text" class="form-control" id="month" name="month" placeholder="MM" pattern="\d{2}" maxlength="2">
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">
                                                Vui lòng nhập tháng hết hạn
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="year" class="form-label">Year</label>
                                            <input type="text" class="form-control" id="year" name="year" placeholder="YY" pattern="\d{2}" maxlength="2">
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">
                                                Vui lòng nhập ngày hết hạn
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="card_cvc" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="card_cvc" name="card_cvc" placeholder="XXX" pattern="\d{3}" maxlength="3">
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">
                                                Vui lòng nhập mã bảo mật
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="save_card" name="save_card">
                                        <label class="form-check-label" for="save_card">Lưu thẻ để sử dụng lần sau</label>
                                    </div>

                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">Đồng ý sử điều khoản sử dụng dịch vụ ví tiền</label>
                                <div class="invalid-feedback">
                                Bạn cần đồng ý với điều khoản sử dụng dịch vụ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Nạp</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vnpayRadio = document.getElementById('vnpay');
        const creditCardRadio = document.getElementById('creditcard');
        const ccInput = document.getElementById('ccinput');
        const cardHolderName = document.getElementById('card_holder_name');
        const cardNumber = document.getElementById('card_number');
        const month = document.getElementById('month');
        const year = document.getElementById('year');
        const cardCvc = document.getElementById('card_cvc');
        const validationAmmout = document.getElementById('validationAmmout');

        function toggleCreditCardInputs() {
            if (creditCardRadio.checked) {
                ccInput.style.display = 'block';
                cardHolderName.required = true;
                cardNumber.required = true;
                month.required = true;
                year.required = true;
                cardCvc.required = true;
            } else {
                ccInput.style.display = 'none';
                cardHolderName.required = false;
                cardNumber.required = false;
                month.required = false;
                year.required = false;
                cardCvc.required = false;
            }
        }

        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, '');
            value = (value / 1000).toFixed(3).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            input.value = value;
        }

        vnpayRadio.addEventListener('change', toggleCreditCardInputs);
        creditCardRadio.addEventListener('change', toggleCreditCardInputs);
        validationAmmout.addEventListener('input', function() {
            formatCurrency(validationAmmout);
        });

        toggleCreditCardInputs(); // Gọi hàm này để thiết lập ban đầu
    });

    !(function () {
        "use strict";
        window.addEventListener(
            "load",
            function () {
                var t = document.getElementsByClassName("needs-validation");
                Array.prototype.filter.call(t, function (e) {
                    e.addEventListener(
                        "submit",
                        function (t) {
                            !1 === e.checkValidity() &&
                                (t.preventDefault(), t.stopPropagation()),
                                e.classList.add("was-validated");
                        },
                        !1
                    );
                });
            },
            !1
        );
    })();
</script>

@endsection
