<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function building()
    {
        return $this->hasOne(Room::class, 'building_id', 'id');
    }
}
