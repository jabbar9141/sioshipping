<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'description',
        'ship_from_country_id',
        'ship_from_city_id',
        'ship_to_country_id',
        'ship_to_city_id',
        'ship_from_State_name',
        'ship_to_state_name',
        'total_weight',
        'shipping_cost',
    ];

    public function ship_from_country()
    {
        return $this->belongsTo(Country::class, 'ship_from_country_id');
    }

    public function ship_from_city()
    {
        return $this->belongsTo(City::class, 'ship_from_city_id');
    }

    public function ship_to_country()
    {
        return $this->belongsTo(Country::class, 'ship_to_country_id');
    }

    public function ship_to_city()
    {
        return $this->belongsTo(City::class, 'ship_to_city_id');
    }
}
