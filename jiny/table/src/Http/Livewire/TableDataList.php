<?php
namespace Jiny\Table\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Jiny\Table\Http\Livewire\Pagination;
use Jiny\UI\View\Components\Icon;

class TableDataList extends Component
{
    public $rules;
    public $listnum = 5;
    public $_filter = []; // 필터 조건값
    public $search_status = false;


    // Event Refresh
    protected $listeners = ['refeshTable', 'dialogClose'];
    public $pagenation;
    use WithPagination, Pagination;


    public function render()
    {
        $rows = $this->select();
        $rows = (new \Jiny\Table\ForeinKey( $this->rules['tablename'] ))
            ->fieldParser($this->rules['fields'])
            ->merge($rows); // 외부키 추출 병합

        $table = new \Jiny\Table\Datatable($this->rules['routename']);
        return view($this->rules['list']['view'], 
            [
                'rows'=>$rows, 
                'pagination'=>$this->paging(),
                'table'=>$table
            ]);
    }

    public function paging()
    {
        if ($this->pagination) {
            return $this->pagination;
        }

        return function() {
        };
    }

    /**
     * DB 데이터를 읽어옵니다.
     */
    private function select()
    {
        // DB 목록 데이터 읽기
        // 컨트롤러의 select 처리 로직 호출...
        $controller = app()->make("LiveDataController");
        if (method_exists($controller, "select")) {
            $controller->livewire = $this; //양방향 의존성
            $datas = $controller->select();            
        } 
        // 기본로직
        else {
            ## 1. 데이터 읽기
            $this->db = DB::table($this->rules['tablename']);
            
            ## 필터검색 조건
            foreach($this->_filter as $key => $value) {
                if($value) {
                    $this->db = $this->db->where($key, "like", "%".$value."%");
                }            
            }

            $datas = $this->db->orderBy('id',"desc")
                ->paginate($this->listnum);
        }

        // 데이터를 받아서 중간변환 처리
        if(is_object($datas)) {
            $this->pagination = $datas->links();
            $rows = $this->objsToArray($datas);
        } else {
            $rows = $datas;            
        }

        return $rows;
    }

    public function objsToArray($datas)
    {
        $rows = [];
        foreach($datas as $data) {
            $id = $data->id;
            $rows[$id] = $this->objToArray($data);
        }
        return $rows;
    }

    public function objToArray($data)
    {
        $row = [];
        foreach($data as $key => $value) {
            $row[$key] = $value;
        }            
        return $row;
    }



    // 페이지 재로드용
    public function search()
    {
        // 동작없음.        
        $this->search_status = true;
    }

    public function search_reset()
    {
        $this->_filter = [];
    }


    public $selected=[];
    public function deleteSelected()
    {
        // 선택한 항목을 삭제합니다.
        DB::table($this->rules['tablename'])
            ->whereIn('id', $this->selected)
            ->delete();
    }

    public function sort()
    {

    }

    
    public function refeshTable()
    {
        // emit : 테이블 화면 목록 갱신
    }









    public function mount()
    {

        /*
        $path = resource_path("rules/mmm.json");
        $json = file_get_contents($path);
        $this->conf = json_decode($json,true);
        
        // 목록 출력순으로 정렬
        $this->listTitle(
            arr_sort( $this->conf, '_list_pos' , 'asc' )
        );
        */       
    }

    //
    public function addColums()
    {
        
    }


































    /*
    public $table;
    public $data = array();
    
    public $filter_forms;
    
    

    public $modalFormVisible = false;
    public $mode = "list";

    public $title;
    public $_id;

    public $forms = [];

    public $table_title = [];
 
    public $conf = [];


    public function listTitle($conf)
    {
        foreach($conf as $item) {
            array_push($this->table_title, [
                'title'=>$item['_title'],
                'list_pos' => $item['_list_pos'],
                'list_sort' => $item['_list_sort']
            ]);
        }
    }

    public function editField()
    {
        $this->emit('displayField');
    }

    public function modalClose()
    {
        $this->modalFormVisible = false;
    }
    

    public function create()
    {
        $this->modalFormVisible = true;
        $this->mode = "new";
        $this->data = []; // 데이터 초기화
    }
    


    public function edit($id)
    {
        $this->_id = $id;
        
        // 데이터를 DB에서 읽어 옵니다.        
        $data = DB::table($this->table)->where('id', $id)->first();
        foreach($data as $key => $value) {
            $this->data[$key] = $value; // Obj -> Arr 변환
        }        

        $this->modalFormVisible = true; // 모달창을 생성 합니다.
        $this->mode = "edit";
    }

    
    public function update()
    {   
        // DB 데이터를 수정합니다.
        DB::table($this->table)
            ->where('id', $this->_id)
            ->update($this->data);
            
        $this->modalFormVisible = false; //모달창을 제거 합니다.
        $this->mode = "list";
    }

    public function delete()
    {
        // DB 데이터를 삭제합니다.
        DB::table($this->table)->where('id', $this->_id)->delete();

        $this->modalFormVisible = false; //모달창을 제거 합니다.
        $this->mode = "list";
    }

    public function search()
    {
        // 동작없음.
        // 페이지 재로드용
        $this->search_status = true;
    }

    public function search_reset()
    {
        $this->filter = [];
    }
    






    // 모달 대화창 활성화

    public $dialogVisible = false;
    public function dialog()
    {
        $this->dialogVisible = true;
    }

    public function dialogClose()
    {
        $this->dialogVisible = false;
    }
    */

}
