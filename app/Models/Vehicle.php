<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id', 'id');
    }
}
