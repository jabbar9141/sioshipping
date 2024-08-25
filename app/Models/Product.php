<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price_per_tonne',
        'price_per_kg',
        'origin_port',
        'supported_ports',
        'shipping_terms',
        'image',
        'description'
    ];
}
