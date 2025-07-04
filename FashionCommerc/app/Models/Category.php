<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_category';
    
    protected $fillable = [
        'name_category',
        'image_category'
    ];

    public static function getTopCategoriesByProductCount($limit = 4)
    {
        return self::select('categories.*')
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take($limit)
            ->get();
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'id_category');
    }

    
}
