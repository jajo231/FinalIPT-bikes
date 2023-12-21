<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BikePurchase extends Model
{
    protected $fillable = [
        'user_id',
        'bike_id',
        'purchase_date',
    ];

    // Define relationships if necessary
}

