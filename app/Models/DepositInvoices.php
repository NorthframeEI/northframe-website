<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositInvoices extends Model
{
     protected $fillable = [
        'quote_id',
        'invoice_id',
        'number',
        'amount',
        'status',
        'issued_at',
        'sent_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'issued_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    /**
     * Le devis associé à la facture d'acompte.
     */
    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * La facture associée à la facture d'acompte.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
