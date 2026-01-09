<?php

namespace App\Http\Controllers\Customer\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
        {
            $product = Product::with('category')->findOrFail($id);
            return view('customer.products.show', compact('product'));
        }

           public function shop()
  {
    $categories =Category::all();
    $products =Product::with('category')->paginate(12); // جلب 12 منتج لكل صفحة
    return view('customer.shop', compact('products' ,'categories'));
   }
}
