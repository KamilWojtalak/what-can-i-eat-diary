<?php

use App\Http\Controllers\DayController;
use Illuminate\Support\Facades\Route;

Route::delete('days/{day}/ingredients/{ingredient}', [DayController::class, 'destroyIngredient'])->name('days.ingredients.destroy');

Route::patch('days/{day}/mark-as-bad-day', [DayController::class, 'markAsBadDay'])->name('days.mark-as-bad-day');
Route::resource('days', DayController::class);
