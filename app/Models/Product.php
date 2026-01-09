<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'ai_description',
        'price',
        'image_url',
        'stock_quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
