<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="editProductForm">

          @csrf
          @method('PUT')

          <!-- Hidden ID -->
          <input type="hidden" id="product_id" name="id">

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" id="product_name" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Category</label>
            <select id="product_category_id" name="category_id" class="form-control" required>
              @foreach(\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea id="product_description" name="description" class="form-control"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" id="product_price" name="price" step="0.01" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Stock Quantity</label>
            <input type="number" id="product_stock_quantity" name="stock_quantity" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" id="product_image_url" name="image_url" class="form-control">
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="editProductForm">Update</button>
      </div>

    </div>
  </div>
</div>
