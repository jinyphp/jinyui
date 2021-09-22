<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Jiny\Theme\Http\Controllers\Theme;
Route::middleware(['web'])->prefix('/admin/theme')->name("admin-theme")->group(function () {
    Route::resource('/list', Theme::class);
});



