<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id_order';
    public $incrementing = true;
    protected $fillable = [
        'id_user',
        'total_order',
        'shipping_fee',
        'discount',
        'address',
        'status',
        'payment_status',
        'payment_method',
        'phone',
        'note',
        'created_at',
        'updated_at',
        'payment_method_id',
    ];

    protected $attributes = [
        'status' => 'pending',
        'payment_status' => 'unpaid',
        'shipping_fee' => 0,
        'discount' => 0,
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class, 'payment_method_id');
    }
}
