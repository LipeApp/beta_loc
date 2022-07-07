<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProductTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductTranslations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'locale' => 'uz',
            'title' => $this->faker->sentence(10),
            'info' => $this->faker->text,
            'title_key' => $this->faker->text,
            'description_key' => $this->faker->text,
            'keywords' => $this->faker->text,
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
