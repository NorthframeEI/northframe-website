<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('subject')->nullable()->after('number');
        });

        // Reprend le sujet du devis pour les factures existantes
        DB::table('invoices')
            ->whereNull('subject')
            ->whereNotNull('quote_id')
            ->orderBy('id')
            ->each(function ($invoice) {
                $subject = DB::table('quotes')->where('id', $invoice->quote_id)->value('subject');

                DB::table('invoices')->where('id', $invoice->id)->update(['subject' => $subject]);
            });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('subject');
        });
    }
};
