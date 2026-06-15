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
        Schema::table('templates', function (Blueprint $table) {
            $table->string('html_path')
                ->nullable()
                ->after('hero_image_url');

            $table->string('css_path')
                ->nullable()
                ->after('html_path');

            $table->string('js_path')
                ->nullable()
                ->after('css_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn([
                'html_path',
                'css_path',
                'js_path',
            ]);
        });
    }
};
