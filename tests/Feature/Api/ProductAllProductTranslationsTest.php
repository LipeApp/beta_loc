<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductTranslations;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductAllProductTranslationsTest extends TestCase
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
    public function it_gets_product_all_product_translations()
    {
        $product = Product::factory()->create();
        $allProductTranslations = ProductTranslations::factory()
            ->count(2)
            ->create([
                'product_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.all-product-translations.index', $product)
        );

        $response->assertOk()->assertSee($allProductTranslations[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_product_all_product_translations()
    {
        $product = Product::factory()->create();
        $data = ProductTranslations::factory()
            ->make([
                'product_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.all-product-translations.store', $product),
            $data
        );

        unset($data['product_id']);

        $this->assertDatabaseHas('product_translations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $productTranslations = ProductTranslations::latest('id')->first();

        $this->assertEquals($product->id, $productTranslations->product_id);
    }
}
