<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with('items.product')
            ->first();

        return view('cart.index', compact('order'));
    }


   public function add(Request $request, Product $product)
{
    try {
        $quantity = $request->quantity ?? 1;

        // إنشاء أو الحصول على الطلب الحالي للمستخدم
        $order = Order::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'pending'
            ],
            [
                'total_amount' => 0
            ]
        );

        // التحقق من وجود المنتج في الطلب
        $item = $order->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        // تحديث المجموع الكلي للطلب
        $order->total_amount = $order->items->sum(fn ($i) => $i->price * $i->quantity);
        $order->save();

        // إذا كان الطلب من الفرونت عبر AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart',
                'order_total' => $order->total_amount
            ]);
        }

        // إعادة التوجيه العادي للطلبات التقليدية
        return redirect()->route('customer.dashboard')->with('success', 'Product added to cart');

    } catch (\Exception $e) {
        // التعامل مع الأخطاء وإرجاع رسالة واضحة للفرونت
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }

        return redirect()->back()->with('error', 'Failed to add product to cart: ' . $e->getMessage());
    }
}


   
   public function update(Request $request, OrderItem $item)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $item->update([
        'quantity' => $validated['quantity']
    ]);

    $order = $item->order;
    $order->total_amount = $order->items
        ->sum(fn ($i) => $i->price * $i->quantity);

    $order->save();

    return back()->with('success', 'Cart updated successfully');
}


    public function remove(OrderItem $item)
    {
        $order = $item->order;
        $item->delete();

        $order->total_amount = $order->items->sum(fn ($i) => $i->price * $i->quantity);
        $order->save();

        return back();
    }
}

