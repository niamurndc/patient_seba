<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function reciver(){
        return $this->belongsTo(User::class, 'reciver_id');
    }
}
