<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 마크다운 페이지 라우트
 * resource/docs 폴더를 스켄하여 페이지를 출력합니다.
 */
$prefix = "docs";
/*
Route::get('/'.$prefix.'/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}',
    [\Jiny\Pages\Http\MarkdownController::class,"index"]);
*/
Route::middleware(['web'])
    ->get('/'.$prefix.'/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}',
    [\Jiny\Pages\Http\MarkdownController::class,"index"]);



/*
Route::get('/'.$prefix.'/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}',
    \Jiny\Pages\Http\Livewire\LiveMarkdown::class);
*/