@extends('admin::layout.master')

@section('title')
    Danh sách mã giảm giá
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
    <div class="container mt-4">
        <div class="card mb-3 p-5">
            <div class="mb-3">
                <h3 class="fs-7">Danh sách mã giảm giá</h3>
            </div>
            <div class="mb-3">
                <a name="" id="" class="btn btn-primary" href="{{ route('admin.coupons.create') }}"
                    role="button">Thêm
                    mới</a>
            </div>
            <table class="table table-bordered" id="example" class="display">
                <thead>
                    <tr>
                        <th>Mã</th> <!-- id -->
                        <th>Tên</th> <!-- name -->
                        <th>Mã giảm giá</th> <!-- code -->
                        <th>giá trị giảm</th> <!-- discount_amount -->
                        <th>Loại giảm giá</th> <!-- discount_type -->
                        <th>Số lượng</th> <!-- quantity -->
                        <th>Hành động</th> <!-- action -->
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('api.coupons.index') !!}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        "searchable": false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'discount_amount',
                        name: 'discount_amount'
                    },
                    {
                        data: 'discount_type',
                        name: 'discount_type',
                        render: function(data, type, row) {
                            return data === 'percent' ? 'Phần trăm' : 'Cố định';
                        }
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        "data": null, // Cột Action không lấy từ API mà tự render
                        "render": function(data, type, row) {
                            return `
                                <a href="/admin/coupons/${data.id}/show" class="btn btn-sm btn-info">Xem</a>
                                <a href="/admin/coupons/${data.id}/edit" class="btn btn-sm btn-primary">Sửa</a>
                                <button class="btn btn-sm btn-danger" onclick="deleteRow(${data.id})">Xóa</button>
                                `;
                        },
                        "orderable": false, // Không cho phép sắp xếp cột Action
                        "searchable": false // Không cho phép tìm kiếm theo cột này
                    },
                ]
            });

        });

        function deleteRow(id) {
            // Hiển thị hộp thoại xác nhận với SweetAlert2
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa mã giảm giá này?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Không, hủy bỏ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng chọn "Có, xóa nó!", thực hiện xóa
                    $.ajax({
                        url: `/api/coupons/${id}`, // Địa chỉ URL API để xóa
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Gửi CSRF token để bảo vệ
                        },
                        success: function(response) {
                            Swal.fire(
                                'Đã xóa!',
                                'Mã giảm giá đã được xóa thành công.',
                                'success'
                            );
                            // Tải lại bảng dữ liệu sau khi xóa thành công
                            $('#example').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Lỗi!',
                                'Đã có lỗi xảy ra khi xóa.',
                                'error'
                            );
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Đã hủy',
                        'Mã giảm giá không bị xóa.',
                        'info'
                    );
                }
            });
        }
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
