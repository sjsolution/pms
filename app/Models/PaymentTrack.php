<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTrack extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'date', 'amount', 'payment_type'];
}
