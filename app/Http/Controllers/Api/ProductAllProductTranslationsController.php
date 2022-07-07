<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductTranslationsResource;
use App\Http\Resources\ProductTranslationsCollection;

class ProductAllProductTranslationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $allProductTranslations = $product
            ->allProductTranslations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductTranslationsCollection($allProductTranslations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->authorize('create', ProductTranslations::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'info' => ['required', 'max:255', 'string'],
            'title_key' => ['required', 'max:255', 'string'],
            'description_key' => ['required', 'max:255', 'string'],
            'keywords' => ['required', 'max:255', 'string'],
            'locale' => ['required', 'in:uz,ru,en'],
        ]);

        $productTranslations = $product
            ->allProductTranslations()
            ->create($validated);

        return new ProductTranslationsResource($productTranslations);
    }
}
