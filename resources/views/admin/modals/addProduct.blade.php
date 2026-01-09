<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addProductForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Category</label>
              <select name="category_id" class="form-control" required>
                  @foreach(\App\Models\Category::all() as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="mb-3">
              <label>Description</label>
              <textarea name="description" class="form-control"></textarea>
          </div>
          <div class="mb-3">
              <label>Price</label>
              <input type="number" step="0.01" name="price" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Stock Quantity</label>
              <input type="number" name="stock_quantity" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Image URL</label>
              <input type="text" name="image_url" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Product</button>
        </div>
      </form>
    </div>
  </div>
</div>
