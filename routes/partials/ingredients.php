<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::get('api/v1/ingredients/suggestions', [IngredientController::class, 'searchSuggestions']);
Route::post('api/v1/ingredients/store-new-ingredient', [IngredientController::class, 'storeNewIngredient']);
Route::post('api/v1/ingredients/{day}/save-ingredients', [IngredientController::class, 'saveIngredients']);
