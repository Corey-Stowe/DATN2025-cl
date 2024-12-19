@extends('admin::layout.master')
@section('title', 'Chi tiết yêu cầu rút tiền')
@section('contents')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Thông tin yêu cầu rút tiền</h3>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">Thông tin trạng thái rút tiền</h3>
                        <p class="card-text">Số tiền rút: <strong>{{ number_format($data->amount) }} VND</strong></p>
                        <p class="card-text">Độ xác thực ví tiền: @if ($data->wallet_user_level == 1)
                                <span class="badge rounded-pill badge-subtle-danger">Xác thực cơ bản</span>
                            @elseif ($data->wallet_user_level == 2)
                                <span class="badge rounded-pill badge-subtle-success">Xác thực đầy đủ</span>
                            @endif
                        </p>

                        <p class="card-text">Người thụ hưởng: <strong>{{ $data->bank_account_number }}</strong></p>
                        <p class="card-text">Người nhận: <strong>{{ $data->bank_account_name }}</strong></p>
                        <p class="card-text">Mã Ngân hàng: <strong>{{ $data->bank_name }}</strong></p>
                        <p class="card-text">Trạng thái: @if ($data->status == 1)
                                <span class="badge rounded-pill badge-subtle-warning">Chờ duyệt</span>
                            @elseif ($data->status == 2)
                                <span class="badge rounded-pill badge-subtle-success">Đã duyệt</span>
                            @elseif ($data->status == 3)
                                <span class="badge rounded-pill badge-subtle-danger">Từ chối</span>
                            @elseif ($data->status == 4)
                                <span class="badge rounded-pill badge-subtle-danger">Gian Lận</span>
                            @endif
                        </p>
                        <p class="card-text">Ngày khởi tạo: <strong>{{ $data->request_date }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">QR chuyển khoản</h3>
                    </div>
                    <div class="card-body text-center">
                        @if ($data->status != 2 && $data->status != 3)
                        <img src="https://img.vietqr.io/image/{{ $data->bank_name }}-{{ $data->bank_account_number }}-print.png?amount={{ $data->amount }}&accountName={{ $data->bank_account_name }}&addInfo=yeu cau rut tien {{ $data->withdraw_request_id }} tai PCV Fasion"
                        alt="Ảnh CK" class="img-fluid">

                        @else
                        <p>Yêu cầu đã hoàn thành, không thể tạo mã QR</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Chỉnh sửa, cập nhật trạng thái</h3>
                    </div>
                    @if ($data->status != 2 && $data->status != 3)
                        <div class="card-body">
                            <p>Chỉnh sửa trạng thái và ghi chú</p>
                            <form method="POST" action="{{ route('admin.wallet.updateupdatepost') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="admin_note" class="form-label">Ghi chú của admin</label>
                                    <textarea class="form-control" id="admin_note" rows="3" name="admin_note">{{ $data->admin_note }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="1" @if ($data->status == 1) selected @endif>Chờ duyệt
                                        </option>
                                        <option value="2" @if ($data->status == 2) selected @endif>Hoàn thành
                                        </option>
                                        <option value="3" @if ($data->status == 3) selected @endif>Thất bại
                                        </option>
                                    </select>
                                    <input type="hidden" name="withdraw_request_id"
                                        value="{{ $data->withdraw_request_id }}">
                                    <input type="hidden" name="trx_id" value="{{ $data->trx_id }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <div class="mt-3">
                                <h3 class="card-title">Hành động tài khoản</h3>

                                <div class="card-body">
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalLockWallet">Khóa ví người dùng</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalHoldFunds">Giữ khoản tiền điều tra</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Khóa ví người dùng -->
                        <div class="modal fade" id="modalLockWallet" tabindex="-1" aria-labelledby="lockWalletLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="lockWalletLabel">Khóa ví người dùng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.wallet.lockwallet') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                            <input type="hidden" name="wallet_id" value="{{ $data->wallet_account_id }}">
                                            <input type="hidden" name="trx_id" value="{{ $data->trx_id }}">
                                            <input type="hidden" name="withdraw_request_id"
                                            value="{{ $data->withdraw_request_id }}">
                                            <div class="mb-3">
                                                <label for="lockReason" class="form-label">Lý do khóa ví</label>
                                                <textarea class="form-control" id="lockReason" name="admin_note" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-danger">Khóa ví</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Giữ khoản tiền điều tra -->
                        <div class="modal fade" id="modalHoldFunds" tabindex="-1" aria-labelledby="holdFundsLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="holdFundsLabel">Giữ khoản tiền điều tra</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.wallet.holdback') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                            <input type="hidden" name="wallet_id" value="{{ $data->wallet_account_id }}">
                                            <input type="hidden" name="trx_id" value="{{ $data->trx_id }}">
                                            <input type="hidden" name="withdraw_request_id"
                                            value="{{ $data->withdraw_request_id }}">
                                            <div class="mb-3">
                                                <label for="holdReason" class="form-label">Lý do giữ khoản tiền</label>
                                                <textarea class="form-control" id="holdReason" name="admin_note" rows="3"></textarea>
                                            </div>
                                            <p class="text-danger">Sau khi giữ khoản tiền, người dùng sẽ được thông báo.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-warning">Giữ khoản tiền</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-body">
                    <p><strong>Đơn hàng đã được duyệt</strong></p>
                </div>
                @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="card border-primary mb-3">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Lịch sử rút tiền người dùng</h3>
                <p class="card-text"><strong>Vui lòng xem kĩ trước khi quyết định duyệt đơn người dùng ! </strong>
                </p>
            </div>
            <div class="card-body">
                <div class="accordion" id="withdrawHistoryAccordion">
                    @foreach ($list_user as $index => $history)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $index }}">
                                    Yêu cầu rút tiền #{{ $history->withdraw_request_id }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $index }}" data-bs-parent="#withdrawHistoryAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Số tiền: {{ number_format($history->amount) }} VND</li>
                                        <li>Ngày yêu cầu: {{ $history->request_date }}</li>
                                        <li>Trạng thái: @if ($history->status == 1)
                                                Chờ duyệt
                                            @elseif ($history->status == 2)
                                                Hoàn thành
                                            @elseif ($history->status == 3)
                                                Thất Bại
                                            @endif
                                        </li>
                                        <li>Ghi chú của admin: {{ $history->admin_note }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
