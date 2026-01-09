@extends('layouts.main')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container-fluid py-4">
    <div class="row">

        {{-- Sidebar --}}
            <aside class="col-md-2 admin-sidebar">
                
                <h5 class="sidebar-title">MENU</h5>

                <nav class="sidebar-menu">
                <a class="sidebar-item active" onclick="showSection('categories', this)">Categories</a>
                <a class="sidebar-item" onclick="showSection('products', this)">Products</a>
                <a class="sidebar-item" onclick="showSection('users', this)">Users</a>
                <a class="sidebar-item" onclick="showSection('orders', this)">Orders</a>


                </nav>

            </aside>

        {{-- Main Content --}}
        <main class="col-md-10">

            {{-- Categories --}}
            <section id="categories-section" class="admin-section mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        Add Category
                    </button>
                </div>

                <div class="table-responsive shadow-sm rounded bg-white p-3">
                    <table id="categories-table" class="table table-striped table-hover" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

            {{-- Products --}}
          <section id="products-section" class="admin-section mb-5" style="display:none;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Products</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                </div>

                <div class="table-responsive shadow-sm rounded bg-white p-3">
                    <table id="products-table" class="table table-striped table-hover" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

            <section id="users-section" class="admin-section mb-5" style="display:none;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Users</h2>
                </div>

                <div class="table-responsive shadow-sm rounded bg-white p-3">
                    <table id="users-table" class="table table-striped table-hover" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

            <section id="orders-section" class="admin-section " style="display:none;">
                <div class="d-flex justify-content-between align-items-center mb">
                    <h2>Orders</h2>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="filter-status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="cancelled">Canceled</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="date" id="filter-from" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <input type="date" id="filter-to" class="form-control">
                    </div>
                </div>

                <div class="table-responsive shadow-sm rounded bg-white p-3">
                    <table id="orders-table" class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Paid At</th>
                                <th>Payment Method</th>
                               
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>





                    </main>

    </div>
</div>


@include('admin.modals.addProduct')
@include('admin.modals.editProduct')

@endsection



@include('admin.modals.addCategory')
@include('admin.modals.editCategory')
@include('admin.modals.confirmUserStatus')
@include('admin.modals.orderDetails')

@push('scripts')
<script>
function showSection(sectionId, element) {
    document.querySelectorAll('.admin-section').forEach(s => s.style.display = 'none');
    document.getElementById(sectionId + '-section').style.display = 'block';

    document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
    element.classList.add('active');
}


$(document).ready(function() {
    // DataTable initialization
    $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.categories.data") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
    });

$('#categories-table').on('click', '.edit-btn', function() {
    let id = $(this).data('id');
    let name = $(this).data('name');
    let description = $(this).data('description');

    console.log('Category ID:', id);
    console.log('Category Name:', name);
    console.log('Category Description:', description);

    $('#category_id').val(id);
    $('#category_name').val(name);
    $('#category_description').val(description);

    let route = "{{ route('admin.categories.update', ':id') }}";
    route = route.replace(':id', id);
    $('#editCategoryForm').attr('action', route);
});


});

$('#saveCategoryBtn').click(function () {

    let formData = {
        name: $('input[name="name"]').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        url: "{{ route('admin.categories.store') }}",
        method: "POST",
        data: formData,
        success: function (response) {

            $('#addCategoryModal').modal('hide');
            $('#addCategoryForm')[0].reset();

            // Reload DataTable
            $('#categories-table').DataTable().ajax.reload();

        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;

            if (errors.name) {
                $('#nameError').removeClass('d-none').text(errors.name[0]);
            }
        }
    });
});

$('#updateCategoryBtn').click(function () {
    let categoryId = $('#category_id').val(); // id من الـ hidden input

    $.ajax({
        url: "/admin/categories/" + categoryId, // ← PUT URL الصحيح
        type: "PUT", // ← استخدم PUT
        data: {
            name: $('input[name="category_name"]').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            $('#editCategoryModal').modal('hide');
            $('#editCategoryForm')[0].reset();
            $('#categories-table').DataTable().ajax.reload();
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            if (errors.name) {
                $('#nameError').removeClass('d-none').text(errors.name[0]);
            }
        }
    });
});





