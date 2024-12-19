@extends('admin::layout.master')


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
    <form action="{{ route('admin.coupons.store') }}" method="POST" >
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Thêm mới mã giảm giá</h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Danh sách</a>
                        <button type="submit" class="btn btn-primary" role="button">Thêm mã giảm giá
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
                                <input class="form-control" name="name" id="name" type="text">
                                @error('name')<label class="form-label text-danger">{{ $message }} </label>@enderror
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="code">Mã giảm giá:</label>
                                <input class="form-control" name="code" id="code" type="text">
                                @error('code')<label class="form-label text-danger">{{ $message }} </label>@enderror
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="description">Mô tả:</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                @error('description')<label class="form-label text-danger">{{ $message }} </label>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="quantity">Số lượng:</label>
                                <input class="form-control" name="quantity" id="quantity" type="number">
                                @error('quantity')<label class="form-label text-danger">{{ $message }} </label>@enderror
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
                                <input type="datetime-local" class="form-control" id="date_start" name="date_start">
                                @error('date_start')<label class="form-label text-danger">{{ $message }} </label>@enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="date_end">Thời gian kết thúc:</label>
                                <input type="datetime-local" class="form-control" id="date_end" name="date_end">
                                @error('date_end')<label class="form-label text-danger">{{ $message }} </label>@enderror
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
                                        <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Cố định</option>
                                    </select>
                                    @error('discount_type')<label class="form-label text-danger">{{ $message }} </label>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="discount_amount">Giá trị:</label>
                                    <input class="form-control" name="discount_amount" id="discount_amount" type="number">
                                    @error('discount_amount')<label class="form-label text-danger">{{ $message }} </label>@enderror
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
                                    <input class="form-control" id="minimum_spend" name="minimum_spend" type="text">
                                    @error('minimum_spend')<label class="form-label text-danger">{{ $message }} </label>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
@section('js-libs')
@endsection
@section('js-setting')
@endsection
