<?php

namespace Jiny\Members\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

use Jiny\Members\Http\Controllers\CrudController;

class Members extends CrudController
{

    public function __construct()
    {
        $this->initRules($this::class);
        app()->instance("LiveDataController", $this);
    }

    public function select()
    {
        $rows = [];
        //user 테이블을 반환
        $datas = DB::table("users")->paginate(5);
        $this->livewire->pagination = $datas->links();
        foreach($datas as $data)
        {
            $id = $data->id;
            foreach($data as $key => $value) {
                // _출력용 필드변환
                if($key == "id") {
                    $rows[$id]["user_".$key] = $value;
                } else {
                    $rows[$id]["_".$key] = $value;
                }
                
            } 
        }

        return $rows;
    }



}
