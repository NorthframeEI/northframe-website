<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quote_items', function (Blueprint $table) {

            $table->enum('type', [
                'one_time',
                'recurring'
            ])
                ->default('one_time')
                ->after('total');

            $table->enum('billing_period', [
                'monthly',
                'yearly'
            ])
                ->nullable()
                ->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('quote_items', function (Blueprint $table) {

            $table->dropColumn([
                'type',
                'billing_period'
            ]);
        });
    }
};
