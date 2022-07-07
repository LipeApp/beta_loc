<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserProductsController;
use App\Http\Controllers\Api\UserCategoriesController;
use App\Http\Controllers\Api\CategoryProductsController;
use App\Http\Controllers\Api\StoreTranslationsController;
use App\Http\Controllers\Api\ProductTranslationsController;
use App\Http\Controllers\Api\CategoryTranslationsController;
use App\Http\Controllers\Api\StoreAllStoreTranslationsController;
use App\Http\Controllers\Api\ProductAllProductTranslationsController;
use App\Http\Controllers\Api\CategoryAllCategoryTranslationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware(['auth:sanctum'])
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('changeLanguage')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        // User Categories
        Route::get('/users/{user}/categories', [
            UserCategoriesController::class,
            'index',
        ])->name('users.categories.index');
        Route::post('/users/{user}/categories', [
            UserCategoriesController::class,
            'store',
        ])->name('users.categories.store');

        // User Products
        Route::get('/users/{user}/products', [
            UserProductsController::class,
            'index',
        ])->name('users.products.index');
        Route::post('/users/{user}/products', [
            UserProductsController::class,
            'store',
        ])->name('users.products.store');

        Route::apiResource('categories', CategoryController::class);

        // Category All Category Translations
        Route::get('/categories/{category}/all-category-translations', [
            CategoryAllCategoryTranslationsController::class,
            'index',
        ])->name('categories.all-category-translations.index');
        Route::post('/categories/{category}/all-category-translations', [
            CategoryAllCategoryTranslationsController::class,
            'store',
        ])->name('categories.all-category-translations.store');

        // Category Products
        Route::get('/categories/{category}/products', [
            CategoryProductsController::class,
            'index',
        ])->name('categories.products.index');
        Route::post('/categories/{category}/products', [
            CategoryProductsController::class,
            'store',
        ])->name('categories.products.store');

        Route::apiResource('products', ProductController::class);

        // Product All Product Translations
        Route::get('/products/{product}/all-product-translations', [
            ProductAllProductTranslationsController::class,
            'index',
        ])->name('products.all-product-translations.index');
        Route::post('/products/{product}/all-product-translations', [
            ProductAllProductTranslationsController::class,
            'store',
        ])->name('products.all-product-translations.store');

        Route::apiResource('stores', StoreController::class);

        // Store All Store Translations
        Route::get('/stores/{store}/all-store-translations', [
            StoreAllStoreTranslationsController::class,
            'index',
        ])->name('stores.all-store-translations.index');
        Route::post('/stores/{store}/all-store-translations', [
            StoreAllStoreTranslationsController::class,
            'store',
        ])->name('stores.all-store-translations.store');
    });
