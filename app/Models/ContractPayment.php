<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPayment extends Model
{
    use HasFactory;

    protected $fillable = ['building_id','property_id','name','date','payment_mode','cheque_detail','deposit_date','clearance_date'];
}
