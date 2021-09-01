<?php 
namespace Jiny\Table;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Jiny\Table\Http\Livewire\Pagination;

class Select extends Component
{
    /*
    public $db;
    public $rules;
    public $_filter=[];
    public $rows=[];
    public $ids = [];
    
    public $pagenation;
    public $listnum = 5;
    use WithPagination, Pagination;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function setFilter($filter)
    {
        $this->_filter = $filter;
        return $this;
    }

    public function setListnum($num)
    {
        $this->listnum = $num;
        return $this;
    }

    public function setTable($name=null)
    {
        if($name) {
            $this->db = DB::table($name);
        } else {
            $this->db = DB::table($this->rules['tablename']);
        }
        return $this;
    }

    public function filter($filter=[])
    {
        foreach($this->_filter as $key => $value) {
            if($value) {
                $this->db = $this->db->where($key, "like", "%".$value."%");
            }            
        }
        return $this;
    }

    public function objToArray($datas)
    {
        $rows = [];
        foreach($datas as $data) {
            $id = $data->id;
            $this->ids []= $data->id;
            foreach($data as $key => $value) {
                $rows[$id][$key] = $value;
            }            
        }
        return $rows;
    }

    public function forien($fields)
    {
        $forien=[];
        //1. 유효한 데이터 추출
        foreach($this->rules['fields'] as $field) {
            $key = explode(".",$field['name']);
            if($key[0] == "_") continue; // _시작 필드는 저장하지 않음.

            // 외부참조 테이블의 값
            $end = strlen($key[0])-1;
            if($key[0][$end] == "_") {
                //forienkey 1:1
                $refTable = substr($key[0],0,$end);
                unset($key[0]);
                $forien[$refTable] = array_values($key);
            } 

            //
            /*
            if (isset($key[1])) {
                $end = strlen($key[1])-1;
                if($key[1][$end] == "_") {
                    //forienkey 1:1
                    $refTable = substr($key[1],0,$end);
                    //unset($key[0]);
                    $forien[$refTable] = [$key[2] => $key[0]];
                }
            }
            */

        }

        return $forien;
    }

    */
    

    /*
    public function fetch()
    {
        //1. 데이터 읽기
        $this->setTable();
        
        # 필터검색 조건
        $this->filter();
        
        $datas = $this->db->orderBy('id',"desc")
            ->paginate($this->listnum);

        $rows = $this->objToArray($datas);

        $this->pagination = $datas->links();
        unset($datas);


        //2. 외부키 추출
        $forien = $this->forien($this->rules['fields']);

        // 데이터 결합
        foreach ($forien as $table => $fields) {
            $subs = DB::table($table)
                ->whereIn($this->rules['tablename'].'_id', $ids)
            ->get();

            foreach ($subs as $sub) {
                //dd($sub);
                $id = $sub->{$this->rules['tablename'].'_id'}; //원본의 id
                # 필드를 복사합니다.
                foreach($fields as $field) {
                    $rows[$id][$table."_.".$field] = $sub->$field;
                }
            }
        }

        return $rows;
    }
    */





}