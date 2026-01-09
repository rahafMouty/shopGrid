<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripePaymentController extends Controller
{
    public function checkout(Request $request)
    {

         Stripe::setApiKey(config('services.stripe.secret'));
         Log::info(config('services.stripe.secret'));


        $order = Order::where('id', $request->order_id)
            ->where('user_id', Auth::user()->id)
            ->whereIn('status', ['pending', 'failed'])
            ->firstOrFail();

     

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'customer_email' => Auth::user()->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => (int) ($order->total_amount * 100),
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'order_id' => $order->id,
            ],
            'success_url' => route('customer.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('customer.stripe.cancel'),
        ]);

        $order->update([
            'payment_reference' => $session->id,
            'payment_method' => 'stripe',
            'status' => 'pending'
        ]);

        return response()->json([
            'url' => $session->url
        ]);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::retrieve($request->session_id);

        $order = Order::find($session->metadata->order_id);

        if ($session->payment_status === 'paid') {
            $order->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);
        }

        return redirect()
            ->route('customer.dashboard')
            ->with('success', 'Payment completed successfully');
    }

    public function cancel()
    {
        return redirect()
            ->route('customer.dashboard')
            ->with('error', 'Payment cancelled');
    }
}
