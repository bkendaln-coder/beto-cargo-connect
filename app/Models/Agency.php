<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Agency extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'phone',
        'email',
        'website',
        'city',
        'country',
        'logo',
    ];



    public function customers()
        {
            return $this->hasMany(Customer::class);
        }
}
