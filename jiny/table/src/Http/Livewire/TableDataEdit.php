<?php
namespace Jiny\Table\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class TableDataEdit extends Component
{
    public $rules;
    public $_data=[];

    /**
     * 신규, 수정 화면 표시
     */
    public function render()
    {
        $this->_data = []; //초기화

        // 수정모드
        if($this->isEditMode()) {
            $data = DB::table($this->rules['tablename'])
            ->where('id', $this->rules['edit_id'])
            ->first();

            // 외부 참조값 읽기
            $ForeinKey = (new \Jiny\Table\ForeinKey( $this->rules['tablename'] ));
            // 데이터 채우기
            foreach ($this->rules['fields'] as $field) {
                if ($this->isFormField($field['form'])) {
                    $key = explode(".",$field['name']);
                    if($key[0][0] == "_") continue; // _시작 필드는 저장하지 않음.

                    if($ForeinKey->parser($key)) {
                        $this->setData($data, $key);
                    }
                }
            }

            foreach ($ForeinKey->forein as $type => $arr) {
                if($type == "=" ) { 
                    // 1:1
                } else {
                    // 1:N, M:N 읽기
                    $ForeinKey->foreinMerge($this);
                }
            }            
        }

        // 기본값 설정
        foreach ($this->rules['fields'] as $field) {
            $this->setDefault($field);            
        }

        return view($this->rules['edit']['view'], [
            'forms'=> new \Jiny\Table\Forms() 
        ]);
    }





    public function storeReset()
    {
        $this->_data = []; //초기화
    }

    private function clear()
    {
        $this->_data = []; //초기화
        unset($this->rules['edit_id']); //초기화
    }

    /**
     * 테이터 삽입동작
     */
    public function store()
    {
        $ForeinKey = (new \Jiny\Table\ForeinKey( $this->rules['tablename'] ));
        $data = $ForeinKey->storeDataFiltering($this->_data);

        $master_id = DB::table($this->rules['tablename'])
            ->insertGetId($data);

        //2. Forien Table
        foreach ($ForeinKey->forein as $type => $arr) {
            if($type == "=" ) { 
                // 1:1
            } else {
                // 1:N, M:N 생성
                $ForeinKey->foreinCreate($master_id);                
            }
        }

        $this->clear();
        return redirect()->to( route($this->rules['routename'].".index") );
    }

    

    
    /**
     * 테이터 수정동작
     */
    public function update()
    {
        if($this->isEditMode()) {

            $ForeinKey = (new \Jiny\Table\ForeinKey( $this->rules['tablename'] ));
            $data = $ForeinKey->updateDataFiltering($this->_data);

            // 데이터 수정
            DB::table($this->rules['tablename'])
                ->where('id', $this->rules['edit_id'])
                ->update($data);

            foreach ($ForeinKey->forein as $type => $arr) {
                if($type == "=" ) { 
                    // 1:1
                } else {
                    // 1:N, M:N 갱신
                    $ForeinKey->foreinUpdate();
                }
            }

        }   

        $this->clear();
        return redirect()->to( route($this->rules['routename'].".index") );
    }

    /**
     * 테이터 삭제 동작
     */
    public function delete()
    {
        if($this->isEditMode()) {
            $ForeinKey = (new \Jiny\Table\ForeinKey( $this->rules['tablename'] ));

            // DB 데이터를 삭제합니다.
            DB::table($this->rules['tablename'])
            ->where('id', $this->rules['edit_id'])
            ->delete();

            foreach ($ForeinKey->forein as $type => $arr) {
                if($type == "=" ) { 
                    // 1:1
                } else {
                    // 1:N, M:N 삭제
                    $ForeinKey->foreinDelete($this->rules['edit_id']);
                }
            }
        
        }

        $this->clear();
        return redirect()->to( route($this->rules['routename'].".index") );
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

    /**
     * 수정폼 필드인지 확인
     */
    private function isFormField($name)
    { 
        if (isset($name) && $name == true) {
            return $name;
        }
        return false;
    }






    private function setData($data, $key)
    {
        // 테이터값
        if (isset($data->{$key[0]})) {
            $this->_data[ $key[0] ] = $data->{$key[0]};

        } else 
        // 기본값 설정
        if (isset($field['default'])) {
            $this->_data[ $key[0] ] = $field['default'];

        }
    }


    private function setDefault($field)
    {
        $ac = explode(".", $field['name']);
        switch(count($ac)) {
            case 1: 
                if(!isset($this->_data[ $ac[0] ])) {
                    if (isset($field['default'])) {
                        $this->_data[ $ac[0] ] = $field['default'];
                        
                    }
                }
                break;
            case 2: 
                if(!isset($this->_data[ $ac[0] ][ $ac[1] ])) {
                    if (isset($field['default'])) {
                        $this->_data[ $ac[0] ][ $ac[1] ] = $field['default'];
                        
                    }
                }
                break;
            case 3: 
                if(!isset($this->_data[ $ac[0] ][ $ac[1] ][ $ac[2] ])) {
                    if (isset($field['default'])) {
                        $this->_data[ $ac[0] ][ $ac[1] ][ $ac[2] ] = $field['default'];
                        
                    }
                }
                break;
        }
    }


}
