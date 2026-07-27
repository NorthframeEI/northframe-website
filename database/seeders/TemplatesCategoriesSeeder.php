<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplatesCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates_categories')->insert([
            [
                'name' => 'SaaS',
                'slug' => 'saas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Événement',
                'slug' => 'evenement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Restauration',
                'slug' => 'restauration',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Génération de prospects',
                'slug' => 'lead-generation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
