@extends('admin::layout.master')
@section('title')
    Falcon | Sửa trang cá nhân
@endsection
@section('script')

@endsection
@section('contents')
    <div class="card h-100">
        <div class="card-header bg-body-tertiary py-3">
            <h6 class="mb-0">Sửa thông tin </h6>
        </div>
        <div class="card-body">
            <div class="echart-browsed-courses h-100" >
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('admin.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card mb-3">
                                    <div class="card-header bg-body-tertiary">
                                        <h6 class="mb-0">Sửa ảnh</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row gx-2">
                                            <div class="col-12 mb-3">
                                                <img src="{{ Storage::url($profile->user_image) }}" class="img-fluid" width ="200" alt="Hình ảnh">
                                            </div>
                                        </div>  
                                        <div class="row gx-2">
                                            <div class="col-12 mb-3">
                                                <input class="form-control" name="user_image" id="user_image" type="file"  />
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header bg-body-tertiary">
                                        <h6 class="mb-0">Sửa tài khoản</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row gx-2">
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Tên đăng nhập</label>
                                                <input class="form-control" name="user_name" id="user_name" type="text" value="{{ $profile->user_name }}" readonly/>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Họ và tên</label>
                                                <input class="form-control" name="full_name" id="full_name" type="text" value="{{ $profile->full_name }}" />
                                                    @error('full_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Email</label>
                                                <input class="form-control" name="email" id="email" type="email" value="{{ $profile->email }}" />
                                                    @error('email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Số điện thoại</label>
                                                <input class="form-control" name="phone" id="phone" type="text" value="{{ $profile->phone }}" />
                                                    @error('phone')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Địa chỉ</label>
                                                <input class="form-control" name="address" id="address" type="text" value="{{ $profile->address }}" />    
                                                    @error('address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Mật khẩu hiện tại</label>
                                                <input class="form-control"  name="current_password" id="password" type="password" />
                                                    @error('current_password')
                                                        <p class="text-danger">{{ $message }}</p>  
                                                    @enderror
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Mật khẩu mới</label>
                                                <input class="form-control" name="new_password" id="new_password" type="password" />
                                                    @error('new_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="form-control" class="form-label">Xác nhận mật khẩu mới</label>
                                                <input class="form-control" name="new_password_confirmation" id="new_password_confirmation" type="password" />
                                                    @error('new_password_confirmation')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-body-tertiary py-2">
            <div class="row flex-between-center g-0">
                <div class="col-auto"></div>
                <div class="col-auto"><a class="btn btn-link btn-sm px-0 fw-medium" href="{{ route('admin.profile.index') }}">Trở lại<span class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
            </div>
        </div>
    </div>
@endsection
@section('js-setting')
    <script src="{{ asset('theme/admin/vendors/echarts/echarts.min.js') }}"></script>
@endsection
