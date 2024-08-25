<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'phone_alt',
        'address1',
        'address2',
        'zip',
        'city_id',
        'state_id',
        'country_id',
        'status',
        'attachment_path',
        'location_id',
    ];
}
