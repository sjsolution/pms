<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = ['building_id', 'propertyrental_id', 'total_amount', 'advance', 'remaining','remain_receive','additional_charges', 'payment_type'];

}
