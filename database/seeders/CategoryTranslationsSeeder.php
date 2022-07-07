<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryTranslations;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryTranslations::factory()
            ->count(5)
            ->create();
    }
}
