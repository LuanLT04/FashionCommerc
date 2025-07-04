<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Image_Post extends Model
{
    use HasFactory;
    protected $table = 'images_posts';
    protected $primaryKey = 'id_image_post';
    public $incrementing = true;
    protected $fillable = [
        'file_name',
    ];
    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'postimages', 'id_image_post', 'id_post');
    }
}
