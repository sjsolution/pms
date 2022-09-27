<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRegister extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'no_of_flats', 'flat_type', 'flat_id'];

    public function flatype()
    {
        return $this->belongsTo(FlatType::class, 'flat_type', 'id');
    }
    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }
}
