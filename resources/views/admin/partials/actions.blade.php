<button 
    class="btn btn-sm btn-warning edit-btn" 
    data-id="{{ $category->id }}" 
    data-name="{{ $category->name }}" 
    data-bs-toggle="modal" 
    data-bs-target="#editCategoryModal">
    Edit
</button>


<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
