<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
// use Storage;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;


class InvoiceController extends Controller
{
    public function bulkActions(Request $request)
    {
        if ($request->btnApply == 'Áp dụng hàng loạt' && $request->slAction != 'sltNull') {
            if ($request->slAction == 'print_invoices') {
                $orders = Order::query()->with('orderItems')->whereIn('id', $request->idOrder)->get();
                $zipFileName = 'invoices_' . now()->format('Ymd_His') . '.zip';
                $zipPath = storage_path('app/public/' . $zipFileName);
                // Tạo file zip
                $zip = new \ZipArchive;
                if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
                    foreach ($orders as $data) {
                        $pdf = PDF::loadView('admin::contents.orders.invoices.view', compact('data'))->setOptions([
                            'isRemoteEnabled' => true,
                            'chroot' => public_path(),
                        ]);
                        $date = Carbon::parse($data->date_create_order)->format('Y-m-d');
                        $fileName = 'invoice-' . $data->id . '-' . Str::slug($data->user_name) . "-$date" . '.pdf';

                        // Tạo file PDF tạm thời
                        $tempPdfPath = storage_path("app/public/temp_$fileName");
                        $pdf->save($tempPdfPath);

                        // Thêm file PDF vào file zip
                        $zip->addFile($tempPdfPath, $fileName);
                    }
                    $zip->close();
                }
                // Xóa các file PDF tạm thời sau khi tạo file zip
                foreach ($orders as $data) {
                    $date = Carbon::parse($data->date_create_order)->format('Y-m-d');
                    $fileName = 'invoice-' . $data->id . '-' . Str::slug($data->user_name) . "-$date" . '.pdf';
                    $tempPdfPath = storage_path("app/public/temp_$fileName");
                    if (file_exists($tempPdfPath)) {
                        unlink($tempPdfPath);
                    }
                }
                // Trả về file zip để tải xuống
                return response()->download($zipPath)->deleteFileAfterSend(true);
            }
            // $status = Order::STATUS_ORDER;
            // if ($request->slAction == 'confirmed') {
            //     foreach ($request->idOrder as $id) {
            //         $data = Order::query()->find($id);
            //         if ($data->status_order != $status['confirmed'] && $data->status_order && $status['shipping'] && $data->status_order != $status['received'] && $data->status_order != $status['canceled']) {
            //             $data->update(['status_order' => $status['confirmed']]);
            //         }
            //     }
            // }
            // if ($request->slAction == 'shipping') {
            //     foreach ($request->idOrder as $id) {
            //         $data = Order::query()->find($id);
            //         if ($data->status_order == $status['confirmed']) {
            //             $data->update(['status_order' => $status['shipping']]);
            //         }
            //     }
            // }
        } else {
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện, vui lòng thử lại!']);
        }
        return redirect()->route('admin.orders.list')->with(['success' => 'Thực hiện thành công!']);
    }
    public function savePDF(Order $order)
    {
        $data = $order::query()->with('orderItems')->findOrFail($order->id);
        $pdf = PDF::loadView('admin::contents.orders.invoices.view', compact('data'))->setOptions(
            [
                'isRemoteEnabled' => true,
                'chroot' => public_path(),
            ]
        );
        $date = Carbon::parse($data->date_create_order)->format('Y-m-d');
        $fileName = 'invoice-' . $data->id . '-' . Str::slug($data->user_name) . "-$date" . '.pdf';
        return $pdf->stream($fileName);
        // return view('admin::contents.orders.invoices.view', compact('data'));
    }
}
