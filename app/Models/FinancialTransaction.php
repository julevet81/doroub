<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $fillable = [
        'amount',
        'transaction_type',
        'description',
        'date',
    ];
}
