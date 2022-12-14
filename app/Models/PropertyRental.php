<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyRental extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id', 'building_id', 'flat_type', 'room_id', 'tenant_name', 'tenant_contact_no', 'tenant_document_type',
        'tenant_document_no', 'tenant_company_name', 'rent_type', 'monthly_rent', 'rent_due_date', 'contract_start', 'contract_expire',
        'total_days', 'start_date', 'end_date',
        'total_amount', 'advance', 'room_rate', 'name', 'pax', 'vehicle', 'mobile_no', 'document_no',
        'expiry_date', 'nationality', 'tenant_pay_amount', 'tenant_remaining_amount', 'company_name', 'dob', 'document_type', 'payment_type',
        'board_type', 'place_birth', 'first_child_dob', 'sec_chhild_dob', 'infants', 'email',
        'place_issue', 'address', 'property_rental'
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

    public function charges()
    {
        return $this->hasone(Checkout::class, 'propertyrental_id', 'id');
    }
    public function paymenttrack()
    {
        return $this->hasMany(PaymentTrack::class, 'property_id', 'id');
    }
}
