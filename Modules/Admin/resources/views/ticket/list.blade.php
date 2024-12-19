@extends('admin::layout.master')
@section('title', 'Hỗ trợ khách hàng')

@section('contents')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container mt-4">
        <!-- Card header for the title and action buttons -->
        <div class="card mb-3 p-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="mb-0">Danh sách hỗ trợ</h3>
                    <a href="{{ route('admin.ticket.create') }}" class="btn btn-primary mt-2">Tạo vé mới</a>
                    {{-- searchbar --}}
                    <div class="mt-2">
                        <form action="{{ route('admin.ticket.search') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo mã vé hoặc tên khách hàng">
                                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                        {{-- date to date --}}
                        {{-- <form action="#" method="POST">
                            @csrf
                            <div class="input-group mt-2">
                                <input type="date" class="form-control" name="from_date">
                                <input type="date" class="form-control" name="to_date">
                                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm theo ngày</button>
                            </div>
                        </form> --}}
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.ticket.spam') }}" class="btn btn-outline-danger ms-2">
                        Spam
                        <span class="badge bg-danger">{{ $countSpam }}</span>
                    </a>
                    <a href="{{ route('admin.ticket.close') }}" class="btn btn-outline-success ms-2">
                        Hoàn thành
                        <span class="badge bg-success">{{ $countClose }}</span>
                    </a>
                    <a href="{{ route('admin.ticket.open') }}" class="btn btn-outline-warning ms-2">
                        Mở
                        <span class="badge bg-warning">{{ $countOpen }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Ticket Table -->
        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example">
                    <thead class="table-light">
                        <tr>
                            <th>Mã vé</th>
                            <th>Tên khách hàng</th>
                            <th>Tiêu đề</th>
                            <th>Ngày Tạo</th>
                            <th>Tình trạng</th>
                            <th>Thể loại</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listTicket as $item)
                        <tr>
                            <td>{{ $item->ticket_id }}</td>
                            <td>{{ $item->full_name}}</td>
                            <td>{{ $item->ticket_title }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($item->ticket_status == 1)
                                    <span class="badge bg-warning">Mở</span>
                                @elseif($item->ticket_status == 2)
                                    <span class="badge bg-success">Hoàn thành</span>
                                @else
                                    <span class="badge bg-danger">Spam</span>
                                @endif
                            </td>
                            <td>{{ ucfirst($item->ticket_category) }}</td>
                            <td>
                                <a href="{{ route('admin.ticket.show', ['id' => $item->ticket_id, 'user_id' => $item->user_id]) }}" class="btn btn-primary btn-sm" >Xem</a>
                               @if($item->ticket_status == 1)
                               <a href="{{ route('admin.ticket.setSpam', ['id' => $item->ticket_id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn chuyển sang spam không?')">Spam</a>
                               <a href="{{ route('admin.ticket.setComplete', ['id' => $item->ticket_id]) }}" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc chắn muốn chuyển sang hoàn thành không?')" >Hoàn thành</a>
                                @else
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
