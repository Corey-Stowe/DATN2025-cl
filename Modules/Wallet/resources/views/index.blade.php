@extends('wallet::layouts.master')

@section('content')
<script src="{{ Module::asset('wallet:libs/gridjs/gridjs.umd.js') }}"></script>
    <div class="">
        {{-- <div class="alert alert-primary" role="alert">
            <p><i class="mdi mdi-alert-circle-outline me-2"></i> Ví tiền đang trong trạng thái xây dựng, chức năng xác thực người đã được tắt</p>
         </div> --}}
        @if($data->wallet_status != 1)
        <div class="alert alert-danger" role="alert">
           <p> <i class="mdi mdi-block-helper me-2"></i> Ví tiền của bạn đã bị vô hiệu hóa, vui lòng liên hệ đội ngũ hỗ trợ để biết thêm chi tiết</p>
           <p> {{ $data->admin_note }}</p>
        </div>
        @elseif($data->wallet_user_level == 1)
        <div class="alert alert-warning" role="alert">
           <p> <i class="mdi mdi-alert-outline me-2"></i>  Tài khoản của bạn đang ở mức độ xác thực thông tin cơ bản vui lòng <a href="{{ route('ekyc.index') }}">cập nhật thông tin cá nhân</a> để nâng cấp tài khoản</p>
           <p> Một số chức năng sẽ không thể sử dụng sau đây</p>
           <ul>
                <li> Rút tiền</li>
                {{-- <li> Chuyển tiền</li> --}}
                <li> Nạp tiền</li>
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-6">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary"><i class="fas fa-money-check"></i> Số dư hiện có</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Số dư tài khoản</h5>
                        <p class="card-text">{{ number_format(round($data->wallet_balance_available)) }} VND</p>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-6">
                <div class="card border border-warning">
                    <div class="card-header bg-transparent border-warningr">
                        <h5 class="my-0 text-warning"><i class="bx bxs-timer"></i> Số dư rút tiền chờ duyệt</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Số tiền chờ duyệt</h5>
                        <p class="card-text">{{ number_format(round($withdraw_toal)) }} VND</p>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>

    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Lịch sử giao dịch</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="table-search"></div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>

    <script>
new gridjs.Grid({
    columns: ["Mã giao dịch", "Số tiền", "Loại giao dịch", "Ngày tạo", {
        name: "Trạng thái",
        formatter: (cell) => {
            // Define badge color based on status
            let badgeClass = cell === "Thành công" ? "badge bg-success" : "badge bg-danger";
            return gridjs.html(`<span class="badge ${badgeClass}">${cell}</span>`);
        }
    },
    {
        name: "Hành động",
        formatter: (cell, row) => {
            const url = `{{ route('wallet.transaction', ['id' => ':id']) }}`.replace(':id', row.cells[0].data);
            return gridjs.html(`<a href="${url}" class="btn btn-primary btn-sm">${cell}</a>`);
        }
    }],
    pagination: { limit: 5 },
    search: true,
    data: [
        @foreach ($trx_data as $items)
        ["{{ $items->trx_id }}", "{{ number_format(round($items->trx_amount)) }} VND", "{{ $items->trx_type }}", "{{ $items->created_at }}", "@if($items->trx_status == 0) Chờ duyệt @elseif($items->trx_status == 1) Thành công @elseif($items->trx_status == 2) Thất bại @endif", "Chi tiết"],
        @endforeach
    ]
}).render(document.getElementById("table-search"));
    </script>
@endsection
