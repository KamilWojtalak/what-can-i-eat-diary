<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index.welcome');
})->name('index.home');

require_once __DIR__ . '/partials/days.php';
require_once __DIR__ . '/partials/ingredients.php';
