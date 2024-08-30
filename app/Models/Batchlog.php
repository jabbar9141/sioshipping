<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batchlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipt_from_country_id',
        'shipt_from_city_id',
        'shipt_to_country_id',
        'shipt_to_city_id',
    ];
        
}
