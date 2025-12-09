<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'serial_number',
        'usage_count',
        'status',
        'is_destructed',
        'destruction_report',
        'destruction_reason',  
        'barcode',
        'is_new',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
