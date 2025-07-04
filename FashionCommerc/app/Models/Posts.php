<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image_Post;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id_post';
    public $incrementing = true;
    protected $fillable = [
        'title_post',
        'content_post',
    ];
    public function images()
    {
        return $this->belongsToMany(Image_Post::class, 'postimages', 'id_post', 'id_image_post');
    }

    // Query Methods
    public static function getPostWithPagination($perPage = 2)
    {
        return self::paginate($perPage);
    }
}