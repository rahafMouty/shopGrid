<?php

namespace App\Actions\Category;

class CreateCategoryAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function execute(array $data): Category
    {
        return Category::create($data);
    }
}
