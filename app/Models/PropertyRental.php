<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','building_id', 'flat_type', 'room_id', 'tenant_name', 'tenant_contact_no', 'tenant_document_type',
        'tenant_document_no', 'tenant_company_name', 'rent_type', 'monthly_rent', 'rent_due_date', 'contract_start', 'contract_expire',
        'total_days', 'start_date', 'end_date',
        'total_amount', 'advance', 'room_rate', 'name', 'pax', 'vehicle', 'mobile_no', 'document_no',
        'expiry_date', 'nationality', 'company_name', 'dob', 'document_type', 'payment_type',
        'board_type', 'place_birth', 'first_child_dob', 'sec_chhild_dob', 'infants', 'email',
        'place_issue', 'address','property_rental'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }

    public function flattype()
    {
        return $this->belongsTo(FlatType::class, 'flat_type', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
