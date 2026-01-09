<div class="modal fade" id="orderModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content shadow-lg border-0 rounded-4">

      <!-- Header -->
      <div class="modal-header bg-dark text-white rounded-top-4">
        <div>
          <h5 class="mb-0">Order Details</h5>
          <small class="text-light">Order information & status</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body p-4">

        <!-- Order Info + Status (مرتب في row واحدة) -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <small class="text-muted">Customer</small>
                <h6 class="fw-bold mb-0" id="orderCustomer">—</h6>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <small class="text-muted">Order Total</small>
                <h6 class="fw-bold mb-0 text-success" id="orderTotal">$0.00</h6>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <small class="text-muted">Order Status</small>
                <select id="orderStatus" class="form-select mt-1">
                  <option value="pending">Pending</option>
                  <option value="paid">Paid</option>
                  <option value="cancelled">Canceled</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <!-- Products Table (داخل Card موحد مع الهيدر) -->
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-dark text-white fw-bold">
            Order Items
          </div>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Product</th>
                  <th class="text-center">Qty</th>
                  <th class="text-end">Price</th>
                  <th class="text-end">Total</th>
                </tr>
              </thead>
              <tbody id="order-items">
                <!-- JS content -->
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- Footer -->
      <div class="modal-footer border-0">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button class="btn btn-primary" id="saveOrderStatus">
          Save Changes
        </button>
      </div>

    </div>
  </div>
</div>
