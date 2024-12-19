@extends('admin::layout.master')
@section('title')
    Admin | Edit Comment
@endsection
@section('contents')
    <form action="{{ route('admin.comment.updateComment', ['id' => $detailComment->id]) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h5 class="mb-0">Thông tin cơ bản:</h5>
                    </div>
                    <div class="card-body">

                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="name">Tên Khách Hàng: <b>{{ $detailComment->user_name }}</b></label>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="name">Tên Sản Phẩm: <b>{{ $detailComment->name }}</b></label>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="name">Comment: <b>{{ $detailComment->comments }}</b></label>
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="code">Rating: <b>{{ $detailComment->rating }}</b><span class="fas fa-star"></span></label>
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="code">Comment Date: <b>{{ $detailComment->comment_date }}</b></label>
                            </div>
                            <br>
                            <br>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="status">Hành Động</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="2" {{ $detailComment->status == 2 ? 'selected' : '' }}>Duyệt Bình Luận</option>
                                    <option value="3" {{ $detailComment->status == 3 ? 'selected' : '' }}>Ẩn Bình Luận</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection
