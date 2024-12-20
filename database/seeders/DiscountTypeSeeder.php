<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discount_types')->insert([
            [
                'name' => 'perc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'fixed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
