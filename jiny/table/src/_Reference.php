<?php 
namespace Jiny\Table;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Jiny\Table\Http\Livewire\Pagination;

/**
 * 1:1 관리
 */

class Reference
{
                /*
            //2. 외부키 데이터를 읽어서 병합
            foreach ($forien as $table => $fields) {

                $data = DB::table($table)
                    ->where($this->rules['tablename'].'_id', $this->rules['edit_id'])
                ->first();

                foreach ($fields as $field) {
                    if(isset($data->$field)) {
                        $this->_data[ $table."_" ][$field] = $data->$field;
                    }
                }
            }
            */


                        //2. 외부키 갱신
            //2. Forien Table
            /*
            //1:1
            foreach ($forien as $table => $_data) {
                $data = [];
                foreach($_data as $key=>$value) {
                    $data[$key] = $value;
                }
                //$data[ $this->rules['tablename']."_id" ] = $id;
                $data['updated_at'] = date("y-m-d h:i:s");

                DB::table($table)
                ->where($this->rules['tablename']."_id", $this->rules['edit_id'])
                ->update($data);
            }
            */

            
}