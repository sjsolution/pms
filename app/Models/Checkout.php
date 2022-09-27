<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = ['propertyrental_id', 'total_amount', 'advance', 'remaining', 'additional_charges', 'payment_type'];
}
