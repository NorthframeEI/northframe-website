<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function postForm(Request $request)
    {
        $data = $request->validate(
            [
                'nom' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email'],
                'entreprise' => ['required', 'string'],
                'type_projet' => ['required', 'string'],
                'template' => ['nullable', 'string'],
                'contenuMessage' => ['required', 'string'],
            ],
            [
                'nom.required' => 'Le nom est obligatoire.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'Veuillez entrer un email valide.',
                'entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
                'type_projet.required' => 'Veuillez sélectionner un type de projet.',
                'contenuMessage.required' => 'Le message est obligatoire.',
            ]
        );

        if ($data['type_projet'] !== 'landing') {
            $data['template'] = null;
        }
        Mail::to(config('mail.contact_address'))
            ->send(new ContactMail(
                $data['nom'],
                $data['email'],
                $data['entreprise'],
                $data['type_projet'],
                $data['template'] ?? null,
                $data['contenuMessage'],
            ));

        return redirect()
            ->route('contact')
            ->with('success', 'Message envoyé avec succès.');
    }
}
