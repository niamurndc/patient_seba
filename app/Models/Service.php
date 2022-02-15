<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function area(){
        return $this->belongsTo(ServiceArea::class, 'area_id');
    }
}
