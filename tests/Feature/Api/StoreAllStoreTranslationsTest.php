<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Store;
use App\Models\StoreTranslations;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreAllStoreTranslationsTest extends TestCase
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
    public function it_gets_store_all_store_translations()
    {
        $store = Store::factory()->create();
        $allStoreTranslations = StoreTranslations::factory()
            ->count(2)
            ->create([
                'store_id' => $store->id,
            ]);

        $response = $this->getJson(
            route('api.stores.all-store-translations.index', $store)
        );

        $response->assertOk()->assertSee($allStoreTranslations[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_store_all_store_translations()
    {
        $store = Store::factory()->create();
        $data = StoreTranslations::factory()
            ->make([
                'store_id' => $store->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.stores.all-store-translations.store', $store),
            $data
        );

        unset($data['store_id']);

        $this->assertDatabaseHas('store_translations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $storeTranslations = StoreTranslations::latest('id')->first();

        $this->assertEquals($store->id, $storeTranslations->store_id);
    }
}
