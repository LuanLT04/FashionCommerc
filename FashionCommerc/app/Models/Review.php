<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'id_product', 'id_user', 'rating', 'content', 'images'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
    public function comments()
    {
        return $this->hasMany(ReviewComment::class, 'review_id')->whereNull('parent_id');
    }
    public function likes()
    {
        return $this->hasMany(ReviewLike::class, 'review_id');
    }
} 