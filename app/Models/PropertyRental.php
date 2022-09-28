<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'flat_type', 'room_id', 'tenant_name', 'tenant_contact_no', 'tenant_document_type',
        'tenant_document_no', 'tenant_company_name', 'rent_type', 'monthly_rent', 'rent_due_date', 'contract_start', 'contract_expire'
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
