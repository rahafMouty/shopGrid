<?php

namespace App\Actions\Category;

class GetCategoriesAction
{
    use AsAction;

  public function __invoke()
    {
        return DataTables::of(Category::query())
            ->addColumn('actions', function ($category) {
                return view('admin.categories.partials.actions', compact('category'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
