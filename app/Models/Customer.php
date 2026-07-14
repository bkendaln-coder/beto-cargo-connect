<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agency;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'city',
        'country',
        'agency_id',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
     }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

}
