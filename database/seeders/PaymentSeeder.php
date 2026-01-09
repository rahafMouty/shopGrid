<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => collect(['card', 'paypal', 'cash_on_delivery'])->random(),
                'amount' => $order->total_amount,
            ]);
        }
    }
}
