<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="modal-title">Order #{{ $order->id }}</h5>
        <span class="badge 
            @if($order->status === 'pending') bg-warning
            @elseif($order->status === 'paid') bg-success
            @elseif($order->status === 'cancelled') bg-danger
            @else bg-secondary
            @endif
        text-white p-2">{{ ucfirst($order->status) }}</span>
    </div>

    {{-- Order Summary --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</div>
                <div class="col-md-4"><strong>Created At:</strong> {{ $order->created_at->format('d M Y H:i') }}</div>
                <div class="col-md-4 text-end">
                    @if($order->status === 'pending')
                   <button class="btn btn-danger btn-sm" onclick="cancelOrder('{{ $order->id }}')">Cancel Order</button>

                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Items Table --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">${{ number_format($item->price,2) }}</td>
                    <td class="text-end">${{ number_format($item->price * $item->quantity,2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <th colspan="3" class="text-end">Total:</th>
                    <th class="text-end">${{ number_format($order->total_amount,2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