$(document).ready(function() {
  let productsTable = $('#products-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.products.data") }}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'image', name: 'image' }, // سيتم عرض الصورة
        { data: 'name', name: 'name' },
        { data: 'category', name: 'category', orderable: false, searchable: false },
        { data: 'description', name: 'description' },
        { data: 'price', name: 'price' },
        { data: 'stock_quantity', name: 'stock_quantity' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
    ]
});


    // عند الضغط على زر Edit
    $('#products-table').on('click', '.edit-btn', function() {
        let row = $(this);
        $('#product_id').val(row.data('id'));
        $('#product_name').val(row.data('name'));
        $('#product_category_id').val(row.data('category_id'));
        $('#product_description').val(row.data('description'));
        $('#product_price').val(row.data('price'));
        $('#product_stock_quantity').val(row.data('stock_quantity'));
        $('#product_image_url').val(row.data('image_url'));

        // تحديث action للـ form
        let route = "{{ route('admin.products.update', ':id') }}".replace(':id', row.data('id'));
        $('#editProductForm').attr('action', route);

        // افتح المودال باستخدام Bootstrap JS
        let modal = new bootstrap.Modal(document.getElementById('editProductModal'));
        modal.show();
    });

    $('#addProductForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.products.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function() {
                $('#addProductModal').modal('hide');
                $('#addProductForm')[0].reset();
                productsTable.ajax.reload();
            }
        });
    });

    // إرسال النموذج عبر AJAX
    $('#editProductForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: "POST", // Laravel يتعرف على PUT من _method
            data: $(this).serialize(),
            success: function(response) {
                $('#editProductModal').modal('hide');
                productsTable.ajax.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
                alert('Failed to update product.');
            }
        });
    });
});



$(document).ready(function() {
let usersTable = $('#users-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.users.data") }}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'status', name: 'status', orderable: false, searchable: false },
        { data: 'date', name: 'date' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
    ]
});
let selectedUserId = null;

$('#users-table').on('click', '.toggle-status', function () {
    selectedUserId = $(this).data('id');
    let name = $(this).data('name');
    let isActive = $(this).data('status');

    let text = isActive == 1
        ? `Are you sure you want to disable ${name}'s account?`
        : `Are you sure you want to enable ${name}'s account?`;

    $('#confirm-text').text(text);

    let modal = new bootstrap.Modal(document.getElementById('confirmUserStatusModal'));
    modal.show();
});

$('#confirmToggleBtn').on('click', function () {
    $.ajax({
        url: '/admin/users/' + selectedUserId + '/toggle-status',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function () {
            $('#confirmUserStatusModal').modal('hide');
            $('#users-table').DataTable().ajax.reload(null, false);
        },
        error: function (xhr) {
            alert(xhr.responseJSON.message ?? 'Action failed');
        }
    });
});

let ordersTable = $('#orders-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route("admin.orders.data") }}',
        data: function (d) {
            d.status = $('#filter-status').val();
            d.customer_id = $('#filter-customer').val();
            d.from = $('#filter-from').val();
            d.to = $('#filter-to').val();
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'customer', name: 'user.name' },
        { data: 'total_amount', name: 'total_amount' },
        { data: 'status', name: 'status', orderable: false, searchable: false },
        { data: 'paid_at', name: 'paid_at' },
        { data: 'payment_method', name: 'payment_method' },
      
         { data: 'date', name: 'date' },


        
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
    ]
});

$('#filter-status, #filter-customer, #filter-from, #filter-to')
    .on('change', function () {
        ordersTable.ajax.reload();
    });



$(document).on('click', '.view-order', function () {
    const orderId = $(this).data('id');
    loadOrderDetails(orderId);
});

function loadOrderDetails(orderId) {
    $.get(`/admin/orders/${orderId}`, function (res) {

      let rows = '';
res.order.items.forEach(item => {
    rows += `
        <tr>
            <td>${item.product.name}</td>
            <td class="text-center">${item.quantity}</td>
            <td class="text-end">${parseFloat(item.price).toFixed(2)}</td>
            <td class="text-end">${(item.quantity * item.price).toFixed(2)}</td>
        </tr>
    `;
});
$('#order-items').html(rows);


        $('#orderCustomer').text(res.order.user.name);
        $('#orderTotal').text(res.order.total_amount);
        $('#orderStatus').val(res.order.status);

        $('#orderModal').modal('show');
    })
    .fail(err => {
        alert('Failed to load order details');
        console.error(err);
    });
}
$('#orderStatus').on('change', function () {
    const colors = {
        pending: 'warning',
        paid: 'success',
        canceled: 'danger'
    };

    $(this)
      .removeClass('border-warning border-success border-primary border-danger')
      .addClass('border-' + colors[this.value]);
});

// تحديث الحالة
$('#updateOrderStatus').click(function () {
    $.post('/admin/orders/' + selectedOrderId + '/status', {
        _token: '{{ csrf_token() }}',
        status: $('#order-status-select').val()
    }, function () {
        $('#orderDetailsModal').modal('hide');
        $('#orders-table').DataTable().ajax.reload(null, false);
    });
});



});


</script>


@endpush
