<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePost extends Model
{
    use HasFactory;
    protected $table = 'postimages';
    protected $primaryKey = 'id_postimages';
    protected $fillable = [
        'id_post',
        'id_image_post',
    ];
}
