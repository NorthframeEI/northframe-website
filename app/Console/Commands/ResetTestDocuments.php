<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ResetTestDocuments extends Command
{
    protected $signature = 'dev:reset-documents';

    protected $description = 'Supprime clients, devis, factures, acomptes, paiements et PDF de test (local uniquement)';

    public function handle(): int
    {
        if (! app()->environment('local')) {
            $this->error('Commande réservée à l’environnement local.');

            return self::FAILURE;
        }

        if (! $this->confirm('Supprimer TOUS les clients, devis, factures, acomptes, paiements et PDF ?')) {
            return self::SUCCESS;
        }

        // Du plus dépendant au moins dépendant.
        $tables = [
            'payments',
            'deposit_invoices',
            'invoice_items',
            'invoices',
            'quote_items',
            'quotes',
            'customers',
        ];

        Schema::disableForeignKeyConstraints();

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
                $this->info("Vidée : {$table}");
            } else {
                $this->warn("Table introuvable, ignorée : {$table}");
            }
        }

        Schema::enableForeignKeyConstraints();

        // PDF stockés dans storage/app/private
        $directories = [
            'quotes',
            'invoices',
            'deposit_invoices',
        ];

        foreach ($directories as $directory) {
            if (Storage::disk('local')->exists($directory)) {
                foreach (Storage::disk('local')->allFiles($directory) as $file) {
                    Storage::disk('local')->delete($file);
                }
                $this->info("Dossier vidé : {$directory}");
            } else {
                $this->warn("Dossier introuvable, ignoré : {$directory}");
            }
        }

        return self::SUCCESS;
    }
}