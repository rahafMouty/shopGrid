<button 
    class="btn btn-sm btn-warning edit-btn" 
    data-id="{{ $product->id }}" 
    data-name="{{ $product->name }}" 
    data-category_id="{{ $product->category_id }}" 
    data-description="{{ $product->description }}" 
    data-price="{{ $product->price }}" 
    data-stock_quantity="{{ $product->stock_quantity }}" 
    data-image_url="{{ $product->image_url }}" 
    data-bs-toggle="modal" 
    data-bs-target="#editProductModal">
    Edit
</button>

<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
