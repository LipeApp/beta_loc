<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Category;
use App\Models\CategoryTranslations;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryAllCategoryTranslationsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_category_all_category_translations()
    {
        $category = Category::factory()->create();
        $allCategoryTranslations = CategoryTranslations::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.all-category-translations.index', $category)
        );

        $response->assertOk()->assertSee($allCategoryTranslations[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_category_all_category_translations()
    {
        $category = Category::factory()->create();
        $data = CategoryTranslations::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.all-category-translations.store', $category),
            $data
        );

        unset($data['category_id']);

        $this->assertDatabaseHas('category_translations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $categoryTranslations = CategoryTranslations::latest('id')->first();

        $this->assertEquals($category->id, $categoryTranslations->category_id);
    }
}
