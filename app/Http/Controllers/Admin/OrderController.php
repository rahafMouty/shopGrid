<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function data(Request $request)
    {
        $orders = Order::with('user');

      
    if ($request->filled('status')) {
        $orders->where('status', $request->status);
    }

    if ($request->filled('customer_id')) {
        $orders->where('user_id', $request->customer_id);
    }

    if ($request->filled('from') && $request->filled('to')) {
        $orders->whereBetween('created_at', [
            $request->from . ' 00:00:00',
            $request->to . ' 23:59:59',
        ]);
    }
        return DataTables::of($orders)
            ->addColumn('customer', fn ($o) => $o->user?->name ?? '-')
            ->addColumn('status', fn ($o) => match ($o->status) {
                'pending'   => '<span class="badge bg-warning">Pending</span>',
                'paid'      => '<span class="badge bg-success">Paid</span>',
                'canceled'  => '<span class="badge bg-danger">cancelled</span>',
                default     => $o->status
            })
            ->addColumn('paid_at', fn ($o) =>
                $o->paid_at ? Carbon::parse($o->paid_at)->format('Y-m-d H:i') : ''
            )
            ->addColumn('date', fn ($o) =>
                $o->created_at ? Carbon::parse($o->created_at)->format('Y-m-d H:i') : ''
            )
           ->addColumn('actions', function ($order) {
    return '
        <button class="btn btn-sm btn-primary view-order"
            data-id="'.$order->id.'">
            Details
        </button>
    ';
})

            ->rawColumns(['status', 'actions' ,'date' ,'paid_at'])
            ->make(true);
    }

    // 📦 تفاصيل الطلب
public function show(Order $order)
{
    $order->load(['items.product', 'user']);

    return response()->json([
        'order' => $order
    ]);
}


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,canceled'
        ]);

        // قواعد الانتقال
        if ($order->status === 'canceled') {
            return response()->json(['message' => 'Order is canceled'], 400);
        }

        if ($request->status === 'paid') {
            $order->paid_at = now();
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }
}
