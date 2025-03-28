@extends('admin::layout.master')
@section('title')
    Admin | Cập nhật sản phẩm
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    @if (session()->has('error'))
                        <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                    @else
                        @if (session()->has('success'))
                            <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                        @else
                            <h5 class="mb-2 mb-md-0">Cập nhật sản phẩm</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.product.update', $data) }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        @method('PUT')
        <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thông tin cơ bản</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="prd_name">Tên sản phẩm:</label>
                                <input class="form-control" id="prd_name" type="text" name="prd_name"
                                    value="{{ old('prd_name') ? old('prd_name') : $data->name }}" />
                                @error('prd_name')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="prd_slug">Slug sản phẩm:</label>
                                <input class="form-control" id="prd_slug" type="text" name="prd_slug"
                                    value="{{ old('prd_slug') ? old('prd_slug') : $data->slug }}" />
                                @error('prd_slug')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thư viện ảnh sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->has('prd_images.*'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('prd_images.*') as $error)
                                    @foreach ($error as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                        <div class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload"
                            data-dropzone="data-dropzone">
                            <div class="dz-message" data-dz-message="data-dz-message">
                                <img class="me-2" src="{{ asset('theme/admin/img/icons/cloud-upload.svg') }}"
                                    width="25" alt="" />
                                <span class="d-none d-lg-inline">Kéo thả ảnh của bạn tại đây<br />hoặc, </span>
                                <span class="btn btn-link p-0 fs-10">Chọn ảnh</span>
                            </div>
                            <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger">
                                    <img class="dz-image" src="{{ asset('theme/admin/img/icons/cloud-upload.svg') }}"
                                        alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                                    <div class="flex-1 d-flex flex-between-center">
                                        <div>
                                            <h6 data-dz-name="data-dz-name"></h6>
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 fs-10 text-400 lh-1" data-dz-size="data-dz-size"></p>
                                                <div class="dz-progress">
                                                    <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown font-sans-serif">
                                            <button
                                                class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span class="fas fa-ellipsis-h"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2">
                                                <a class="dropdown-item" href="#!" data-dz-remove="data-dz-remove">Xóa
                                                    ảnh</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="prd_images[]" id="hidden-files" multiple style="display: none;">
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Mô tả - Chất liệu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="prd_description">
                                    Mô tả sản phẩm:
                                </label>
                                <div class="create-product-description-textarea">
                                    <textarea class="tinymce d-none" data-tinymce="data-tinymce" name="prd_description" id="prd_description">
                                        {{ old('prd_description') ? old('prd_name') : $data->description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="prd_material">
                                    Chất liệu sản phẩm:
                                </label>
                                <textarea class="form-control" name="prd_material" id="prd_material">
                                    {{ old('prd_material') ? old('prd_name') : $data->material }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 mb-lg-0">
                    <div class="card-header bg-body-tertiary">
                        @if (session()->has('prdVariant'))
                            <h6 class="mb-0 text-danger">{{ session('prdVariant') }}</h6>
                        @else
                            <h6 class="mb-0">Thuộc tính sản phẩm biến thể</h6>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row gy-3 gx-2">
                            @foreach (['color' => $colorAttr, 'size' => $sizeAttr] as $type => $attr)
                                <div class="col-sm-2">
                                    <label class="form-label" for="">
                                        {{ $type == 'color' ? 'Màu sắc:' : 'Kích thước' }}
                                    </label>
                                </div>
                                <div class="col-sm-10 {{ count($attr) > 0 ? 'row' : '' }}">
                                    @if (count($attr) > 0)
                                        @foreach ($attr as $item)
                                            <div class="col-sm-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input {{ $type }}Value"
                                                            type="checkbox" name="{{ $item->id }}"
                                                            value="{{ $item->{$type . '_value'} }}"
                                                            aria-label="Checkbox for following text input">
                                                    </div>
                                                    <input
                                                        class="form-control {{ $type === 'color' ? 'form-control-color' : '' }}"
                                                        type="{{ $type === 'color' ? 'color' : 'text' }}"
                                                        value="{{ $item->{$type . '_value'} }}" disabled>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <label class="form-label text-warning" for="">
                                            <strong>Chưa thêm giá trị cho thuộc tính này!</strong>
                                        </label>
                                    @endif
                                </div>
                            @endforeach
                            <div class="col-12 mb-3 row loadVariants"></div>
                            <div class="col-12 mb-3">
                                <input type="button" onclick="rendFormVariants()" class="btn btn-success btnCrtVariants"
                                    value="Tạo biến thể">
                            </div>
                        </div>
                        @if (count($variantPRD) > 0)
                            <hr>
                            <div class="row gy-3 gx-2">
                                @foreach ($variantPRD as $item)
                                    @php
                                        $colorAttr = \App\Models\ColorAttribute::query()->find(
                                            $item->color_attribute_id,
                                        );
                                        $sizeAttr = \App\Models\SizeAttribute::query()->find($item->size_attribute_id);
                                    @endphp
                                    <div class="accordion col-lg-6 mb-3 pe-lg-12" id="container-{{ $item->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $item->id }}" aria-expanded="true"
                                                    aria-controls="collapse-{{ $item->id }}">
                                                    <div
                                                        style="width: 25px; height: 25px; background-color: {{ $colorAttr->color_value }}; margin: 3px;">
                                                    </div>
                                                    <strong> - {{ $sizeAttr->size_value }}</strong>
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapse-{{ $item->id }}"
                                                aria-labelledby="heading-{{ $item->id }}"
                                                data-bs-parent="#container-{{ $item->id }}">
                                                <div class="accordion-body row">
                                                    <div class="col-12 mb-4">
                                                        <a href="{{ route('admin.product.deleteVariant', $item->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Chắc chắn muốn xóa?')">Xóa biến
                                                            thể</a>
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="price_default">Giá mặc định:</label>
                                                        <input class="form-control" type="number" min="0"
                                                            name="updateV[{{ $item->id }}]['price_default']"
                                                            value="{{ $item->price_default }}" />
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="price_sale">Giá khuyến mại:</label>
                                                        <input class="form-control" type="number" min="0"
                                                            name="updateV[{{ $item->id }}]['price_sale']"
                                                            value="{{ $item->price_sale }}" />
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="">Ngày bắt đầu:</label>
                                                        <input class="form-control" type="date"
                                                            name="updateV[{{ $item->id }}]['start_date']"
                                                            value="{{ $item->start_date != null ? date('Y-m-d', strtotime($item->start_date)) : 'null' }}" />
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="">Ngày kết thúc:</label>
                                                        <input class="form-control" type="date"
                                                            name="updateV[{{ $item->id }}]['end_date']"
                                                            value="{{ $item->end_date != null ? date('Y-m-d', strtotime($item->end_date)) : 'null' }}" />
                                                    </div>
                                                    <div class="col-12 mb-4">
                                                        <label class="form-label" for="">Số lượng:</label>
                                                        <input class="form-control" type="number"
                                                            name="updateV[{{ $item->id }}]['quantity']"
                                                            value="{{ $item->quantity }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Các thông tin khác</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="prd_category">Chọn danh mục:</label><select
                                            class="form-select selectpicker" id="prd_category" name="prd_category">
                                            <option value="" selected>Trống</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $data->sub_category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="multiple-select">Thẻ:</label>
                                        <select class="form-select selectpicker" id="multiple-select" multiple="multiple"
                                            data-options='{"placeholder":"Chọn..."}' name="prd_tags[]">
                                            @foreach ($tags as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    @foreach ($data->tags as $item)
                                        <span class="badge bg-info tagItem-{{ $item->id }}">{{ $item->name }}&ensp;
                                            <input class="far fa-trash-alt" type="button"
                                                onclick="removeTag(idTag={{ $item->id }}, urlTag='{{ route('admin.product.delTag', $item->id) }}')">
                                        </span> &ensp;
                                    @endforeach
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="product-subcategory">Chọn ảnh:</label>
                                    <input class="form-control" type="file" name="prd_avatar">
                                    @error('prd_avatar')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    @php
                                        $avt = $data->image_avatar;
                                        if (!\Str::contains($avt, 'http')) {
                                            $avt = \Storage::url($avt);
                                        }
                                    @endphp
                                    <img src="{{ $avt }}" alt="....." width="364px">
                                </div>
                                <hr>
                                <div class="col-12 mb-3 row">
                                    <div class="col-lg-7 pe-lg-12">
                                        <label class="form-label" for="image_thumbnail">Thư viện ảnh sản phẩm:</label>
                                    </div>
                                    <div class="col-lg-5 pe-lg-12">
                                        <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                            data-bs-target="#public-images">Kho ảnh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Giá sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="price_regular">Giá mặc định:</label>
                                    <input class="form-control" id="price_regular" type="number" name="price_regular"
                                        value="{{ old('price_regular') ? old('price_regular') : $data->price_regular }}" />
                                    @error('price_regular')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="price_sale">Giá khuyến mại:</label>
                                    <input class="form-control" id="price_sale" type="number" name="price_sale"
                                        value="{{ old('price_sale') ? old('price_sale') : $data->price_sale }}" />
                                    @error('price_sale')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="discount_percent">Khuyến mại phần trăm (%):</label>
                                    <input class="form-control" id="discount_percent" type="number"
                                        name="discount_percent"
                                        value="{{ old('discount_percent') ? old('discount_percent') : $data->discount_percent }}" />
                                    @error('discount_percent')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="start_date">Ngày bắt đầu:</label>
                                    <input class="form-control" id="start_date" type="date" name="start_date"
                                        value="{{ old('start_date') ? old('start_date') : \Carbon\Carbon::parse($data->start_date)->format('Y-m-d') }}" />
                                    @error('start_date')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="end_date">Ngày kết thúc:</label>
                                    <input class="form-control mb-3" id="end_date" type="date" name="end_date"
                                        value="{{ old('end_date') ? old('end_date') : \Carbon\Carbon::parse($data->end_date)->format('Y-m-d') }}" />
                                    {!! isset($warningDate) ? "<label class='form-label text-warning'>$warningDate</label>" : '' !!}
                                    @error('end_date')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Trạng thái - Số lượng</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="is_active" type="checkbox" name="is_active"
                                    value="1" {{ $data->is_active == 1 ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_active">Xuất bản</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="prd_quantity">Số lượng sản phẩm:</label>
                                <input class="form-control" id="prd_quantity" type="number" name="prd_quantity"
                                    value="{{ old('prd_quantity') ? old('prd_quantity') : $quantityPRD->first()->total_variants_products }}" />
                                @error('prd_quantity')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Hoàn tất thiết lập sản phẩm!</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" id="submit-button" type="submit">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="public-images" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Thư viện ảnh sản phẩm</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3 row">
                            @foreach ($data->images as $imageG)
                                @php
                                    $glr = $imageG->image_path;
                                    if (!\Str::contains($glr, 'http')) {
                                        $glr = \Storage::url($glr);
                                    }
                                @endphp
                                <div
                                    class="position-relative col-auto bg-200 mb-3 image-container imageGallery-{{ $imageG->id }}">
                                    <img src="{{ $glr }}" alt="....." width="350px"
                                        class="image">
                                    <button type="button"
                                        class="p-3 rounded-1 position-absolute top-0 end-0 btn btn-danger"
                                        onclick="removeImage(idImageG={{ $imageG->id }}, urlI='{{ route('admin.product.delImg', $imageG->id) }}')">
                                        <span class="far fa-trash-alt"></span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    {{-- UPLOAD FILE --}}
    <link href="{{ asset('theme/admin/vendors/dropzone/dropzone.css') }}" rel="stylesheet">
    {{-- SELECT2 --}}
    <link rel="stylesheet" href="{{ asset('theme/admin/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('theme/admin/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('js-libs')
    {{-- TEXTAREA EDITOR --}}
    <script src="{{ asset('theme/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
    {{-- UPLOAD FILE --}}
    <script src="{{ asset('theme/admin/vendors/dropzone/dropzone-min.js') }}"></script>
    {{-- SELECT2 --}}
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/select2/select2.full.min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        $(document).ready(function() {
            $('input[name="prd_name"][type="text"]#prd_name.form-control').on('input', function() {
                var prd_name = $(this).val();
                var slug = generateSlug(prd_name);
                $('input[name="prd_slug"][type="text"]#prd_slug.form-control').val(slug);
            });

            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        });

        function rendFormVariants() {
            let getCheckedValues = (selector) => {
                return [...document.querySelectorAll(selector)]
                    .filter(checkbox => checkbox.checked)
                    .reduce((acc, checkbox) => {
                        acc[checkbox.name] = checkbox.value;
                        return acc;
                    }, {});
            };

            let sizes = getCheckedValues('input.form-check-input.sizeValue[type="checkbox"]');
            let colors = getCheckedValues('input.form-check-input.colorValue[type="checkbox"]');
            let countS = Object.keys(sizes).length;
            let countC = Object.keys(colors).length;
            let showForm = document.querySelector('div.col-12.mb-3.row.loadVariants');
            let html;
            if (countS > 0 && countC > 0) {
                $(showForm).empty();
                Object.entries(colors).forEach(([key, value]) => {
                    Object.entries(sizes).forEach(([k, v]) => {
                        html = `
                        <div class="accordion col-lg-12 mb-3" id="container-${key}-${v}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-${key}-${v}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-${key}-${v}" aria-expanded="true"
                                        aria-controls="collapse-${key}-${v}">
                                        Biến thể: <div
                                            style="width: 25px; height: 25px; background-color: ${value}; margin: 3px;">
                                        </div>
                                        <strong> - ${v}</strong>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapse-${key}-${v}" aria-labelledby="heading-${value}-${v}"
                                    data-bs-parent="#container-${key}-${v}">
                                    <div class="accordion-body row">
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_default">Giá mặc định:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_default']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_sale">Giá khuyến mại:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_sale']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="">Ngày bắt đầu:</label>
                                            <input class="form-control" type="date"
                                                name="prdV[${key}][${k}]['start_date']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="">Ngày kết thúc:</label>
                                            <input class="form-control" type="date"
                                                name="prdV[${key}][${k}]['end_date']" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label class="form-label" for="">Số lượng:</label>
                                            <input class="form-control" type="number"
                                                name="prdV[${key}][${k}]['quantity']" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        $(showForm).append(html);
                    });
                });
            } else {
                $(showForm).empty();
                alert("Yêu cầu chọn giá trị hợp thệ!");
            }
        }

        function removeTag(idTag, urlTag) {
            if (confirm("Chắc chắn muốn xóa tags này?")) {
                let elementTag = document.querySelector(
                    `span.badge.bg-info.tagItem-${idTag}`);
                $.ajax({
                    url: urlTag,
                    method: "GET",
                    dataType: "JSON",
                    success: function(res) {
                        $(elementTag).remove();
                        alert(res.success);
                    },
                    error: function(res) {
                        alert(res.error);
                    }
                });
            }
        }

        function removeImage(idImageG, urlI) {
            if (confirm("Chắc chắn muốn xóa ảnh này?")) {
                let elementImage = document.querySelector(
                    `div.position-relative.col-auto.bg-200.mb-3.image-container.imageGallery-${idImageG}`);

                $.ajax({
                    url: urlI,
                    method: "GET",
                    dataType: "JSON",
                    success: function(res) {
                        $(elementImage).remove();
                        alert(res.success);
                    },
                    error: function(res) {
                        alert(res.error);
                    }
                });
            }
        }
        // xử lý upload file bằng thư biên dropzone
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#dropzoneMultipleFileUpload", {
            url: "#", // Không cần URL vì sẽ submit form thông thường
            autoProcessQueue: false, // Không tự động upload
            // paramName: "product_galleries", // Tên của input trong request
            uploadMultiple: true, // Cho phép chọn nhiều file
            parallelUploads: 10, // Giới hạn số file upload đồng thời
            maxFilesize: 5, // Kích thước file tối đa
            acceptedFiles: "image/*", // Chỉ nhận file ảnh
            previewsContainer: document.querySelector(".dz-preview"),
            previewTemplate: document.querySelector(".dz-preview").innerHTML,
            clickable: true, // Cho phép người dùng click vào vùng Dropzone để chọn file
            // dictDefaultMessage: 'Drag your image here or, Browse',
            init: function() {
                var myDropzone = this;
                document.querySelector(".dz-preview").innerHTML = "";
                // Khi nhấn nút submit
                document.getElementById("submit-button").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Nếu có file trong Dropzone
                    if (myDropzone.getAcceptedFiles().length > 0) {
                        var hiddenFilesInput = document.getElementById('hidden-files');
                        var dataTransfer =
                            new DataTransfer(); // Sử dụng DataTransfer để chứa nhiều file
                        // Thêm từng file từ Dropzone vào DataTransfer
                        myDropzone.getAcceptedFiles().forEach(function(file) {
                            dataTransfer.items.add(file);
                        });
                        // Gán danh sách file vào input file ẩn
                        hiddenFilesInput.files = dataTransfer.files;
                        // Sau đó submit form bình thường
                        document.getElementById("productForm").submit();
                    } else {
                        // Nếu không có file trong Dropzone, submit form ngay lập tức
                        document.getElementById("productForm").submit();
                    }
                });
            }
        });

        function initTinyMCE(selector, plugins, toolbar, menubar = false, height = null) {
            tinymce.init({
                selector: selector,
                plugins: plugins,
                toolbar: toolbar,
                menubar: menubar,
                height: height
            });
        }
        initTinyMCE(
            '#prd_material',
            'lists link image table code',
            'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            false, 200);
    </script>
@endsection
