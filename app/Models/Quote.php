<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Customer;

class Quote extends Model
{
    protected $fillable = [
        'customer_id',
        'number',
        'issued_at',
        'status',
        'subtotal',
        'discount',
        'total',
        'valid_until',
        'notes',
        'vat_notice',
    ];

    protected $casts = [
        'valid_until' => 'date',
        'issued_at' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }
}