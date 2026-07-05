<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageStatusHistory extends Model
{
    protected $fillable = [
        'package_id',
        'status',
        'comment',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
