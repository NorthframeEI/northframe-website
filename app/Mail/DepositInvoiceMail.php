<?php

namespace App\Mail;

use App\Models\DepositInvoices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public DepositInvoices $depositInvoice,
        public string $pdfPath
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre facture d\'acompte ' . $this->depositInvoice->number .' - ' . $this->depositInvoice->quote->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.deposit-invoice',
            with : [
                'depositInvoice' => $this->depositInvoice,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk(
                'private',
                $this->pdfPath
            )
                ->as($this->depositInvoice->number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
