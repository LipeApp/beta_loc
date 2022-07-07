<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        /*$this->call(CategorySeeder::class);
        $this->call(CategoryTranslationsSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductTranslationsSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(StoreTranslationsSeeder::class);
        $this->call(UserSeeder::class);*/
    }
}
