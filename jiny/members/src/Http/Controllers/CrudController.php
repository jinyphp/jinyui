<?php

namespace Jiny\Members\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CrudController extends Controller
{
    public $rules;
    public $livewire;

    public function path($string)
    {
        $temp = str_replace(["/","\\"], DIRECTORY_SEPARATOR, $string);
        $temp = explode(DIRECTORY_SEPARATOR, $temp);
        $path = [];

        for($i=0;$i<count($temp);$i++) {
            if($temp[$i] == "..") {
                array_pop($path);
            } else {
                array_push($path,$temp[$i]);
            }
        }

        return implode(DIRECTORY_SEPARATOR, $path);
    }

    public function initRules($className)
    {
        $ruleName = array_reverse(explode("\\",$className))[0];
        $path = $this->path(__DIR__."/../../Rules/".$ruleName.".json");
        $this->rules = json_decode(file_get_contents($path), true);        
        $this->rules['routename'] = explode(".", Route::currentRouteName())[0];
        $this->rules['controller'] = "\\".$className;
    }

    protected function isTable($name)
    {
        $pdo = DB::connection()->getPdo();
        $query = "SHOW TABLES"; // 테이블 목록
        $stmt = $pdo->query($query); // 쿼리준비

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            foreach($row as $value) {
                if($value == $name) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($this->rules)) {
            return view("jinytable::datalist",['rules'=>$this->rules]);
        }
        return "CRUD 설정값이 없습니다.";
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        unset($this->rules['edit_id']); // 초기화
        return view("jinytable::dataedit",['rules'=>$this->rules]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->rules['edit_id'] = $id;
        return view("jinytable::dataedit",['rules'=>$this->rules]);
    }


}
