<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{

public function getOrdersData(Request $request)
{
    $orders = Order::where('user_id', Auth::id())->latest();

    return DataTables::of($orders)
        ->addColumn('date', function ($order) {
            return Carbon::parse($order->created_at)
                ->format('Y-m-d H:i'); // 2026-01-03 14:35
        })
       ->addColumn('paid_at', function ($order) {
            return $order->paid_at ? Carbon::parse($order->paid_at)->format('Y-m-d H:i') : '';
        })

        ->addColumn('status', function ($order) {
            switch ($order->status) {
                case 'pending':
                    $color = 'warning'; // أصفر
                    break;
                case 'paid':
                    $color = 'success'; // أخضر
                    break;
                case 'canceled':
                    $color = 'danger'; // أحمر
                    break;
                default:
                    $color = 'secondary'; // رمادي لأي حالة أخرى
            }

            return '<span class="badge bg-' . $color . '">' . ucfirst($order->status) . '</span>';
        })
        ->addColumn('actions', function ($order) {

            $view = '<button class="btn btn-sm btn-primary me-1"
                        onclick="viewOrder(' . $order->id . ')">
                        View
                     </button>';

            $pay = '';
            if ($order->status === 'pending') {
                $pay = '<button class="btn btn-sm btn-success me-1"
                            onclick="payOrder(' . $order->id . ')">
                            Checkout
                        </button>';
            }

            $cancel = '';
            if ($order->status === 'pending') {
                $cancel = '<button class="btn btn-sm btn-danger"
                                onclick="cancelOrder(' . $order->id . ')">
                                Cancel Order
                            </button>';
            }

            return $view . $pay . $cancel;
        })
        ->rawColumns(['actions' ,'status'])
        ->make(true);
}


 public function view(Order $order)
{
    $order->load('items.product');

    // إرجاع Blade جزئي (Partial) ليعرض داخل Modal
    return view('customer.orders.partials.view', compact('order'));
}

public function cancel(Order $order)
{
    if($order->status !== 'pending') {
        return response()->json(['message' => 'Cannot cancel this order.', 'success' => false], 422);
    }

    $order->update(['status' => 'cancelled']);

    return response()->json(['message' => 'Order cancelled successfully.', 'success' => true]);
}


}
