<?php

namespace Jiny\UI\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataForm extends Component
{
    public $conf;
    public $table;

    public $forms = [];
    public $data = array();
    public $mode;
    public $_id;


    public $selectbox="item1";

    public $autologin;

    public $message;
    public function mount(Request $req)
    {
        // 모드값이 없는 경우, uri를 이용하여 판별함
        if (!$this->mode) {
            $uri = $req->path();
            $this->mode = array_reverse(explode('/',$uri))[0];
        }
        
        // conf 데이터를 넘겨받지 못한 경우
        // 직접 json 파일을 로드함
        if(!$this->conf) {
            $this->message = "$uri 설정값이 없습니다.".$this->mode;
            $path = resource_path("rules/mmm.json");
            $json = file_get_contents($path);
            $this->conf = json_decode($json,true);
        }
    }

    /**
     * insert 새로운 데이터를 삽입합니다.
     *
     * @return void
     */
    public function insert()
    {
        // 데이터를 DB에 삽입합니다.
        DB::table($this->table)->insert( $this->data );
        
        $this->mode = "list";

        // 상위 livewire 모달창 닫기 호출
        $this->emitUp('dialogClose');
    }

    public $ddd=[];
    public function render()
    {
        
        $CTag = function () {
            return "<div>
            <input type='text' wire:model='ddd.a'>
            </div>";
        };

        // 폼요소 출력 순서로 정렬
        $this->conf = arr_sort( $this->conf, '_form_pos' , 'asc' );
        return view('jinyui::livewire.data-form', compact("CTag"));
    }


    
}
