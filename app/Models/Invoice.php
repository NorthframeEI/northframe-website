<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'quote_id',
        'number',
        'status',
        'subtotal',
        'discount',
        'total',
        'paid_amount',
        'issued_at',
        'due_date',
        'notes',
        'vat_notice',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'due_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Les factures d'acompte associées à la facture.
     */
    public function depositInvoices(): HasMany
    {
        return $this->hasMany(DepositInvoices::class);
    }
}
