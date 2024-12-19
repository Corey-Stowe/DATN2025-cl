@extends('admin::layout.master')

@section('title')
    Thông báo
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
    <div class="card overflow-hidden">
        <div class="card-header bg-body-tertiary">
            <div class="row flex-between-center">
                <div class="col-sm-auto">
                    <h5 class="mb-1 mb-md-0">Thông báo</h5>
                </div>
                <div class="col-sm-auto fs-10">
                    <a class="font-sans-serif" href="{{ route('admin.notifications.read') }}">Đánh dấu tất cả là đã đọc</a>
                    {{-- <a class="font-sans-serif ms-2 ms-sm-3" href="#notification-settings-modal" data-bs-toggle="modal">Notification settings</a> --}}
                </div>
            </div>
        </div>
        <div class="card-body fs-10 p-0">
            @foreach ($notifications as $notification)
                <div class="border-bottom-0 
                @if ($notification->is_read == 0) notification-unread @endif 
                notification rounded-0 border-x-0 border-300"
                    href="#!">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl me-3">
                            {{-- <img class="rounded-circle" src="../../assets/img/team/1.jpg" alt=""> --}}
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                                    viewBox="0 0 120 120">
                                    <rect width="16.071" height="15" x="51.964" y="8.999" fill="#ffa400"></rect>
                                    <circle cx="60" cy="97" r="18" opacity=".35"></circle>
                                    <circle cx="60" cy="93" r="18" fill="#ffa400"></circle>
                                    <path fill="#ffc400"
                                        d="M96,82.999H24V53.115c0-19.882,16.118-36,36-36l0,0c19.882,0,36,16.118,36,36V82.999z">
                                    </path>
                                    <rect width="88" height="16" x="16" y="85" opacity=".35"></rect>
                                    <rect width="88" height="16" x="16" y="81" fill="#ffc400"></rect>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><strong>{{ $notification->title }}</strong></p>
                        <span class="notification-time">
                            <span class="me-2" role="img" aria-label="Emoji">📢</span>
                            @php
                                $dataMessage = json_decode($notification->message, true);
                            @endphp
                            {{-- @dd( $dataMessage) --}}
                            {{ $dataMessage['message'] }}
                            @if ($dataMessage['order_id'] != null)
                                <a href="{{ route('admin.orders.detail', $dataMessage['order_id']) }}">Đơn hàng {{ $dataMessage['order_id'] }}</a>
                            @endif
                            @if ($dataMessage['user_id'] !=null)
                                tài khoản <a href="{{ route('admin.users.show', ['id'=>$dataMessage['user_id']]) }}"> {{ $dataMessage['full_name'] }}</a>
                            @endif
                            
                        </span>
                    </div>
                </div>
            @endforeach
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">|
                    </span><br class="d-sm-none"> 2024 © <a href="https://themewagon.com/">Themewagon</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v3.21.0</p>
            </div>
        </div>
    </footer>


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
