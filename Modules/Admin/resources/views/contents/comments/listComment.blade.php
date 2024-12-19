@extends('admin::layout.master')
@section('title')
    Admin | List Comment
@endsection
@section('contents')
    {{-- <div class="card mb-3">
        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-023429b2-f0b9-4091-bf3c-0936e4daf000"
                    id="dom-023429b2-f0b9-4091-bf3c-0936e4daf000">
                    <table class="table mb-0 data-table fs-10" data-datatables="data-datatables">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort">
                                    <input type="checkbox" name="" id=""  autocomplete="off">
                                </th>
                                <th class="text-900 sort">STT</th>
                                <th class="text-900 sort">Tên Người Dùng</th>
                                <th class="text-900 sort">Tên Sản Phẩm</th>
                                <th class="text-900 sort">Comment</th>
                                <th class="text-900 sort">Rate</th>
                                <th class="text-900 sort">Comment Date</th>
                                <th class="text-900 sort">Loại</th>
                                <th class="text-900 no-sort">Action</th>
                            </tr>
                        </thead>

                        <tbody class="list" id="table-simple-pagination-body">
                            @foreach ($listComment as $key => $item)
                                <tr class="btn-reveal-trigger">
                                    <td><input type="checkbox" name="" id=""  autocomplete="off"></td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->comments }}</td>
                                    <td>{{ $item->rating }}<span class="fas fa-star"></span></td>
                                    <td>
                                        {{ $item->comment_date }}
                                        @if ($item->isNewComment)
                                            <span style="color: red;">
                                                <b class="blink">New <span class="fas fa-fire fire-animation"></span></b>
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @switch($item->status)
                                            @case(1)
                                                <span style="color: orange;"><b>Đang duyệt</b></span>
                                            @break

                                            @case(2)
                                                <span style="color: green;"><b>Đã duyệt</b></span>
                                            @break

                                            @case(3)
                                                <span style="color: gray;"><b>Đã ẩn</b></span>
                                            @break

                                            @default
                                                <span style="color: red;"><b>Không xác định</b></span>
                                        @endswitch
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-primary" role="button"
                                            href="{{ route('admin.comment.editComment', ['id' => $item->id]) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <form id="filter-form" action="{{ route('admin.comment.listComment') }}" method="GET" class="mb-3">
        <div class="row">
            <!-- Lọc theo số sao -->
            <div class="col-md-3">
                <select name="rating_filter" class="form-control">
                    <option value="">-- Lọc theo số sao --</option>
                    <option value="5" {{ request()->get('rating_filter') == 5 ? 'selected' : '' }}>5 Sao</option>
                    <option value="4" {{ request()->get('rating_filter') == 4 ? 'selected' : '' }}>4 Sao</option>
                    <option value="3" {{ request()->get('rating_filter') == 3 ? 'selected' : '' }}>3 Sao</option>
                    <option value="2" {{ request()->get('rating_filter') == 2 ? 'selected' : '' }}>2 Sao</option>
                    <option value="1" {{ request()->get('rating_filter') == 1 ? 'selected' : '' }}>1 Sao</option>
                </select>
            </div>
    
            <!-- Lọc theo trạng thái -->
            <div class="col-md-3">
                <select name="status_filter" class="form-control">
                    <option value="">-- Lọc theo trạng thái --</option>
                    <option value="1" {{ request()->get('status_filter') == 1 ? 'selected' : '' }}>Chưa duyệt</option>
                    <option value="2" {{ request()->get('status_filter') == 2 ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="3" {{ request()->get('status_filter') == 3 ? 'selected' : '' }}>Đã ẩn</option>
                </select>
            </div>
    
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>
    
    <form id="bulk-action-form" action="{{ route('admin.comment.bulkAction') }}" method="POST">
        @csrf
        <input type="hidden" name="action" id="bulk-action">
    
        <div class="mb-3">
            <button type="button" class="btn btn-success" onclick="setBulkAction('approve')">Duyệt hàng loạt</button>
            <button type="button" class="btn btn-secondary" onclick="setBulkAction('hide')">Ẩn hàng loạt</button>
        </div>
    
        <div class="card mb-3">
            
            <div class="card-body px-0">
                <div class="tab-content">
                    <div class="tab-pane preview-tab-pane active" role="tabpanel"
                        aria-labelledby="tab-dom-023429b2-f0b9-4091-bf3c-0936e4daf000"
                        id="dom-023429b2-f0b9-4091-bf3c-0936e4daf000">
                        <table class="table mb-0 data-table fs-10" data-datatables="data-datatables">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-900 sort">
                                        <input type="checkbox" id="check-all" autocomplete="off">
                                    </th>
                                    <th class="text-900 sort">STT</th>
                                    <th class="text-900 sort">Tên Người Dùng</th>
                                    <th class="text-900 sort">Tên Sản Phẩm</th>
                                    <th class="text-900 sort">Bình Luận</th>
                                    <th class="text-900 sort">Sao</th>
                                    <th class="text-900 sort">Ngày Bình Luận</th>
                                    <th class="text-900 sort">Loại</th>
                                    <th class="text-900 no-sort">Hành Động</th>
                                </tr>
                            </thead>
    
                            <tbody class="list" id="table-simple-pagination-body">
                                @foreach ($listComment as $key => $item)
                                    <tr class="btn-reveal-trigger">
                                        <td><input type="checkbox" name="comment_ids[]" value="{{ $item->id }}" autocomplete="off"></td>
                                        <td>{{ $listComment->firstItem() + $key }}</td> <!-- Số thứ tự với phân trang -->
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->comments }}</td>
                                        <td>{{ $item->rating }}<span class="fas fa-star"></span></td>
                                        <td>
                                            {{ $item->comment_date }}
                                            @if ($item->isNewComment)
                                                <span style="color: red;">
                                                    <b class="blink">Mới <span  class="fas fa-fire fire-animation"></span></b>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch($item->status)
                                                @case(1)
                                                    <span style="color: orange;"><b>Đang duyệt</b></span>
                                                @break
    
                                                @case(2)
                                                    <span style="color: green;"><b>Đã duyệt</b></span>
                                                @break
    
                                                @case(3)
                                                    <span style="color: gray;"><b>Đã ẩn</b></span>
                                                @break
    
                                                @default
                                                    <span style="color: red;"><b>Không xác định</b></span>
                                            @endswitch
                                        </td>
                                        <td class="align-middle white-space-nowrap text-end">
                                            <a class="btn btn-primary" role="button"
                                                href="{{ route('admin.comment.editComment', ['id' => $item->id]) }}">Sửa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
    
                        <!-- Phân trang -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $listComment->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
 
    <script>
      
        document.getElementById('check-all').addEventListener('click', function(event) {
            var checkboxes = document.querySelectorAll('input[name="comment_ids[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = event.target.checked;
            });
        });
    
        function setBulkAction(action) {
            document.getElementById('bulk-action').value = action;
            document.getElementById('bulk-action-form').submit();
        }
    </script>
    
    
    <style>
        /* Style cho form lọc */
        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
    
        .filter-form select, .filter-form button {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
    
        .filter-form select:focus, .filter-form button:focus {
            outline: none;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.25);
        }
    
        .filter-form button {
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }
    
        .filter-form button:hover {
            background-color: #0056b3;
        }
    
        /* Style cho bảng dữ liệu */
        .table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
    
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
    
        .table th {
            background-color: #f8f9fa;
            color: #333;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 600;
        }
    
        .table td {
            font-size: 14px;
            color: #495057;
        }
    
        /* Style cho checkbox */
        .table th input[type="checkbox"], .table td input[type="checkbox"] {
            margin: 0;
        }
    
        /* Hover row */
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    
        .pagination li {
            display: inline-block;
            margin: 0 5px;
        }
    
        .pagination li a {
            color: #007bff;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
    
        .pagination li a:hover {
            background-color: #007bff;
            color: white;
        }
    
        .pagination .active a {
            background-color: #007bff;
            color: white;
            border: none;
        }
    
        /* Blink animation */
        .blink {
            animation: blink-animation 1s steps(5, start) infinite;
        }
    
        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }
    
        /* Fire animation */
        .fire-animation {
            color: red;
            animation: fireFlicker 1.5s infinite alternate, colorChange 3s infinite;
        }
    
        @keyframes fireFlicker {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    
        @keyframes colorChange {
            0% {
                color: red;
            }
            50% {
                color: orange;
            }
            100% {
                color: yellow;
            }
        }
    </style>
    
    
@endsection
