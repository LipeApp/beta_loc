<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCategoriesTest extends TestCase
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
    public function it_gets_user_categories()
    {
        $user = User::factory()->create();
        $categories = Category::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.categories.index', $user));

        $response->assertOk()->assertSee($categories[0]->image);
    }

    /**
     * @test
     */
    public function it_stores_the_user_categories()
    {
        $user = User::factory()->create();
        $data = Category::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.categories.store', $user),
            $data
        );

        unset($data['user_id']);

        $this->assertDatabaseHas('categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $category = Category::latest('id')->first();

        $this->assertEquals($user->id, $category->user_id);
    }
}
