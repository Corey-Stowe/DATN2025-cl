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


            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>ảnh</th>
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
                    url: '{{ route('api.users.index') }}',
                    data: function(d) {
                        d.role = $('#role').val();
                        d.search = $('#dt-search-0').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
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
                        data: 'user_image',
                        render: function(data, row) {
                            return data ? `<img src="{{ Storage::url('${data}') }}" width="50" height="50">` : 'không có ảnh';
                        }
                    },

                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <a href="/admin/users/${data.id}/show" class="btn btn-sm btn-info">Xem</a>
                                
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
