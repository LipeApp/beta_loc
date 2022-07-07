<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryTranslationsResource;
use App\Http\Resources\CategoryTranslationsCollection;

class CategoryAllCategoryTranslationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $allCategoryTranslations = $category
            ->allCategoryTranslations()
            ->search($search)
            ->latest()
            ->paginate();

        return new CategoryTranslationsCollection($allCategoryTranslations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->authorize('create', CategoryTranslations::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'title_key' => ['nullable', 'max:255', 'string'],
            'description_key' => ['required', 'max:255', 'string'],
            'keywords' => ['required', 'max:255', 'string'],
            'locale' => ['required', 'in:uz,ru,en'],
        ]);

        $categoryTranslations = $category
            ->allCategoryTranslations()
            ->create($validated);

        return new CategoryTranslationsResource($categoryTranslations);
    }
}
