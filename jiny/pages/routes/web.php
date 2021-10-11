<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 마크다운 페이지 라우트
 * resource/docs 폴더를 스켄하여 페이지를 출력합니다.
 */
$prefix = "docs";
Route::middleware(['web'])
    ->get('/'.$prefix.'/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}/{slug8?}/{slug9?}',
    [\Jiny\Pages\Http\PageController::class,"index"]);

/**
 * 관리자 페이지
 */
use Jiny\Pages\Http\Controllers\AdminPages;
Route::middleware(['web'])
    ->prefix('/admin/pages')->name("admin-pages")->group(function () {
        Route::resource('/list', AdminPages::class);
    });