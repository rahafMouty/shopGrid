<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Actions\Category\{
    CreateCategoryAction,
    UpdateCategoryAction,
    DeleteCategoryAction,
    GetCategoriesAction
};
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
     public function index()
    {
        return view('admin.dashboard');
    }

    
    public function getData()
    {
        $categories = Category::query();

        return DataTables::of($categories)
            ->addColumn('actions', function ($category) {
                return view('admin.partials.actions', compact('category'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name'
            ]);

            Category::create([
                'name' => $request->category_name,
                'description'=>$request->category_description,
            ]);

            return response()->json(['message' => 'Category added successfully']);
        }
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);


    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->description = $request->description;
    $category->save();

    return response()->json(['success' => true]);
}




    public function destroy(Category $category, DeleteCategoryAction $deleteCategory)
    {
        
    }
}


