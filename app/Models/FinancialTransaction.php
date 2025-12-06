<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialTransaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'amount',
        'transaction_type',
        'donor_id',
        'orientation',
        'payment_method',
        'attachment',
        'previous_balance',
        'new_balance',
        'description',
        'transaction_date',

    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}
