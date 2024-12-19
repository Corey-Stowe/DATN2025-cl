@extends('admin::layout.master')

@section('title')
    Danh sách tài khoản
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

@section('contents')
    <div class="container mt-4">
        <div class="card mb-3 p-5">
            <div class="mb-3">
                <h3 class="fs-7">Danh sách tài khoản</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary" role="button">
                        Thêm mới
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <select id="role" name="role" class="form-select me-2" aria-label="Lựa chọn bộ lọc">
                        <option value="">Tất cả chức vụ</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                @switch($role->name)
                                    @case('super_admin')
                                        Quản Trị Viên
                                        @break
                                    @case('comment_manager')
                                        Quản lý bình luận.
                                        @break
                                    @case('coupon_manager')
                                        Quản lý mã giảm giá.
                                        @break
                                    @case('category_manager')
                                        Quản lý danh mục sản phẩm.
                                        @break
                                    @case('post_manager')
                                        Quản lý bài viết.
                                        @break
                                    @case('product_manager')
                                        Quản lý sản phẩm.
                                        @break
                                    @case('attribute_manager')
                                        Quản lý thuộc tính sản phẩm.
                                        @break
                                    @case('tag_manager')
                                        Quản lý tags.
                                        @break
                                    @case('ticket_manager')
                                        Quản lý ticket hỗ trợ khách hàng.
                                        @break
                                    @case('banner_manager')
                                        Quản lý banner.
                                        @break
                                    @case('order_manager')
                                        Quản lý đơn hàng.
                                        @break
                                    @case('wallet_manager')
                                        Quản lý ví và giao dịch.
                                        @break
                                    @case('customer_manager')
                                        Quản lý khách hàng.
                                        @break
                                    @case('statistical_viewer')
                                        Chỉ xem báo cáo và thống kê.
                                        @break
                                    @default
                                        {{ $role->role_type }}
                                @endswitch
                            </option>
                        @endforeach
                    </select>
                    <button type="button" id="filter" class="btn btn-secondary">Lọc</button>
                </div>

            </div>

            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>chức vụ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('api.accounts.index') }}',
                    data: function(d) {
                        d.role = $('#role').val();
                        d.search = $('#dt-search-0').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'user_image',
                        render: function(data, type, row) {
                            return `<img src="{{ Storage::url('${data}') }}" alt="ảnh" class="img-thumbnail" width="50" height="50">`;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {data: 'full_name', name: 'full_name'},
                    {
                        data: 'email',
                        render: function(data, type, row) {
                            return `<a href="mailto:${data}">${data}</a>`;
                        }
                    },
                    {
                        data: 'phone',
                        render: function(data, type, row) {
                            return `<a href="tel:${data}">${data}</a>`;
                        }
                    },
                    {
                    data: 'roles_id',
                    render: function(data, type, row) {
                        var roles = data.split(','); // Tách chuỗi role_id thành một mảng
                        var roleNames = roles.map(function(roleId) {
                            roleId = roleId.trim(); // Loại bỏ dấu cách thừa
                            switch (parseInt(roleId)) {
                                case 1:
                                    return 'Quản trị viên';
                                case 2:
                                    return 'Quản lý bình luận.';
                                case 3:
                                    return 'Quản lý mã giảm giá.';
                                case 4:
                                    return 'Quản lý danh mục sản phẩm';
                                case 5:
                                    return 'Quản lý bài viết.';
                                case 6:
                                    return 'Quản lý sản phẩm.';
                                case 7:
                                    return 'Quản lý thuộc tính sản phẩm.';
                                case 8:
                                    return 'Quản lý tags.';
                                case 9:
                                    return 'Quản lý ticket hỗ trợ khách hàng.';
                                case 10:
                                    return 'Quản lý banner.';
                                case 11:
                                    return 'Quản lý đơn hàng.';
                                case 12:
                                    return 'Quản lý ví và giao dịch.';
                                case 13:
                                    return 'Quản lý khách hàng.';
                                case 14:
                                    return 'Chỉ xem báo cáo và thống kê.';
                                default:
                                    return 'Chưa xác định'; // Nếu không có vai trò khớp
                            }
                        });

                        var maxRoles = 2; // Số lượng vai trò tối đa hiển thị
                            if (roleNames.length > maxRoles) {
                                roleNames = roleNames.slice(0, maxRoles); // Cắt bớt vai trò nếu quá số lượng tối đa
                                roleNames.push('...'); // Thêm dấu ba chấm
                            }

                            // Trả về chuỗi vai trò nối với dấu phẩy và không có dấu cách thừa
                            return roleNames.join(', ');
                    },
                    orderable: false,
                    searchable: false
                },

                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <a href="/admin/accounts/${data.id}/show" class="btn btn-sm btn-info">Xem</a>
                                <a href="/admin/accounts/${data.id}/edit" class="btn btn-sm btn-primary">Sửa</a>
                            `;
                        },
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#filter').on('click', function() {
                table.draw();
            });
        });

        function deleteRow(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa tài khoản này?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Không, hủy bỏ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/accounts/${id}`,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire(
                                'Đã xóa!',
                                'Tài khoản đã được xóa thành công.',
                                'success'
                            );
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
                        'Tài khoản không bị xóa.',
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
                title: "Thất bại",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                title: "Thông tin",
                text: "{{ session('info') }}",
                icon: "info"
            });
        </script>
    @endif
@endsection
