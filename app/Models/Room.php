<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['flat_type', 'property_id', 'room_no'];


    public function building()
    {
        return $this->belongsTo(PropertyRegister::class, 'property_id', 'id');
    }
    public function flattype()
    {
        return $this->belongsTo(FlatType::class, 'flat_type', 'id');
    }
}
