<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CategoryTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryTranslations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text,
            'title_key' => $this->faker->text,
            'description_key' => $this->faker->text,
            'keywords' => $this->faker->text,
            'locale' => 'uz',
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
