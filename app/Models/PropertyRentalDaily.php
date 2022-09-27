<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRentalDaily extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'flat_type', 'room_id', 'total_days', 'start_date', 'end_date',
        'total_amount', 'advance', 'room_rate', 'name', 'pax', 'vehicle', 'mobile_no', 'document_no',
        'expiry_date', 'nationality', 'company_name', 'dob', 'document_type', 'payment_type',
        'board_type', 'place_birth', 'first_child_dob', 'sec_chhild_dob', 'infants', 'email',
        'place_issue', 'address'
    ];
    public function flattype()
    {
        return $this->belongsTo(FlatType::class, 'flat_type', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }
    
}
