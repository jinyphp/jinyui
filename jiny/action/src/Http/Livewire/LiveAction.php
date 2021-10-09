<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Jiny\Action\Http\Livewire\LiveData;
use Jiny\Action\Http\Livewire\LiveTable;
class LiveAction extends LiveTable
{

    public function mount()
    {

    }
    
    /**
     * 출력할 목록 데이터를 읽어 옵니다.
     *
     * @return void
     */
    protected function selectDataRows()
    {
        $liveData = new LiveData($this->rules);
        if ($tablename = $liveData->isRuleTable()) {
            $datas = $liveData->dbTable($tablename)
                ->orderBy('prefix',"desc")
                ->paginate(10);            
            return $datas;
        }
    
        return [];
    }


    public function makejson()
    {
        $path = resource_path('route');

        $db = DB::table($this->rules['tablename']);
        $route = $db->orderBy('id',"desc")->get();
        
        foreach($route as $row)
        {
            $row->fields = DB::table("action_field")->where('actions_id',$row->id)->get();
            $json = json_encode($row, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            $filename = $path;
            if ($row->prefix) {
                $filename .= $row->prefix;
            }
            if(!is_dir($filename)) {
                mkdir( $filename, 0755, true );
            }
            
            file_put_contents($filename."/".$row->uri.".json", $json);
        }
        
    }


}
