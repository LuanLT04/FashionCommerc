<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewLike extends Model
{
    use HasFactory;
    protected $table = 'review_likes';
    protected $fillable = [
        'review_id', 'id_user'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
} 