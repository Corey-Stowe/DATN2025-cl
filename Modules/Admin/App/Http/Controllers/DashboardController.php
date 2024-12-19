<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CustomerSupport;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // Lấy 5 đơn hàng mới nhất
        $order = Order::query()
            ->select('id', 'status_order', 'status_payment')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        // Lấy 5 sản phẩm bán chạy nhất
        $bestSell = Product::select('products.id', 'products.name', 'products.price_sale', 'products.sub_category_id', 'products.created_at', 'products.updated_at','products.slug')
        ->join('order_details', 'products.id', '=', 'order_details.product_id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('orders.status_payment', 'Đã thanh toán')
        ->groupBy('products.id', 'products.name', 'products.price_sale', 'products.sub_category_id', 'products.created_at', 'products.updated_at','products.slug')
        ->selectRaw('SUM(order_details.product_quantity) as total_quantity')
        ->orderByDesc('total_quantity')
        ->limit(5)
        ->get();
        // lấy 5 user mới nhất
        $listUser = User::query()
            ->select('id', 'full_name', 'email', 'user_image')
            ->where('roles_id', 2)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        // lấy số lượng Khách hàng
        $countUser = User::query()
            ->select('id', 'full_name', 'email', 'user_image')
            ->where('roles_id', 2)
            ->count();
        // Lấy doanh số cho 12 tháng
        $salesData = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i)->format('Y-m'); // Lấy tháng hiện tại trừ đi i tháng
            $sales = Order::where('created_at', 'like', $month . '%')
                ->where('status_order', 'Đã nhận hàng')
                ->sum('total_price'); // Tính tổng doanh thu cho tháng đó

            $salesData[] = $sales; // Lưu doanh thu theo tháng
        }
        // Đảo ngược mảng để có thứ tự từ tháng 1 đến tháng 12
        $salesData = array_reverse($salesData);



        // lấy 5 phiếu hõ trợ mới nhất
        $listTicket = CustomerSupport::query()
            ->select('ticket_title', 'ticket_id', 'ticket_status', 'user_id')
            ->orderBy('ticket_id', 'desc')
            ->limit(5)
            ->get();

        $month = Carbon::now()->format('m');
        $currentMonth = Carbon::now()->format('Y-m');
        // Lấy thống kê đơn hàng cho tháng hiện tại
        $totalMonthOrders = Order::where('created_at', 'like', $currentMonth . '%')
            ->count();
        $successfulMonthOrders = Order::where('created_at', 'like', $currentMonth . '%')
            ->where('status_order', 'Đã nhận hàng')
            ->count();
        $cancelledMonthOrders = Order::where('created_at', 'like', $currentMonth . '%')
            ->where('status_order', 'Đơn hàng bị hủy')
            ->count();
        // Tính tỷ lệ phần trăm
        $totalProcessedOrders = $successfulMonthOrders + $cancelledMonthOrders;
        $monthSuccessRate = $totalProcessedOrders > 0 ?
            round(($successfulMonthOrders / $totalProcessedOrders) * 100, 2) : 0;
        $monthCancellationRate = $totalProcessedOrders > 0 ?
            round(($cancelledMonthOrders / $totalProcessedOrders) * 100, 2) : 0;

        // lấy doanh thu tháng hiện tại
        $revenue = Order::where('created_at', 'like', $currentMonth . '%')
            ->where('status_order', 'Đã nhận hàng')
            ->sum('total_price');

        $delivering = Order::where('created_at', 'like', $currentMonth . '%')
            ->where('status_order', 'Đang giao hàng')
            ->count();

        $received = Order::where('created_at', 'like', $currentMonth . '%')
            ->where('status_order', 'Đã nhận hàng')
            ->count();

        $revenueOrder = Order::query()
            ->whereNot('created_at', null)
            ->where('status_order', 'Đã nhận hàng')
            ->sum('total_price');

        $listComment = Comment::query()
            ->select('id', 'comments')
            ->orderBy('comment_date', 'desc')
            ->limit(5)
            ->get();
        // dd($listTicket);

        $listPending = Order::query()
        ->where('status_order', 'Chờ xác nhận')
        ->count();

        $coutPost = Post::query()
        ->where('published_id', 1)
        ->count();

        $bestCustomers = User::select(
            'users.id',
            'users.full_name',
            'users.email',
            DB::raw('COUNT(orders.id) as total_orders'),
            DB::raw('SUM(orders.total_price) as total_spend')
        )
        ->join('orders', 'users.id', '=', 'orders.users_id')
        ->where('users.roles_id', 2)
        ->where('orders.status_order', 'Đã nhận hàng')
        ->groupBy('users.id', 'users.full_name','users.email')
        ->orderBy('total_orders', 'desc')
        ->limit(5)
        ->get();


        return view(
            'admin::contents.dashboard',
            compact(
                'order',
                'bestSell',
                'listUser',
                'countUser',
                'salesData',
                'listTicket',
                'successfulMonthOrders',
                'cancelledMonthOrders',
                'currentMonth',
                'month',
                'revenue',
                'totalMonthOrders',
                'delivering',
                'received',
                'revenueOrder',
                'listComment',
                'listPending',
                'coutPost',
                'bestCustomers'
            )
        );

    }
}
