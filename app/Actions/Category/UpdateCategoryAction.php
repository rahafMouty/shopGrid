<?php

namespace App\Actions\Category;

class UpdateCategoryAction
{
    public function execute(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }
}
