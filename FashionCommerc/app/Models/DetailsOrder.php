<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsOrder extends Model
{
    use HasFactory;

    protected $table = 'detailsorder';
    protected $primaryKey = 'id_detailsorder';
    public $incrementing = true;
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity_detailsorder',
        'product_name',
        'image',
    ]; 
}