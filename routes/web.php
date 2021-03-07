<?php

/**
 * Web Routes
 *
 * Register web routes for your application
 *
 * @author  Rheanne McIntosh <rheanne.mcintosh@outlook.com>
 * @version 07-03-2021
 */

// Use Statements
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Home Route
Route::get('/', [FoodController::class, 'listFood'])->middleware('auth');

// Resource Routes
Route::resource('category', CategoryController::class)->middleware('auth');
Route::resource('food', FoodController::class)->middleware('auth');