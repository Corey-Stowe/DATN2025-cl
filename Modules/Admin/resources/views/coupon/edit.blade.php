@extends('admin::layout.master')
@section('title')
    Sửa mã giảm giá : {{ $coupon->name }}
@endsection

@section('css-libs')
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dataTables/datatables.css') }}">
    <script src="{{ asset('dataTables/datatables.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('css-setting')
@endsection
@section('contents')
    <form action="{{ route('admin.coupons.update', ['id' => $coupon->id]) }}" method="POST" id="discountForm">
        @csrf
        @method('PUT')
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Sửa mã giảm giá : {{ $coupon->name }}</h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Danh sách</a>
                        <button type="submit" class="btn btn-primary" id="submitBtn" role="button">Sửa mã giảm giá
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thông tin cơ bản:</h6>
                    </div>
                    <div class="card-body">

                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="name">Tên mã giảm giá:</label>
                                <input class="form-control" name="name" id="name" type="text"
                                    value="{{ $coupon->name }}">
                                @error('name')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="code">Mã giảm giá:</label>
                                <input class="form-control" name="code" id="code" type="text"
                                    value="{{ $coupon->code }}">
                                @error('code')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="description">Mô tả:</label>
                                <textarea class="form-control" name="description" id="description" rows="3">{{ $coupon->description }}</textarea>
                                @error('description')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="quantity">Số lượng:</label>
                                <input class="form-control" name="quantity" id="quantity" type="number"
                                    value="{{ $coupon->quantity }}">
                                @error('quantity')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thời gian bắt đầu và kết thúc:</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">

                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="date_start">Thời gian bắt đầu:</label>
                                <input type="datetime-local" class="form-control" id="date_start" name="date_start"
                                    value="{{ $coupon->date_start }}">
                                @error('date_start')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="date_end">Thời gian kết thúc:</label>
                                <input type="datetime-local" class="form-control" id="date_end" name="date_end"
                                    value="{{ $coupon->date_end }}">
                                @error('date_end')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Giá trị và loại</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3"><label class="form-label" for="discount_type">Chọn loại giảm
                                        giá:</label>
                                    <select class="form-select" id="discount_type" name="discount_type">
                                        <option value="">-- Chọn --</option>
                                        <option value="percent"
                                            {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                                        <option value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>
                                            Cố định</option>
                                    </select>
                                    @error('discount_type')
                                        <label class="form-label text-danger">{{ $message }} </label>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="discount_amount">Giá trị:</label>
                                    <input class="form-control" name="discount_amount" id="discount_amount"
                                        type="number" value="{{ $coupon->discount_amount }}">
                                    @error('discount_amount')
                                        <label class="form-label text-danger">{{ $message }} </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Chi tiêu</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="minimum_spend">Chi tiêu tối thiểu:</label>
                                    <input class="form-control" id="minimum_spend" name="minimum_spend" type="text"
                                        value="{{ $coupon->minimum_spend }}">
                                    @error('minimum_spend')
                                        <label class="form-label text-danger">{{ $message }} </label>
                                    @enderror
                                </div>
                                @error('maximum_spend')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- <div class="card mt-3">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0"></h5>
                    </div>
                    <div class="col-auto"> <button class="btn btn-link text-secondary p-0 me-3 fw-medium" role="button">Hủy</button><button
                        type="submit" class="btn btn-primary" role="button">Thêm mã giảm giá
                    </button>
                    </div>
                </div>
            </div>
        </div> --}}
    </form>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            // Prevent form submission
            event.preventDefault();

            // Trigger SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Bạn có chắc chắn sửa không?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vâng, áp dụng!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('discountForm').submit();
                }
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Thành Công",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "thất bại",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                title: "{{ session('info') }}",
                text: "{{ session('info') }}",
                icon: "info"
            });
        </script>
    @endif
@endsection
@section('js-libs')
@endsection
@section('js-setting')
@endsection
