<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 마크다운 페이지
 */
Route::get('/docs/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}',
    [\Jiny\Pages\Http\MarkdownController::class,"index"]);
    
/*
if($_SERVER['PATH_INFO']) {
    $file = $_SERVER['PATH_INFO'].".md";
    $path = resource_path($file);
    
    if(file_exists($path)) {
        $text = file_get_contents($path);
        $text = (new \Parsedown())->text($text);
        return "abc";
        return view("pages.markdown",['content'=>$text]);   
    } 
}
*/
// 테이블에서 라우트 uri 정보를 조회
/*
use Illuminate\Support\Facades\DB;
$r = DB::table('routings')->where('uri', "=", "/company")->first();
if ($r) {
    // 동적 라우트 설정
    Route::get($r->uri, function () use ($r) {
        $table = [
            'name'=>$r->table, //"site_menus",
            'rules'=>"jiny/menu.json"
        ];
        
        return view('sales.company', ['table'=>$table]);
    });
}
*/