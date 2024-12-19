@extends('admin::layout.master')
@section('title')
    ADMIN | QUẢN LÝ BANNER - SLIDER
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
                            <h5 class="mb-2 mb-md-0">Quản lý Banner</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th class="text-center">Banner 1</th>
                    <th class="text-center">Banner 2</th>
                </tr>
                <tr>
                    @foreach ($bannerMKT as $bn)
                        <td>
                            @php
                                $url = $bn->img_banner;
                                if (!\Str::contains($url, 'http')) {
                                    $url = \Storage::url($url);
                                }
                            @endphp
                            <img src="{{ $url }}" alt="Banner" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                            <form action="{{ route('admin.banner.cap_nhat', $bn) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="" class="form-label">Ảnh</label>
                                    <input name="hinh_anh" type="file" class="form-control" accept="image/*">
                                    @error('hinh_anh')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                    @error('banner_position')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <input type="hidden" value="3" name="banner_position">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2">
                        @php
                            $url = $bannerMKT4->img_banner;
                            if (!\Str::contains($url, 'http')) {
                                $url = \Storage::url($url);
                            }
                        @endphp
                        <img src="{{ $url }}" alt="Banner" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                        <form action="{{ route('admin.banner.cap_nhat', $bannerMKT4) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label">Ảnh</label>
                                <input name="hinh_anh" type="file" class="form-control" accept="image/*">
                                @error('hinh_anh')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                                @error('banner_position')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <input type="hidden" value="4" name="banner_position">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/js/jquery.min.js') }}"></script>
@endsection
@section('js-setting')
    <!-- JS for Image Preview -->
    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML =
                        `<img src="${e.target.result}" class="img-fluid" style="max-height: 300px; object-fit: cover;">`;
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        }
    </script>
@endsection
