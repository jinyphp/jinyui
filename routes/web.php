<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');







/*
use App\Http\Livewire\Admin\AdminMain;
Route::get('/admin',AdminMain::class);
*/


/*
Route::get('/admin/country',App\Http\Livewire\Admin\BasicCountry::class);
Route::get('/admin/language',App\Http\Livewire\Admin\BasicLanguage::class);
Route::get('/admin/menu',App\Http\Livewire\Admin\BasicMenu::class);
Route::get('/admin/popup',App\Http\Livewire\Popup::class);
*/


use App\Http\Controllers\SiteMenu;
Route::get('/menu', [SiteMenu::class,"index"]);

Route::get('/drag',App\Http\Livewire\Drag::class);






/** demo */
/*
Route::get('layouts/grid/grid5', function () {
    // https://www.youtube.com/watch?v=68O6eOGAGqA&t=16s
    return view('demo.layouts.grid.grid5');
});

Route::get('nav/virtical', function () {
    return view('demo.nav.virtical');
});
Route::get('image/animation', function () {
    return view('demo.image.animation');
});
*/

