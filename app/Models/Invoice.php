<?php

namespace App\Models;

use App\Enums\DocumentType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'quote_id',
        'type',
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
        'subject',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'due_date' => 'date',
        'type' => DocumentType::class,
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
    public function depositInvoice(): HasOne
    {
        return $this->hasOne(DepositInvoices::class);
    }

    protected function subjectLabel(): Attribute
    {
        return Attribute::get(fn() => $this->subject ?? $this->quote?->subject);
    }
}
