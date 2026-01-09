@extends('layouts.main')

@section('title', 'My Cart')

@section('content')
<div class="container mt-5">

    <h2>Shopping Cart</h2>

    @if(!$order || $order->items->count() === 0)
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th width="120">Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>${{ $item->price }}</td>
                        <td>
                            <form action="{{ route('customer.cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity"
                                    value="{{ $item->quantity }}"
                                    min="1"
                                    class="form-control"
                                    onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>${{ $item->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: ${{ $order->total_amount }}</h4>

        <a href="#" class="btn btn-success">Checkout</a>
    @endif

</div>
@endsection
