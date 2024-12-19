<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(7)->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());
        $status = $request->input('status_order');
        $status_payment = $request->input('status_payment');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $orders = Order::query();
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;

        if ($status) {
            $keyStatus =  $statusOrder[$status];
            $orders->where('status_order','like', $keyStatus);
        }
        // dd( $orders->where('status_order','like', $keyStatus)->toRawSql());
        if ($status_payment) {
            $orders->where('status_payment', $status_payment);
        }

        if ($phone) {
            $orders->where('user_phone', 'like', '%' . $phone . '%');
        }

        if ($email) {
            $orders->where('user_email', 'like', '%' . $email . '%');
        }

        if ($startDate && $endDate) {
            $orders->whereBetween('created_at', [$startDate, $endDate]);
        }

        $orders = $orders->paginate(10);

        // dd($orders);

        // Thống kê doanh thu
        $revenue = Order::whereBetween('created_at', [$startDate, $endDate])
        ->sum('total_price');


        // Thống kê 5 user đặt hàng nhiều nhất
        $topUsers = User::select('users.user_name',
            DB::raw('count(orders.users_id) as total_orders'),
            DB::raw('sum(orders.total_price) as total_amount')
            )
            ->join('orders', 'users.id', '=', 'orders.users_id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('users.user_name')
            ->orderBy('total_orders', 'desc')
            ->limit(5)
            ->get();

        // Thống kê 5 sản phẩm bán chạy nhất
        // $topProducts = ProductModel::withCount(['orderDetails' => function ($query) use ($startDate, $endDate) {
        //     $query->join('orders', 'order_details.order_id', '=', 'orders.id')
        //         ->whereBetween('orders.created_at', [$startDate, $endDate]);
        // }])
        // ->orderBy('order_details_count', 'desc')
        // ->limit(5)
        // ->get();
        $topProducts = Product::select(
            'products.id',
            'products.name',
            (DB::raw("(SELECT SUM(od.product_quantity)
                      FROM order_details od
                      JOIN orders o ON od.order_id = o.id
                      WHERE od.product_id = products.id
                      AND o.created_at BETWEEN '$startDate' AND '$endDate') as total_quantity")),
            (DB::raw("(SELECT SUM(od.product_price_final * od.product_quantity)
                      FROM order_details od
                      JOIN orders o ON od.order_id = o.id
                      WHERE od.product_id = products.id
                      AND o.created_at BETWEEN '$startDate' AND '$endDate') as total_revenue"))
        )
        ->orderBy('total_quantity', 'desc')
        ->limit(5)
        ->get();



        // Thống kê đơn hàng theo khoảng thời gian
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Thống kê tỷ lệ thành công của đơn hàng
        $successRate = Order::whereBetween('created_at', [$startDate, $endDate])
        ->whereHas('orderDetails', function ($query) {

            $query->where('status_order','like', 'Đã nhận hàng');
        })->count();


        $successRate = $totalOrders > 0 ? ($successRate / $totalOrders) * 100 : 0;
        //dd($successRate);

        // $statusOrder = Order::STATUS_ORDER;
        // $statusPayment = Order::STATUS_PAYMENT;
        return view('admin::contents.statistical.report', compact(
            'revenue',
            'topUsers',
            'topProducts',
            'totalOrders',
            'successRate',
            'startDate',
            'endDate',
            'orders',
            'statusOrder',
            'statusPayment'
        ));
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status_order');
        $phone = $request->input('phone');
        $email = $request->input('email');

        return Excel::download(new OrdersExport($startDate, $endDate, $status, $phone, $email), 'orders.xlsx');
    }

    public function order(){
       //đơn hàng theo ngày
       $orderData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
       ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
       ->groupBy('date')
       ->orderBy('date')
       ->get();

        $orderLabels = $orderData->pluck('date');
        $orderValues = $orderData->pluck('count');

        return view('admin::contents.statistical.order', compact(
            'orderLabels',
            'orderValues'
        ));
    }



    public function success()
    {
        $successRateData = Order::select(DB::raw('DATE(created_at) as date'))
        ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $successRateLabels = $successRateData->pluck('date');

        $successRateValues = $successRateData->map(function ($item) {
            $totalOrders = Order::whereDate('created_at', $item->date)->count();
            $successfulOrders = Order::whereDate('created_at', $item->date)
                ->where('status_order', 'Đã nhận hàng')
                ->count();
            return $totalOrders > 0 ? ($successfulOrders / $totalOrders) * 100 : 0;
        });


        return view('admin::contents.statistical.success', compact(
            'successRateLabels',
            'successRateValues'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.statistical.index');
    }

    /**
     * Show the specified resource.
     */
    public function revenue()
    {
         //doanh thu theo ngày trong 7 ngày qua
         $revenueData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total'))
         ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
         ->groupBy('date')
         ->orderBy('date')
         ->get();

         $revenueLabels = $revenueData->pluck('date');
         $revenueValues = $revenueData->pluck('total');


         return view('admin::contents.statistical.revenue', compact(
             'revenueLabels',
             'revenueValues'
         ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        return redirect()->route('admin.statistical.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
