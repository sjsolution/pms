<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function flat()
    {
        return $this->hasMany(Room::class, 'flat_type', 'id');
    }
}
