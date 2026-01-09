<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
     // عرض بيانات DataTables
 public function getData()
{
    $products = Product::with('category')->select('products.*');

    return datatables()->of($products)
      ->addColumn('image', function($product) {
    $url = $product->image_url ?: 'https://via.placeholder.com/50'; // رابط افتراضي إذا لم يكن موجود
    return '<img src="'. $url .'" alt="Product Image" width="50" height="50">';
})

        ->addColumn('category', function($product) {
            return $product->category ? $product->category->name : '';
        })
        ->addColumn('actions', function($product) {
            return view('admin.partials.productActions', compact('product'))->render();
        })
        ->rawColumns(['image', 'actions']) // <-- مهم جدًا للسماح بالـ HTML
        ->make(true);
}


    // إضافة منتج
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
        ]);

        Product::create($request->all());

        return response()->json(['success' => 'Product added successfully.']);
    }

    // تحديث منتج
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json(['success' => 'Product updated successfully.']);
    }

    // حذف منتج
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['success' => 'Product deleted successfully.']);
    }


 

}
