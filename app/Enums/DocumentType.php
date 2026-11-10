<?php

namespace App\Enums;

enum DocumentType: string
{
    case Showcase  = 'showcase';
    case Landing   = 'landing';
    case Freelance = 'freelance';
    case Partner   = 'partner';

    public function label(): string
    {
        return match ($this) {
            self::Showcase  => 'Site vitrine',
            self::Landing   => 'Landing page',
            self::Freelance => 'Mission freelance',
            self::Partner   => 'Collaborateur',
        };
    }
}
