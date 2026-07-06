<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();

            $table->foreignId('quote_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('number')->unique();

            $table->enum('status', [
                'draft',
                'sent',
                'partially_paid',
                'paid',
                'overdue',
                'cancelled'
            ])->default('draft');

            $table->decimal('subtotal', 10, 2)->default(0);

            $table->decimal('discount', 10, 2)->default(0);

            $table->decimal('total', 10, 2)->default(0);

            $table->decimal('paid_amount', 10, 2)->default(0);

            $table->date('issued_at')->nullable();

            $table->date('due_date')->nullable();

            $table->text('notes')->nullable();
            $table->string('vat_notice')
                ->default('TVA non applicable, art. 293 B du CGI');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
