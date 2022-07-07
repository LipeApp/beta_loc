<?php

namespace App\Http\Controllers\Api;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreTranslationsResource;
use App\Http\Resources\StoreTranslationsCollection;

class StoreAllStoreTranslationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Store $store
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Store $store)
    {
        $this->authorize('view', $store);

        $search = $request->get('search', '');

        $allStoreTranslations = $store
            ->allStoreTranslations()
            ->search($search)
            ->latest()
            ->paginate();

        return new StoreTranslationsCollection($allStoreTranslations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Store $store
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Store $store)
    {
        $this->authorize('create', StoreTranslations::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'locale' => ['required', 'in:uz,ru,en'],
        ]);

        $storeTranslations = $store->allStoreTranslations()->create($validated);

        return new StoreTranslationsResource($storeTranslations);
    }
}
