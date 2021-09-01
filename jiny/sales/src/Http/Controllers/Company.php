<?php

namespace Jiny\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use \Jiny\Table\Http\Controllers\TableController;

class Company extends TableController
{
    public function __construct()
    {
        $this->setRuleJson("rules/menu.json");
    }

    public function index(Request $request)
    {
        return view('jinyerp::company');
    }

    public function new()
    {
        //return view('company-new');
        return view('jinyerp::company-new');
    }


         
    /**
     * 필드정보들 DB에서 읽어옴
     *
     * @param  mixed $uri
     * @return void
     */
    public function get_field_db($uri)
    {
        return DB::table("jiny_fields")->where('uri', $uri)->get();
    }

    public function put_field_db($uri, $data)
    {
        foreach($data as $item) {
            if(isset($item['id'])) {
                DB::table("jiny_fields")->where('id', $item['id'])->update($item);
            } else {
                DB::table("jiny_fields")->insert($item);
            }
        }
    }
    
    /**
     * 필드정보를 json 파일로 저장함
     *
     * @param  mixed $filename
     * @param  mixed $data
     * @return void
     */
    public function put_field_json($filename, $data)
    {
        file_put_contents( resource_path($filename), json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }

    public function get_field_json($filename)
    {
        $path = resource_path($filename);
        // dd($path);
        $json = file_get_contents($path);

        return json_decode($json,true);
    }





}
