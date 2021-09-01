<?php

namespace Jiny\UI\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Jiny\UI\Http\Livewire\Pagination;

class DataTable extends Component
{
    public $ui="basic"; // 테이블 형태
    public $rules;
    public $data;
    public $message;
    private $admin = true;



    public function thead()
    {
        
        $tbody = "";
        if(isset($this->rules['thead'])) {
            foreach($this->rules['thead'] as $key => $value) {
                //$item = '<div contentEditable="true" wire:model="rules.thead.'.$key.'">'.$value.'</div>';
                //$item = '<input type="text" wire:model="rules.thead.'.$key.'" value="'.$value.'">';
                $item = '<div>'.$value.'</div>';
                $tbody .= "<th>".$key.$item."</th>";
            }
        }
        
        if ($this->admin) {
            $tbody .= '
            <th wire:click="addHead" class="cursor-pointer" class="w-6"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </th>';
        }        
        
        return "<thead><tr>".$tbody."</tr></thead>";
    }

    public function addHead()
    {
        if(isset($this->rules['thead'])) {
            //$this->tableHead []= "none";
            $this->rules['thead'] [] = "none";
        } else {
            //$this->tableHead[0] = "none";
            $this->rules['thead'][0] = "none";
        }
    }

    public function tbody()
    {
        if (isset($this->rules['data'])) {
            // json 데이터를 테이블로 출력
            $tbody = "";
            foreach($this->rules['data'] as $key => $row) {
                $tbody .= "<tr>";
                foreach ($row as $tr => $value) {
                    $tbody .= "<tr>".$value."</td>";
                }
                $tbody .= "</tr>";
            }

            return "<tbody>".$tbody."</tbody>";

        } else if (isset($this->rules['tablename'])) {
            // DB Table을 읽어서 출력
            
        }

        // 데이터 없음
        if (isset($this->rules['thead'])) {
            $colspan = count($this->rules['thead']);
        } else {
            $colspan=1;
        }
        $tbody = "<tr><td colspan=".$colspan.">데이터가 존재하지 않습니다.</td></td>";
        return "<tbody>".$tbody."</tbody>";
    }

    public function render()
    {
        return view('jinyui::livewire.datatable', ['thead'=>$this->thead(), 'tbody'=>$this->tbody()]);
    }

    /*
    use WithPagination, Pagination;

    public $table;
    public $data = array();
    public $listnum = 5;
    public $filter_forms;
    public $filter = []; // 필터 조건값
    public $search_status = false;

    public $modalFormVisible = false;
    public $mode = "list";

    public $title;
    public $_id;

    public $forms = [];

    public $table_title = [];
 
    public $conf = [];
    public function mount()
    {
        $path = resource_path("rules/mmm.json");
        $json = file_get_contents($path);
        $this->conf = json_decode($json,true);
        
        // 목록 출력순으로 정렬
        $this->listTitle(
            arr_sort( $this->conf, '_list_pos' , 'asc' )
        );
        

    }

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
    
    public function render()
    {
        $db = DB::table($this->table);
        foreach($this->filter as $key => $value) {
            if($value) {
                $db = $db->where($key, "like", "%".$value."%");
            }            
        }

        $rows = $db->orderBy('id',"desc")
            ->paginate($this->listnum); 
        return view('jinyui::livewire.data-list',compact("rows"));
    }


    protected $listeners = ['refeshTable', 'dialogClose'];

    public function refeshTable()
    {

    }


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
