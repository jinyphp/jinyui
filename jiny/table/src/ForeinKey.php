<?php 
namespace Jiny\Table;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ForeinKey
{
    public $forein=[];
    public $table;
    public function __construct($table)
    {
        $this->table = $table;
    }

    public function relations($ids)
    {
        
        return (new \Jiny\Table\Relation())
            ->getRelations($this->table, $ids); //n:m 관계조회
    }

    public function fieldParser($fields)
    {
        foreach($fields as $field) {
            $key = explode(".",$field['name']);
            if($key[0][0] == "_") continue; // _시작 필드는 저장하지 않음.

            $this->parser($key);
        }
        return $this;
    }

    public function parser($key)
    {
        $end = strlen($key[0])-1;
        //1:N 관계
        if($key[0][$end] == "_") {
            $refTable = substr($key[0],0,$end);
            unset($key[0]);
            $this->forein['_'][$refTable] = array_values($key);

        } else 
        // M:N 관계
        if($key[0][$end] == "*") {
            $refTable = substr($key[0],0,$end);
            unset($key[0]);
            $this->forein['*'][$refTable] = array_values($key);

        } else 
        // 1:1 관계
        if($key[0][$end] == "=") {
            $refTable = substr($key[0],0,$end);
            unset($key[0]);
            $this->forein['='][$refTable] = array_values($key);

        } else {
            return $key;
        }

        ## 컬럼.테이블_
            // 컬럼데이터와 테이블id를 조회한 후에 컬럼의 데이터를 적용합니다.

            ## 컬럼.테이블_.필드명
            // 컬럼데이터와 테이블조회한 후에, 지정한 필드명을 출력

            // 테이블에서 '원본_id' 테이블을 매칭한 후에, 컬럼테이블을 출력

    }

    public function merge($rows)
    {
        $ids = $this->ids($rows);

        foreach ($this->forein as $type => $items) {
            if($type == "=") {
                // 1:1
            } else {
                // 1:N, M:N
                $rows = $this->relations($ids) //n:m 관계조회
                ->resolve() //참조할 외부테이블 확인
                ->load() // 테이블 데이터 읽기
                ->merge($rows); // 각각의 데이터를 결합
            }
        } 
        return $rows;
    }

    public function ids($rows)
    {
        $ids = [];
        foreach($rows as $row) {
            $ids []= $row['id'];           
        }
        return $ids;
    }

    public function storeDataFiltering($datas)
    {
        $data = $this->datafiltering($datas);
        $data['created_at'] = date("y-m-d h:i:s");
        return $data;
    }

    public function updateDataFiltering($datas)
    {
        $data = $this->datafiltering($datas);
        return $data;
    }

    public function datafiltering($datas)
    {
        $data=[];

        ## 원본 데이터 삽입
        //1. 유효한 데이터 추출
        foreach($datas as $field => $value) {
            $key = explode(".",$field);
            if($key[0][0] == "_") continue; // _시작 필드는 저장하지 않음.

            $end = strlen($key[0])-1;
            if($key[0][$end] == "_") { 
                // 1:N
                $refTable = substr($key[0],0,$end);
                $this->forein['_'][$refTable] = $value;
            } else
            if($key[0][$end] == "*") { 
                // M:N
                $refTable = substr($key[0],0,$end);
                $this->forein['*'][$refTable] = $value;
            } else 
            if($key[0][$end] == "=") { 
                // 1:1
                $refTable = substr($key[0],0,$end);
                $this->forein['_'][$refTable] = $value;
            } else {
                $data[$key[0]] = $value;
            }
        }
        
        $data['updated_at'] = date("y-m-d h:i:s");
        return $data;
    }



    public function foreinDelete($id)
    {
        (new \Jiny\Table\Relation())
            ->setMaster($this->table, $id)
            ->delete();
    }

    public function foreinCreate($master_id)
    {
        (new \Jiny\Table\Relation)
            ->store(
                $this->forein, // 테이터 같이 보관
                [
                    'name'=>$this->table, 
                    'id'=>$master_id 
                ]
            );
    }

    public function foreinUpdate()
    {
        
        (new \Jiny\Table\Relation)
            ->update($this->forein);
    }

    public function foreinMerge($edit)
    {
        // 1:1 , M:N
        //relations 참조
        $rows = (new \Jiny\Table\Relation())
        ->getRelations($this->table, [$edit->rules['edit_id']]) //n:m 관계조회
        ->resolve() //참조할 외부테이블 확인
        ->load() // 테이블 데이터 읽기
        ->data; // 각각의 데이터를 결합

        foreach($rows as $table => $data) {
            $edit->_data[ $table."_" ] = []; //초기화
            foreach($data as $item) {
                foreach($item as $key => $value) {
                    // $key == "id" || 
                    if ( $key == "created_at" || $key =="updated_at") continue;
                    if (isset($edit->_data[ $table."_" ][ $key ])) {
                        $edit->_data[ $table."_" ][ $key ] .= $value.";"; 
                    } else {
                        $edit->_data[ $table."_" ][ $key ] = $value;
                    }
                    
                }
            }
        }

    }

}