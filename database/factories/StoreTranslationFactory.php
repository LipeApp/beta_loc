<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\StoreTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreTranslations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'locale' => 'uz',
            'store_id' => \App\Models\Store::factory(),
        ];
    }
}
