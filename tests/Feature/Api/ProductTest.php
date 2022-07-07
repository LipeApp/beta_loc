<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;

use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
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
    public function it_gets_products_list()
    {
        $products = Product::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.products.index'));

        $response->assertOk()->assertSee($products[0]->image);
    }

    /**
     * @test
     */
    public function it_stores_the_product()
    {
        $data = Product::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.products.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('products', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_product()
    {
        $product = Product::factory()->create();

        $category = Category::factory()->create();
        $user = User::factory()->create();

        $data = [
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.products.update', $product),
            $data
        );

        unset($data['user_id']);

        $data['id'] = $product->id;

        $this->assertDatabaseHas('products', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(route('api.products.destroy', $product));

        $this->assertDeleted($product);

        $response->assertNoContent();
    }
}
