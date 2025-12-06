<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'assistance_category_id',
        'quantity_in_stock',
        'code',
    ];

    public function assistanceCategory()
    {
        return $this->belongsTo(AssistanceCategory::class);
    }

    public function inventoryTransactions()
    {
        return $this->belongsToMany(InventoryTransaction::class, 'inventory_transaction_items')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function projectAssistances()
    {
        return $this->belongsToMany(Project::class);
    }
}
