@extends('admin::layout.master')
@section('title', 'Chi tiết yêu cầu rút tiền')
@section('contents')
    <?php
    use Carbon\Carbon;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Thông tin yêu cầu duyệt đơn</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Thông tin cá nhân</h3>
                    </div>
                    <div class="card-body">
                        <p>Họ Và Tên: <strong>{{ $data->frist_name }} {{ $data->last_name }}</strong></p>
                        <p>Ngày sinh: <strong>{{ date('d/m/Y', strtotime($data->date_of_birth)) }}</strong></p>
                        <p>Giới tính: <strong>{{ $data->gender == 'MALE' ? 'Nam' : 'Nữ' }}</strong></p>
                        <p>Quốc tịch: <strong>{{ $data->nationality }}</strong></p>
                        <p>Số căn cước: <strong>{{ $data->id_number }}</strong></p>
                        <p>Nơi sinh: <strong>{{ $data->place_of_birth }}</strong></p>
                        <p>Nơi Ở hiện tại: <strong>{{ $data->place_of_residence }}</strong></p>
                        <p>Số điện thoại: <strong>{{ $data->phone_number }}</strong></p>
                        <p>Ngày cấp: <strong>{{ date('d/m/Y', strtotime($data->issue_date)) }}</strong></p>
                        <p>Ngày hết hạn: <strong>{{ date('d/m/Y', strtotime($data->date_of_expiry)) }}</strong></p>
                        <p>Nơi cấp: <strong>{{ $data->place_of_issue }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Ảnh CCCD (click vào để phóng to ảnh)</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">CCCD Mặt trước</h4>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $idcard_front_base64 }}" class="img-fluid" alt="CCCD Mặt trước" onclick="showImageModal('{{ $idcard_front_base64 }}')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">CCCD Mặt sau</h4>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $idcard_back_base64 }}" class="img-fluid" alt="CCCD Mặt sau" onclick="showImageModal('{{ $idcard_back_base64 }}')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Hành động</h3>
                    </div>
                    <div class="card-body">
                        <p>Trạng thái tài khoản hiện tại: @if ($data->wallet_user_level == 1)
                            <span class="badge rounded-pill badge-subtle-danger">Cần duyệt thông tin</span>
                        @elseif ($data->wallet_user_level == 2)
                            <span class="badge rounded-pill badge-subtle-success">Đã duyệt thành công</span>
                        @endif
                        </p>
                        <form action="{{ route('admin.wallet.userpedUpdate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="admin_note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="admin_note" name="admin_note" rows="3">{{ $data->admin_note }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <div>
                                    <input type="radio" id="status1" name="status" value="1">
                                    <label for="status1">Duyệt thông tin</label>
                                </div>
                                <div>
                                    <input type="radio" id="status2" name="status" value="2">
                                    <label for="status2">Từ chối thông tin</label>
                                </div>
                                <input type="hidden" name="id" value="{{ $data->user_id }}">
                                <input type="hidden" name="wallet_account_id" value="{{ $data->wallet_account_id }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Xem ảnh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Image">
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
@endsection
