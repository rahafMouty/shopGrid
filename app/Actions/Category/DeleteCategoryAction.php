<?php

namespace App\Actions\Category;

class DeleteCategoryAction
{
  public function execute(Category $category): bool
    {
        return $category->delete();
    }
}
