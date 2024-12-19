@extends('admin::layout.master')
@section('title', 'Tạo một vé mới')
@section('contents')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    /* Styling for the search result dropdown */
    .search-results {
        position: absolute;
        border: 1px solid #ccc;
        background-color: #fff;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }
    .search-results div {
        padding: 8px;
        cursor: pointer;
    }
    .search-results div:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="container mt-4">
    <div class="card mb-3 p-5">
        <div class="mb-3 row">
            <div class="col-md-6">
                <h3>Thêm vé tạo vẽ hỗ trợ mới</h3>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <form action="{{ route('admin.ticket.store') }}" method="post">
            @csrf

            <!-- Customer Information Box -->
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 position-relative">
                            <label for="ma_kh" class="form-label">Mã khách hàng</label>
                            <input type="text" class="form-control" id="ma_kh" name="ma_kh" onkeyup="searchCustomer()" autocomplete="off">
                            <div id="search-results" class="search-results"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" id="name" name="name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Details Box -->
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Thông tin vé hỗ trợ</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Thể loại</label>
                            <select class="form-select" id="category" name="category">
                                <option value="account">Tài khoản</option>
                                <option value="product">Sản phẩm</option>
                                <option value="order">Đơn hàng</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Tạo mới</button>
            </div>
        </form>
    </div>
</div>

<script>
    function searchCustomer() {
        let keyword = $('#ma_kh').val();
        if (keyword.length > 2) { // Only search if more than 2 characters entered
            $.ajax({
                url: 'http://127.0.0.1:8000/api/supports/customer',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ "keyword": keyword }),
                success: function(data) {
                    let resultBox = $('#search-results');
                    resultBox.empty(); // Clear previous results
                    if (data.length > 0) {
                        data.forEach(function(customer) {
                            resultBox.append('<div onclick="selectCustomer(' + customer.id + ')">' + customer.full_name + '</div>');
                        });
                    } else {
                        resultBox.append('<div>Không tìm thấy kết quả nào</div>');
                    }
                }
            });
        } else {
            $('#search-results').empty(); // Clear results if input is cleared
        }
    }

    function selectCustomer(id) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/supports/customer/' + id, // Assuming you have a route to get customer by ID
            method: 'GET',
            success: function(customer) {
                $('#name').val(customer.full_name);
                $('#email').val(customer.email);
                $('#phone').val(customer.phone);
                $('#ma_kh').val(customer.id); // Set the customer ID to the hidden input
                $('#search-results').empty(); // Hide search results after selection
            }
        });
    }
</script>
@endsection
