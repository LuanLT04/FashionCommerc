<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id', 'receiver_id', 'content', 'is_read'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'id_user');
    }
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id', 'id_user');
    }
} 