@extends('layouts.main')

@section('title', 'Dashboard, ' . auth()->user()->name)
<div class="position-fixed bottom-1 end-1 p-3" style="z-index: 1055">
    <div id="orderToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="orderToastBody">
                <!-- سيتم ملؤه عبر JS -->
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        {{-- Sidebar --}}
        <aside class="col-md-2 admin-sidebar">
            <h5 class="sidebar-title">MENU</h5>
            <nav class="sidebar-menu">
                <a class="sidebar-item" id="sidebar-orders">My Orders</a>
                <a class="sidebar-item" href="{{ route('customer.shop') }}">Our Product Shop</a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="col-md-10">
            {{-- Orders Section --}}
            <div id="orders">
                <h3>My Orders</h3>
                <table id="orders-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            {{-- Shop Section --}}
            <div id="shop" style="display:none;">
                <h3>Shop Products</h3>
            </div>
        </main>
    </div>
</div>



{{-- Modal لعرض تفاصيل الطلب --}}
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="orderModalBody">
        {{-- سيتم ملؤه عبر AJAX --}}
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
{{-- Bootstrap 5 Modal و DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
let ordersTableInitialized = false;

function loadOrdersTable() {
    if(ordersTableInitialized) return;

    $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("customer.orders.data") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'status', name: 'status' },
            { data: 'date', name: 'date' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'payment_method', name: 'payment_method' },
            { data: 'paid_at', name: 'paid_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
    });

    ordersTableInitialized = true;
}

function showSection(section, element) {
    document.querySelectorAll('.sidebar-item').forEach(el => el.classList.remove('active'));
    if(element) element.classList.add('active');

    document.querySelectorAll('main > div').forEach(div => div.style.display = 'none');
    const sectionDiv = document.getElementById(section);
    if(sectionDiv) sectionDiv.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function() {
    // عرض قسم Orders تلقائيًا
    showSection('orders', document.getElementById('sidebar-orders'));

    // تحميل جدول Orders تلقائيًا
    loadOrdersTable();

    // sidebar click
    document.getElementById('sidebar-orders').addEventListener('click', function() {
        showSection('orders', this);
    });
});

// عرض تفاصيل الطلب في Modal
function viewOrder(orderId) {
    fetch(`/customer/orders/${orderId}`)
    .then(res => res.text())
    .then(html => {
        const modalBody = document.getElementById('orderModalBody');
        modalBody.innerHTML = html;

        // تهيئة وإظهار الـ Modal
        const orderModalEl = document.getElementById('orderModal');
        const orderModal = bootstrap.Modal.getOrCreateInstance(orderModalEl); // Bootstrap 5
        orderModal.show();
    })
    .catch(err => console.error('Error loading order details:', err));
}

// إلغاء الطلب عبر AJAX
function cancelOrder(orderId) {
    if(!confirm('Are you sure you want to cancel this order?')) return;

    fetch(`/customer/orders/${orderId}/cancel`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.message){
            // استدعاء Toast بدلاً من alert
            showToast(data.message, data.success ? 'success' : 'error');
        } else {
            showToast('Unknown response from server.', 'warning');
        }

        // إعادة تحميل الجدول بدون إعادة الصفحة
        $('#orders-table').DataTable().ajax.reload(null, false);
    })
    .catch(err => {
        console.error(err);
        showToast('حدث خطأ أثناء إلغاء الطلب.', 'error');
    });
}


function showToast(message, type = 'success') {
    const toastEl = document.getElementById('orderToast');
    const toastBody = document.getElementById('orderToastBody');

    toastBody.textContent = message;

    // تغيير اللون حسب النوع
    toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
    if(type === 'success') toastEl.classList.add('bg-success');
    else if(type === 'error') toastEl.classList.add('bg-danger');
    else toastEl.classList.add('bg-warning');

    const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    toast.show();
}


</script>

<script>
function payOrder(orderId) {
 const checkoutUrl = "{{ route('customer.checkout') }}"; 

    fetch(checkoutUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ order_id: orderId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.url) {
            window.location.href = data.url;
        } else {
            showToast(data.message || 'Unable to start payment', 'error');
        }
    })
    .catch(() => {
        showToast('Stripe error occurred', 'error');
    });
}
</script>


@endpush
