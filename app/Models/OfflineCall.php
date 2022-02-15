<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineCall extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function area(){
        return $this->belongsTo(ServiceArea::class, 'area_id');
    }
}
