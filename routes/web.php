<?php

use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;


Route::resource("word", WordController::class);
Route::resource("translation", TranslationController::class)->only(["store", "update", "destroy"]);
