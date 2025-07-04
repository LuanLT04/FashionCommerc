<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    use HasFactory;
    protected $table = 'review_comments';
    protected $fillable = [
        'review_id', 'id_user', 'parent_id', 'content', 'images'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function parent()
    {
        return $this->belongsTo(ReviewComment::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(ReviewComment::class, 'parent_id');
    }
    public function likes()
    {
        return $this->hasMany(\App\Models\ReviewLike::class, 'review_id', 'id');
    }
} 