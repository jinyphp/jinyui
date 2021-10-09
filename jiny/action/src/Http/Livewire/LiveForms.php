<?php

namespace Jiny\Action\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LiveForms extends Component
{
    public $rules;
    public $nested;
    public $_data = [];
    public $_old = [];
    public $viewFile;

    public function mount()
    {
        // Controller View에서 전달받은  
        if (isset($this->rules['data'])) {
            // 데이터를 입력폼데이터로 재설정
            $this->setData($this->rules['data']);
            
        } else {
            // 데이터 없음, 기본값 설정
            foreach($this->rules['fields'] as $field) {
                $this->setDefaultData($field);
            }
        }

        ## 원본데이터 저장
        $this->_old = $this->_data;
    }

    private function setData($data)
    {
        $this->_data = $data;
    }

    private function setDefaultData($field)
    {
        if($field['form'] && $field['default']) {
            if($name = $field['name']){ //필드명
                $this->_data[$name] = $field['default'];
            }                    
        }
    }


    /**
     * 화면처리 출력
     *
     * @return void
     */
    public function render()
    {
        if(isset($this->rules['nested_id'])) {
            $this->nested =  $this->rules['nested_id'];
        }

        # 외부에서 livewire view가 지정될 경우 우선적용
        if(!$this->viewFile) {
            $this->viewFile = "jinyaction::livewire.liveForms";
        }
        
        return view($this->viewFile,[
            'ActionForms'=> new \Jiny\Action\ActionForms($this->rules, $this->_data),
            'fields'=>$this->rules['fields']
        ]);
    }
    
    /**
     * 신규 데이터 삽입
     *
     * @return void
     */
    public function store()
    {
        $validates = [];

        if(isset($this->rules['nested_id'])) {
            $this->_data['nested_id'] = $this->rules['nested_id'];
        }

        // 유효성검사
        foreach($this->rules['fields'] as $field) {
            $name = $field['name'];

            ## 패스워드 암호화
            if ($field['input'] == 'password') {                    
                $this->_data[$name] = Hash::make($this->_data[$name]);
            }
        
            if ($field['validate']) {
                $validates[$name] = explode(';', $field['validate']);
            }
        }
        
        Validator::make($this->_data, $validates)->validate();

        $master_id = DB::table($this->rules['tablename'])
            ->insertGetId($this->_data);

        return $this->redirectToIndex();     
    }
    
    /**
     * 데이터 수정
     *
     * @return void
     */
    public function update()
    {
        $validates = [];

        # Rules 유효성검사
        foreach($this->rules['fields'] as $field) {
            $name = $field['name'];

            ## 패스워드 암호화
            if ($field['input'] == 'password') {    
                ### 값이 변경된 경우, 패스워드 다시 암호화.
                if($this->_old[$name] != $this->_data[$name]) {
                    $this->_data[$name] = Hash::make($this->_data[$name]);
                }         
            }
            
            if ($field['validate']) {
                $validates[$name] = explode(';', $field['validate']);
            }
        }

        Validator::make($this->_data, $validates)->validate();

        // 데이터 수정
        DB::table($this->rules['tablename'])
        ->where('id', $this->rules['edit_id'])
        ->update($this->_data);

        return $this->redirectToIndex();  
    }

    public function delete()
    {
        if(isset($this->rules['edit_id'])) {

            // DB 데이터를 삭제합니다.
            DB::table($this->rules['tablename'])
            ->where('id', $this->rules['edit_id'])
            ->delete();
        
        }

        return $this->redirectToIndex();
    }

    public function clear()
    {
        $this->_data = [];
    }
    

    /**
     * 목록으로 페이지 이동
     *
     * @return void
     */
    private function redirectToIndex()
    {
        if(isset($this->rules['nested_id'])) {
            return redirect()->to( route($this->rules['routename'].'.index', $this->rules['nested_id']) ); 
        }
        
        return redirect()->to( route($this->rules['routename'].'.index') ); 
    }
    

    /**
     * 수정모드 인지 확인
     */
    private function isEditMode()
    {
        if(isset($this->rules['edit_id']) && is_numeric($this->rules['edit_id'])) {
            return true;
        }
        return false;
    }


    public $openDialogField = false;
    public function newField()
    {
        $this->openDialogField = true;
    }

}
