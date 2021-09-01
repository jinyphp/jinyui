<?php 
namespace Jiny\Table;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Jiny\Table\Http\Livewire\Pagination;

/**
 * M:N Relation 관리
 */

class Relation
{
    public $tables = []; # 테이블 그룹
    public $ref = []; ## 데이터 아이디
    public $data=[];
    public $relations;

    public $master_tablename;
    public $master_ids=[];
    public function setMaster($tablename, $ids)
    {
        $this->master_tablename = $tablename;
        $this->master_ids = $ids;
        return $this;
    }

    public function getRelations($tablename, $ids)
    {
        $this->relations = DB::table("relations")
        ->where("master",$tablename)
        ->whereIn("master_id",$ids)
        ->get();
        return $this;
    }

    public function resolve()
    {
        foreach ($this->relations as $rel) {
            // 하나의 원본데이터는, 다수의 테이블(slave) 데이터와 관계가 있음.
            $this->ref[ $rel->master_id ][ $rel->slave ] []= $rel->slave_id;
            $this->tables[ $rel->slave ] []= $rel->slave_id;
        }
        return $this;
    }

    public function load()
    {
        foreach ($this->tables as $slave => $ids) {
            $this->data[$slave] = DB::table($slave)->whereIn("id",$ids)->get();
        }
        //return $data;
        return $this;
    }

    public function merge($rows)
    {
        // 참조 테이블의 데이터를 각각의 master row 데이터로 분배합니다.
        foreach ($this->ref as $master_id => $slave) {
            foreach($slave as $slave_tablename => $ids) {

                foreach($this->data[$slave_tablename] as $item) {
                    if(in_array($item->id, $ids)) {
                        $rows[ $master_id ][$slave_tablename."_"] []= $item;
                    }                    
                }
            }
        }

        return $rows;
    }

    public function store($forien, $master)
    {
        foreach($forien as $type => $items) {
            if($type == "=") {

            } else {
                foreach ($items as $table => $_data) {
                    $data = [];
                    if (is_array($_data)) {
                        foreach($_data as $key=>$value) {
                            $data[$key] = $value;
                        }
                    }
                    
                    $data['created_at'] = date("y-m-d h:i:s");
                    $data['updated_at'] = date("y-m-d h:i:s");
                    $slave_id = DB::table($table)->insertGetId($data);
        
                    // n:m
                    DB::table("relations")->insertGetId([
                        'master'=>$master['name'],
                        'master_id'=>$master['id'],
                        'slave'=>$table,
                        'slave_id'=>$slave_id
                    ]);
        
                }
            }
        }
    }

    public function update($forien)
    {
        foreach($forien as $type => $items) {
            if($type == "=") {

            } else {
                // 1:N, M:N 관계 갱신
                foreach ($items as $table => $_data) {
                    $data = [];
                    if (is_array($_data)) {
                        foreach($_data as $key=>$value) {
                            $data[$key] = $value;
                        }
                    }
                    
                    $data['updated_at'] = date("y-m-d h:i:s");                
                    DB::table($table)->where("id", $data['id'])->update($data);
                }
            }            
        }        
    }


    public function delete($mode=null)
    {
        //M:N 관계 제거
        DB::table("relations")
            ->where("master",$this->master_tablename)
            ->where("master_id",$this->master_ids)
            ->delete();

        if($mode = "cascade") {

        }
    }

}