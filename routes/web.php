<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '[\/\w\.-]*');
