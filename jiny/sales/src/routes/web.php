<?php
use Illuminate\Support\Facades\Route;

use Jiny\Sales\Http\Controllers\Company;
Route::get('/company', [Company::class,"index"]);
Route::delete('/company', [Company::class,"delete"]);
