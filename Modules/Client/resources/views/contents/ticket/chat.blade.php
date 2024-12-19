@extends('client::layouts.master')

@section('title')
    Chat box | Thời trang Phong cách Việt
@endsection

@section('contents')
<div class="breadcrumb-area py-4 bg-light">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2 class="mb-3">Thời trang Phong cách Việt</h2>
        </div>
    </div>
</div>

<div class="contact-main-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white py-3 d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Hỗ trợ khách hàng - {{ $detailticket->first()->ticket_title }}</h5>
                            <small>Ticket #{{ $detailticket->first()->ticket_id }} - Khách hàng: {{ $detailticket->first()->full_name }}</small>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="chat-container">
                            <!-- Chat history section with improved styling -->
                            <div id="chatHistory" class="chat-history mb-4" style="height: 500px; overflow-y: auto;">
                                <!-- Initial ticket message -->
                                <div class="message customer-message mb-3">
                                    <div class="message-content">
                                        {{ $detailticket->first()->ticket_content}}
                                    </div>
                                    @if($detailticket->first()->ticket_attachment)
                                    <div class="message-attachment mt-2">
                                        <img src="{{ Storage::url($detailticket->first()->ticket_attachment) }}"
                                             alt="Attachment"
                                             class="img-thumbnail"
                                             style="max-height: 200px;">
                                    </div>
                                    @endif
                                </div>

                                <!-- Chat messages -->
                                @foreach ($detailticket as $chat)
                                    @if($chat->ticket_reply_by == "admin")
                                    <div class="message admin-message mb-3">
                                        <div class="message-content bg-primary text-white">
                                            {{ $chat->ticket_reply }}
                                        </div>
                                        <div class="ai-badge mt-2">
                                            <small>Admin</small>
                                        </div>
                                    </div>
                                    @elseif($chat->ticket_reply_by == "ai")
                                    <div class="message ai-message mb-3">
                                        <div class="message-content bg-info text-white">
                                            {{ $chat->ticket_reply }}
                                            <div class="ai-badge mt-2">
                                                <small>Tự động trả lời bằng AI</small>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="message customer-message mb-3">
                                        <div class="message-content">
                                            {{ $chat->ticket_reply }}
                                        </div>
                                        <div class="ai-badge mt-2">
                                            <small>{{ Auth::user()->full_name }}</small>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Reply form with improved styling -->
                            <form action="{{ route('ticket.sentchat') }}" method="post" class="reply-form">
                                @method('POST')
                                @csrf
                                <div class="mb-3">
                                    <label for="customerResponse" class="form-label fw-bold">Phản hồi:</label>
                                    <textarea
                                        id="customerResponse"
                                        name="response"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Nhập phản hồi của bạn..."
                                        required></textarea>
                                    <input type="hidden" name="ticket_id" value="{{ $detailticket->first()->ticket_id }}">
                                    <input type="hidden" name="reply_by" value="customer">
                                </div>
                                <button type="submit" class="kenne-btn">
                                    <i class="bi bi-send"></i> Gửi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-history {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
}

.message {
    max-width: 80%;
    margin-bottom: 1rem;
}

.message-content {
    padding: 12px 16px;
    border-radius: 12px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.customer-message {
    margin-right: auto;
}

.customer-message .message-content {
    background: #e9ecef;
}

.admin-message {
    margin-left: auto;
}

.admin-message .message-content {
    background: #0d6efd;
}

.ai-message {
    margin-right: auto;
}

.ai-message .message-content {
    background: #0dcaf0;
}

.ai-badge {
    font-size: 0.75rem;
    opacity: 0.9;
}

.reply-form {
    background: #fff;
    border-radius: 8px;
    padding: 1rem;
}

/* Custom scrollbar for chat history */
.chat-history::-webkit-scrollbar {
    width: 6px;
}

.chat-history::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chat-history::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.chat-history::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
@endsection
