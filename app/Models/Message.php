<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'body',
        'conversation_id',
        'type'
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'sender_id');
    }
}

