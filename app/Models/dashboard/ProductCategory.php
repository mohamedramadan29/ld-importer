<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
