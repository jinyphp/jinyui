<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/**
 * 테이터베이스 리소스 라우터 설정
 */
use Illuminate\Support\Facades\DB;
use Jiny\Action\Http\Controllers\Actions;


if(isset($_SERVER['PATH_INFO'])) {
    $server = explode('/', $_SERVER['PATH_INFO']);

    $pdo = DB::connection()->getPdo();
    if(dbIsTable($pdo, "actions")) {
        $query = "SELECT * from actions where enable=1"; // 테이블 목록
        $stmt = $pdo->query($query); // 쿼리준비

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // prefix가 존재하는 경우, 우선적으로 검사
            if($row['prefix'] && $server[1] != "livewire") { //livewire 통신은 제외
                if(!checkPrefix($row['prefix'], $server)) {
                    continue;
                }
            }

            $name = ltrim(str_replace("/","-",$row['prefix']),'-');
            Route::middleware(['web'])
                ->prefix($row['prefix'])
                ->name($name."-")
                ->group(function () use ($row){

                    if($row['class']) {
                        Route::resource($row['uri'], $row['class']);
                    } else {
                        Route::resource($row['uri'], Actions::class);
                    }

                    //Route::resource($row['uri'], Actions::class);
                });
        }
    }
}

function dbIsTable($pdo, $tablename)
{
    $query = "SHOW TABLES"; // 테이블 목록
    $stmt = $pdo->query($query); // 쿼리준비

    $rows = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $rows []= $row;
    }

    foreach($rows as $row) {
        if($row == $tablename) return true;
    }

    return false;
}

function checkPrefix($prefix, $server)
{
    $fix = explode('/',$prefix);
    $max = count($server) > count($fix) ? count($fix) : count($server);

    for($i=0;$i<$max;$i++) {
        if(isset($fix[$i]) && $server[$i] != $fix[$i]) {
            return false;
        }
    }
    return true;
}







/*
use Jiny\Action\Http\Controllers\Actions;
use Jiny\Action\Http\Controllers\Fields;
Route::middleware(['web'])
    ->prefix('/admin/system')
    ->name("admin-system-")
    ->group(function () {

        Route::resource('actions', Actions::class);
        Route::resource('actions.fields', Fields::class);
        //Route::resource('actions.fields', Actions::class);

    });
*/



