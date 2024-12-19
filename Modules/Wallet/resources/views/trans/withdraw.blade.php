@extends('wallet::layouts.master')

@section('content')
    <div class="">
        <h3 class="text-center">Tạo yêu cầu rút tiền</h3>
    </div>
    <div class="container mt-2">
        <div class="container-fluid">
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rút tiền vào tài khoản ngân hàng</h4>
                <p class="card-title-desc">Vui lòng nhập số tiền cần rút và điền thông tin người nhận ở dưới đây</p>
            </div>
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('wallet.createWithdraw') }}" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationAmmout">Số Tiền cần rút</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="amount" id="validationAmmout"
                                        placeholder="0 VND" min="50000" required>
                                    <div class="input-group-text">VND</div>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số tiền cần rút tối thiểu 50.000 VND
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Thông tin người thụ hưởng</label>

                    <div class="mb-3">
                        <label class="form-label" for="validationbank_account_number">Số Tài khoản</label>
                        <input type="text" class="form-control" name="bank_account_number"
                            id="validationbank_account_number" required>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Vui lòng nhập số tài khoản
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="validationbank_account_name">Tên Người thụ hưởng</label>
                        <input type="text" class="form-control" name="bank_account_name" id="validationbank_account_name"
                            required>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Vui lòng nhập Người thụ hưởng
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="validationbank_name">Ngân hàng thụ hưởng</label>
                        <select class="form-control" name="bank_name" id="validationbank_name" required>
                            <option value="">Chọn ngân hàng</option>
                            <option value="970415">VietinBank</option>
                            <option value="970436">Vietcombank</option>
                            <option value="970418">BIDV</option>
                            <option value="970405">Agribank</option>
                            <option value="970448">OCB</option>
                            <option value="970422">MBBank</option>
                            <option value="970407">Techcombank</option>
                            <option value="970416">ACB</option>
                            <option value="970432">VPBank</option>
                            <option value="970423">TPBank</option>
                            <option value="970403">Sacombank</option>
                            <option value="970437">HDBank</option>
                            <option value="970454">VietCapitalBank</option>
                            <option value="970429">SCB</option>
                            <option value="970441">VIB</option>
                            <option value="970443">SHB</option>
                            <option value="970431">Eximbank</option>
                            <option value="970426">MSB</option>
                            <option value="546034">CAKE</option>
                            <option value="546035">Ubank</option>
                            <option value="963388">Timo</option>
                            <option value="971005">ViettelMoney</option>
                            <option value="971011">VNPTMoney</option>
                            <option value="970400">SaigonBank</option>
                            <option value="970409">BacABank</option>
                            <option value="970412">PVcomBank</option>
                            <option value="970414">Oceanbank</option>
                            <option value="970419">NCB</option>
                            <option value="970424">ShinhanBank</option>
                            <option value="970425">ABBANK</option>
                            <option value="970427">VietABank</option>
                            <option value="970428">NamABank</option>
                            <option value="970430">PGBank</option>
                            <option value="970433">VietBank</option>
                            <option value="970438">BaoVietBank</option>
                            <option value="970440">SeABank</option>
                            <option value="970446">COOPBANK</option>
                            <option value="970449">LPBank</option>
                            <option value="970452">KienLongBank</option>
                            <option value="668888">KBank</option>
                            <option value="970462">KookminHN</option>
                            <option value="970466">KEBHanaHCM</option>
                            <option value="970467">KEBHANAHN</option>
                            <option value="977777">MAFC</option>
                            <option value="533948">Citibank</option>
                            <option value="970463">KookminHCM</option>
                            <option value="999888">VBSP</option>
                            <option value="970457">Woori</option>
                            <option value="970421">VRB</option>
                            <option value="970458">UnitedOverseas</option>
                            <option value="970410">StandardChartered</option>
                            <option value="970439">PublicBank</option>
                            <option value="801011">Nonghyup</option>
                            <option value="970434">IndovinaBank</option>
                            <option value="970456">IBKHCM</option>
                            <option value="970455">IBKHN</option>
                            <option value="458761">HSBC</option>
                            <option value="970442">HongLeong</option>
                            <option value="970408">GPBank</option>
                            <option value="970406">DongABank</option>
                            <option value="796500">DBSBank</option>
                            <option value="422589">CIMB</option>
                            <option value="970444">CBBank</option>
                        </select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            Vui chọn Ngân hàng thụ hưởng
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">Tôi cam kết các thông tin đều đúng & chấp nhận các điều khoản sủ dụng dịch vụ ví tiền</label>
                                    <div class="invalid-feedback">
                                        Bạn cần đồng ý với điều khoản sử dụng dịch vụ
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tạo yêu cầu rút tiền</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const validationAmmout = document.getElementById('validationAmmout');

            function formatCurrency(input) {
                let value = input.value.replace(/\D/g, '');
                value = (value / 1000).toFixed(3).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                input.value = value;
            }
            validationAmmout.addEventListener('input', function() {
                formatCurrency(validationAmmout);
            });


        });

        !(function() {
            "use strict";
            window.addEventListener(
                "load",
                function() {
                    var t = document.getElementsByClassName("needs-validation");
                    Array.prototype.filter.call(t, function(e) {
                        e.addEventListener(
                            "submit",
                            function(t) {
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
