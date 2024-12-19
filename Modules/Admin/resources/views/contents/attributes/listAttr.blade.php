@extends('admin::layout.master')

@section('title')
    Admin | Thuộc tính
@endsection

@section('contents')
    <div class="row g-0">
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="d-flex flex-between-center">
                        @if (session()->has('error'))
                            <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                        @else
                            @if (session()->has('success'))
                                <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                            @else
                                <h5 class="mb-2 mb-md-0">Quản lý thuộc tính</h5>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Danh sách thuộc tính</h6>
                </div>
                <div class="card-body p-0 pb-3">
                    <div class="table-responsive scrollbar">
                        <table class="table mb-0">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-black dark__text-white align-middle" style="width: 200px;">Tên thuộc
                                        tính</th>
                                    <th class="text-black dark__text-white align-middle">Giá trị thuộc tính</th>
                                    <th class="text-black dark__text-white align-middle white-space-nowrap pe-3">Hành động
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="align-middle">Màu sắc</th>
                                    <td class="align-middle">
                                        <div class="row">
                                            @if (count($color) > 0)
                                                @foreach ($color as $item)
                                                    <div class="col-sm-4 mb-3 d-flex" id="valueID-{{ $item->id }}">
                                                        <input type="color" class="form-control form-control-color"
                                                            value="{{ $item->color_value }}" disabled>
                                                        <a class="btn btn-danger"
                                                            onclick="delValue(valueID={{ $item->id }}, urlValue='{{ route('admin.attributes.delValueC', $item->id) }}')">
                                                            <span class="far fa-trash-alt"></span>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @else
                                                <strong class="text-warning">Chưa thêm giá trị cho thuộc tính này!</strong>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-info" href="{{ route('admin.attributes.edit', 'color') }}">Sửa</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">Kích thước</th>
                                    <td class="align-middle">
                                        <div class="row">
                                            @if (count($size) > 0)
                                                @foreach ($size as $item)
                                                    <div class="col-sm-4 mb-3 d-flex" id="valueID-{{ $item->id }}">
                                                        <input type="text" class="form-control"
                                                            value="{{ $item->size_value }}" disabled>
                                                        <a class="btn btn-danger"
                                                            onclick="delValue(valueID={{ $item->id }}, urlValue='{{ route('admin.attributes.delValueS', $item->id) }}')">
                                                            <span class="far fa-trash-alt"></span>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @else
                                                <strong class="text-warning">Chưa thêm giá trị cho thuộc tính này!</strong>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-info" href="{{ route('admin.attributes.edit', 'size') }}">Sửa</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <form action="{{ route('admin.attributes.addAttr') }}" method="POST" class="card mb-3">
                    @csrf
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thêm mới giá trị thuộc tính</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-4">
                                <label class="form-label" for="price_default">Chọn thuộc tính:</label>
                                <select class="form-select" name="sltAttribute" onchange="sltAttrV(this)">
                                    <option value="nullSlt" selected>Trống</option>
                                    <option value="color">Màu sắc</option>
                                    <option value="size">Kích thước</option>
                                </select>
                            </div>
                            <div class="row gx-2 loadAttrValue"></div>
                            <div class="col-6 mb-3">
                                <button type="submit" class="btn btn-success">Thêm mới</button>
                            </div>
                            <div class="col-6 mb-3 loadBtn"></div>
                            @if ($errors->any())
                                <hr>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <label class="form-label text-danger">{{ $error }}</label>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        let loadAttrV = document.querySelector('.row.gx-2.loadAttrValue');

        function sltAttrV(select) {
            let loadBtnMV = document.querySelector('.col-6.mb-3.loadBtn');
            if (select.value == 'color') {
                let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
                loadAttrV.innerHTML = `
                <div class="col-sm-6 mb-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                    <input type="color" class="form-control form-control-color" name="values[]" id="${id}">
                    <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                        <span class="far fa-trash-alt"></span>
                    </button>
                </div>
                `;
                loadBtnMV.innerHTML = `<a class="btn btn-primary" id="btnMore" onclick="addMoreColor()">Thêm giá trị</a>`;
            }
            if (select.value == 'size') {
                let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
                loadAttrV.innerHTML = `
                <div class="col-sm-6 mb-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                    <input type="text" class="form-control" name="values[]" id="${id}">
                    <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                        <span class="far fa-trash-alt"></span>
                    </button>
                </div>
                `;
                loadBtnMV.innerHTML = `<a class="btn btn-primary" id="btnMore" onclick="addMore()">Thêm giá trị</a>`;
            }
            if (select.value == 'nullSlt') {
                loadAttrV.innerHTML = '';
                loadBtnMV.innerHTML = '';
            }
        }

        function removeValue(id) {
            $('#' + id).remove();
        }

        function addMore() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let color = `
            <div class="col-sm-6 mb-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                <input type="text" class="form-control" name="values[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                    <span class="far fa-trash-alt"></span>
                </button>
            </div>
            `;
            $(loadAttrV).append(color);
        }

        function addMoreColor() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let color = `
            <div class="col-sm-6 mb-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                <input type="color" class="form-control form-control-color" name="values[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                    <span class="far fa-trash-alt"></span>
                </button>
            </div>
            `;
            $(loadAttrV).append(color);
        }

        function delValue(valueID, urlValue) {
            if (confirm("Chắc chắn muốn xóa giá trị thuộc tính này?")) {
                $.ajax({
                    url: urlValue,
                    method: "GET",
                    dataType: "JSON",
                    success: function(res) {
                        $('#valueID-' + valueID).remove();
                        alert(res.success);
                    },
                    error: function(res) {
                        alert(res.error);
                    }
                });
            }
        }
    </script>
@endsection
