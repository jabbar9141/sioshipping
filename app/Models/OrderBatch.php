<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dispatcher_id',
        'status',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function dispatcher()
    {
        return $this->belongsTo(Dispatcher::class);
    }
}
