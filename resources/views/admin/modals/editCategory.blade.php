<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editCategoryForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="category_id" name="category_id">
          <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="hidden" id="category_id" name="category_id">

            <input type="text" class="form-control" id="category_name" name="category_name" required>

          </div>

          <div class="mb-3">
    <label for="category_description" class="form-label">Description</label>
    <textarea class="form-control" id="category_description" name="category_description" rows="3" ></textarea>
</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="updateCategoryBtn">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
