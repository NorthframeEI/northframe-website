<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quote extends Model
{
    protected $fillable = [
        'customer_id',
        'number',
        'subject',
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

    public function isExpired(): bool
    {
        return $this->valid_until->isPast() && $this->status === 'sent';
    }

    /**
     * Les factures d'acompte associées au devis.
     */
    public function depositInvoice(): HasOne
    {
        return $this->hasOne(DepositInvoices::class);
    }
}
