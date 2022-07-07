<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreTranslations;

class StoreTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreTranslations::factory()
            ->count(5)
            ->create();
    }
}
