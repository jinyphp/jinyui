<?php

namespace Jiny\Table\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataField extends Component
{
    public $rules;
    public $fields;
    public $conf = [];

    public function mount()
    {
        /*
        $path = resource_path("rules/mmm.json");
        $json = file_get_contents($path);
        $this->conf = json_decode($json,true);

        $this->modalFieldVisible = false;
        */
        $this->conf = $this->rules['list']['thead'];
    }

    public function render()
    {
        //$this->fields = DB::table("jiny_fields")->where('_uri', "/admin/menu")->get();
        return view('jinytable::livewire.data-field');
    }


    public $modalFieldVisible;

    /**
     * 모달창 표시
     *
     * @return void
     */
    public function displayField()
    {
        //배열 내 str 값 기준으로 오름차순으로 정렬한다
        // $this->conf = arr_sort( $this->conf, '_list_pos' , 'asc' );
        $this->modalFieldVisible = true;
    }








    public $modalEditVisible;
    public $modalFieldEditVisible = false;
    public $mode = "list";
    public $_id;
    

    public $datas = array();

    protected $listeners = ['displayField'];

    
    public $add_new_field = false;

    
    
  
        


    /**
     * 필드 삽입
     *
     * @return void
     */
    public function newField()
    {
        //$this->add_new_field = true;

        $data = $this->conf[0];
        foreach($data as $k => $v) $data[$k] = null;
        array_push($this->conf, $data);
    }

    public function removeField($id)
    {
        unset($this->conf[$id]);
    }

    /**
     * json 설정값 저장
     *
     * @return void
     */
    public function save()
    {
        $path = resource_path("rules/mmm.json");
        file_put_contents( $path, json_encode($this->conf,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        $this->modalFieldVisible = false;
    }
    

    public function reorder($orderIds)
    {
        $this->conf = collect($orderIds)->map(function($id){
            return collect($this->conf)->where('_list_pos', (int)$id) ->first();
        })->toArray();

        $pos = 1;
        $key = "_list_pos";
        foreach($this->conf as $k => $v) {
            $this->conf[$k][$key] = $pos++; 
        }
        
    }
    
    /**
     * 2차원 배열 정렬
     *
     * @param  mixed $array
     * @param  mixed $key
     * @param  mixed $sort
     * @return void
     */
    public function arr_sort( $array, $key, $sort = "asc" )
    {
        $values = [];
        foreach( $array as $k => $v ) {
            $index = $v[$key];
            $values[$index] = $k;
        }

        if ( $sort=='asc') {
            ksort($values);
        } else{
            krsort($values);
        }

        $ret = [];
        foreach($values as $k => $v) {
            array_push($ret, $array[$v]);
        }
  
        return $ret;
    }









    










    public function modalClose()
    {
        $this->modalEditVisible = false;
    }

    public function fieldInsert()
    {

    }

    public function fieldEdit()
    {
        $this->modalFieldEditVisible = true;
    }

    public function update()
    {
        $this->modalFieldEditVisible = false;
        $this->datas = array();
    }

    public function fieldDelete()
    {

    }

    public function fieldList()
    {
        $this->modalEditVisible = true;
    }


}
