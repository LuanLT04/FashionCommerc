<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'user_id', 'type', 'amount', 'status', 'description'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
} 