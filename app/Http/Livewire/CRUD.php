<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;

trait CRUD 
{
    public $_id;
    public $modalFormVisible = false;
    public $mode = "list";
    private $desc = [];

    private $paging = 10;

    /**
     * createShowModal
     *
     * @return void
     */
    public function create()
    {
        $this->clear();
        $this->modalFormVisible = true;
        $this->mode = "new";
    }

    public function removeModal()
    {
        $this->modalFormVisible = false;
    }

    /**
     * 새로운 국가를 추가합니다.
     *
     * @return void
     */
    public function insert()
    {
        /*
        $menu = new Model;
        $menu->code = $this->_code;
        $menu->title = $this->_title;
        $menu->save();
        */

        
        DB::table($this->table)->insert( $this->setData() );
        

        $this->removeModal();
        $this->clear();
        $this->mode = "list";
    }

    public function edit($id)
    {
        $this->_id = $id;
        
        // $data = Model::find($id);
        $data = DB::table($this->table)->where('id', $id)->first();

        $this->getData($data);

        $this->mode = "edit";
        $this->modalFormVisible = true;
    }

    public function delete()
    {
        // Model::destroy($this->_id);
        DB::table($this->table)->where('id', $this->_id)->delete();

        $this->removeModal();
        $this->clear();
        $this->mode = "list";
    }

    public function update()
    {
        //Model::find($this->_id)->update($this->setData());
            
        DB::table($this->table)
            ->where('id', $this->_id)
            ->update($this->setData());
            

        $this->removeModal();
        $this->clear();
        $this->mode = "list";
    }

    private function desc()
    {
        $pdo = DB::connection()->getPdo();
        $query = "DESC ".$this->table; // 테이블 구조
        $stmt = $pdo->query($query); // 쿼리준비

        $desc = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $desc []= $row;
            // $this->{"_".$row['Field']} = null;
        }
        //dd($this);
        return $desc;
    }
}