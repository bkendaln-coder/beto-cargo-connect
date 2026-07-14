<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agency;

class Package extends Model
{
    protected $fillable = [
        'tracking_number',
        'customer_id',
        'agency_id',
        'description',
        'weight_kg',
        'transport_mode',
        'origin_city',
        'destination_city',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(PackageStatusHistory::class)
                ->latest();
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

}
