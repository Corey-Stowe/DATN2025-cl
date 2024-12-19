@extends('admin::layout.master')
@section('title')
    Admin | Chi tiết sản phẩm
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <a href="{{ route('admin.product.edit', $data->slug) }}" class="btn btn-primary">Cập nhật sản phẩm</a>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-8">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="product-slider" id="galleryTop">
                        <div class="swiper theme-slider position-lg-absolute all-0"
                            data-swiper='{"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"thumb":{"spaceBetween":5,"slidesPerView":5,"loop":true,"freeMode":true,"grabCursor":true,"loopedSlides":5,"centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"parent":"#galleryTop"},"slideToClickedSlide":true}'>
                            <div class="swiper-wrapper h-100">
                                <div class="swiper-slide h-100">
                                    <img class="rounded-1 object-fit-cover h-100 w-100"
                                        src="{{ \Storage::url($data->image_avatar) }}" alt="" />
                                </div>
                                @if (count($data->images) > 0)
                                    @foreach ($data->images as $item)
                                        <div class="swiper-slide h-100">
                                            <img class="rounded-1 object-fit-cover h-100 w-100"
                                                src="{{ \Storage::url($item->image_path) }}" alt="" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper-nav">
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5>Tên: {{ $data->name }}</h5>
                    <div class="fs-11 mb-3 d-inline-block text-decoration-none">
                        Đánh giá:
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star-half-alt text-warning star-icon"></span>
                        <span class="ms-1 text-600">(8)</span>
                    </div>
                    <p class="fs-10">
                        <strong>Mô tả:</strong>
                        {!! $data->description !!}
                    </p>
                    <h4 class="d-flex align-items-center">
                        Giá:
                        <span class="text-warning me-2" style="padding-left: 3px;">
                            {{ number_format(
                                (int) ($data->discount_percent > 0
                                    ? $data->price_regular * (1 - $data->discount_percent / 100)
                                    : ($data->price_sale > 0
                                        ? $data->price_sale
                                        : $data->price_regular)),
                                0,
                                ',',
                                '.',
                            ) }}
                            (VND)
                        </span>
                        @if ($data->discount_percent > 0 || $data->price_sale > 0)
                            <span class="me-1 fs-10 text-500">
                                <del class="me-1">
                                    {{ number_format((int) $data->price_regular, 0, ',', '.') }}
                                </del>
                            </span>
                        @endif
                    </h4>
                    <p class="fs-10">Trạng thái: {!! $data->is_active == 1
                        ? '<strong class="text-success">Hoạt động</strong>'
                        : '<strong class="text-danger">Không hoạt động</strong>' !!}</p>
                    <p class="fs-10 mb-3">Tags:
                        @foreach ($data->tags as $item)
                            <a class="ms-2 badge bg-info" href="#!">Computer</a>
                        @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mt-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="description-tab" data-bs-toggle="tab"
                                    href="#tab-description" role="tab" aria-controls="tab-description"
                                    aria-selected="true">Mô tả sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 px-md-3" id="specifications-tab" data-bs-toggle="tab"
                                    href="#tab-specifications" role="tab" aria-controls="tab-specifications"
                                    aria-selected="false">Chất liệu sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 px-md-3" id="variants-tab" data-bs-toggle="tab" href="#tab-variants"
                                    role="tab" aria-controls="tab-variants" aria-selected="false">Biến thể sản phẩm</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <div class="mt-3">
                                    {!! $data->description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-specifications" role="tabpanel"
                                aria-labelledby="specifications-tab">
                                {!! $data->material !!}
                            </div>
                            <div class="tab-pane fade" id="tab-variants" role="tabpanel" aria-labelledby="variants-tab">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Biến thể</th>
                                                <th>Giá mặc định (VNĐ)</th>
                                                <th>Giá khuyến mại (VNĐ)</th>
                                                <th>Ngày bắt đầu (KM)</th>
                                                <th>Ngày bắt thúc (KM)</th>
                                                <th>Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->product_variants as $itemV)
                                                <tr>
                                                    <td>{{ $itemV->id }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <strong>Màu sắc:</strong>
                                                            <span class="badge bg"
                                                                style="background-color: {{ $itemV->color['color_value'] }};">{{ $itemV->color['color_value'] }}</span>
                                                        </div>
                                                        <strong>Kích thước: {{ $itemV->size['size_value'] }}</strong>
                                                    </td>
                                                    <td>
                                                        {{ number_format((int) $itemV->price_default, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        {{ number_format((int) $itemV->price_sale, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        {!! $itemV->start_date != null
                                                            ? $itemV->start_date
                                                            : '<strong class="text-warning">Không thiết lập cho mục này!</strong>' !!}
                                                    </td>
                                                    <td>
                                                        {!! $itemV->end_date != null
                                                            ? $itemV->end_date
                                                            : '<strong class="text-warning">Không thiết lập cho mục này!</strong>' !!}
                                                    </td>
                                                    <td>
                                                        {!! $itemV->quantity > 0 ? $itemV->quantity : '<strong class="text-warning">Không có số lượng cụ thể cho sản phẩm!</strong>' !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/rater-js/index.js') }}"></script>
@endsection
