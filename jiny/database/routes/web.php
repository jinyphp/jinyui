<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Jiny\DB\Http\Controllers\DBTables;
use Jiny\DB\Http\Controllers\DBTableDesc;
Route::middleware(['web'])->prefix('/admin/db')->group(function () {
    Route::resource('/tables', DBTables::class);

    Route::get('/desc/{table}', [DBTableDesc::class, "index"])->name("admin-db-desc.index");
    Route::get('/desc/{table}/create', [DBTableDesc::class, "create"])->name("admin-db-desc.create");
    Route::post('/desc/{table}', [DBTableDesc::class, "store"])->name("admin-db-desc.store");
    Route::get('/desc/{table}/{id}', [DBTableDesc::class, "edit"])->name("admin-db-desc.edit");
    Route::put('/desc/{table}', [DBTableDesc::class, "update"])->name("admin-db-desc.update");
    Route::delete('/desc/{table}', [DBTableDesc::class, "destroy"])->name("admin-db-desc.destroy");
});