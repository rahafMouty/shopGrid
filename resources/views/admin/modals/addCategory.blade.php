<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Add New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="addCategoryForm">

          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" required>
            <small class="text-danger d-none" id="nameError"></small>
          </div>
<div class="mb-3">
    <label for="category_description" class="form-label">Description</label>
    <textarea class="form-control" id="category_description" name="category_description" rows="3" required></textarea>
</div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveCategoryBtn">Save</button>
      </div>

    </div>
  </div>
</div>
