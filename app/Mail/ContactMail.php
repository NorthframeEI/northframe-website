<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $nom,
        public string $email,
        public string $entreprise,
        public string $type_projet,
        public ?string $template,
        public string $contenuMessage,
    ) {}

    public function envelope(): Envelope
    {
        $typeProjet = "Projet Inconnu";
        if ($this->type_projet === 'vitrine') {
            $typeProjet = "Site Vitrine";
        } elseif ($this->type_projet === 'landing') {
            $typeProjet = "Landing Page";
        }elseif($this->type_projet === 'freelance'){
            $typeProjet = "Renfort technique/Freelance";
        }elseif($this->type_projet === 'refonte'){
            $typeProjet = "Refonte de site";
        }elseif($this->type_projet === 'maintenance_ponctuelle'){
            $typeProjet = "Maintenance Ponctuelle";
        }elseif($this->type_projet === 'conseil'){
            $typeProjet = "Demande de conseil";
        }
        return new Envelope(
            subject: "[Northframe] {$typeProjet} - {$this->entreprise}"

        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'nom' => $this->nom,
                'email' => $this->email,
                'entreprise' => $this->entreprise,
                'type_projet' => $this->type_projet,
                'template' => $this->template,
                'contenuMessage' => $this->contenuMessage,
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
        return [];
    }
}
