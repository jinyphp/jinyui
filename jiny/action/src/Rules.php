<?php
namespace Jiny\Action;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Rules
{
    const TABLE = "actions";

    public $attrs=[];
    
    public function __construct()
    {
        $name = currentRouteName();
        $this->attrs = $this->routeTable($name);
        $this->attrs['routename'] = $name; // livewire 충돌 방지를 위하여 name 저장
    }
    
    /**
     * 재귀호출을 통하여 nested route 정보를 읽어 옵니다.
     *
     * @param  mixed $name
     * @return void
     */
    private function routeTable($name) {
        $rule = [];

        // livewire 호출동작에서는 rule을 읽지 않습니다.
        if($name && $name != "livewire") {    
            $row = $this->getInfo($name);
            
            foreach ($row as $key => $value) {
                $rule[$key] = $value;
            }

            if($pos = strrpos($name,".")){
                $nested = $this->routeTable(substr($name, 0, $pos)); //재귀호출
                $rule['nested'] = $nested;
            }
        }       

        return $rule;
    }

    private function getInfo($name)
    {
        // DB에서 라우트 정보를 읽어옵니다.
        if($row = DB::table(self::TABLE)->where("name", $name)->first()) {
            return $row;
        } else {
            // 라우트 파일에서 정보를 읽어 옵니다.
            $path = resource_path('route');
            $filename = $path."/".str_replace("-", DIRECTORY_SEPARATOR, $name).".json";
        
            if (file_exists($filename)) {
                $json = file_get_contents($filename);
                return json_decode($json, true);
            }
        }

        // 정보읽기 실패
        return [];
    }


    public function get()
    {
        return $this->attrs;
    }

    public function isTable()
    {
        if (isset($this->attrs['tablename'])) {
            return $this->attrs['tablename'];
        }

        return false;
    }

    public function listView()
    {

        return $this->attrs['list_view'];
    }

    public function editView()
    {
        return $this->attrs['edit_view'];
    }

    public function getFields()
    {
        return $this->fields;
    }


}