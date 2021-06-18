<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SiteMenu as Model;

use Illuminate\Support\Facades\DB;
use App\Http\Livewire\CRUD;
use App\Http\Livewire\Pagination;

class BasicMenu extends Component
{
    public $title = "Menu";
    private $table = "site_menus";
    

    /**
     * CRUD, 페이지네이션
     */
    use CRUD, Pagination;

    /**
     * 초기화
     */
    public function mount()
    {
        $this->resetPage(); // 초기 로드시 페이지네이션 초기화
        // $this->setTableFields(); // 테이블 public property 생성
    }


    public $_enable;
    public $_code;
    public $_title;
    public $_uri;
    public $_target;
    public $_description;

    /**
     * clear 프로퍼티 초기화
     *
     * @return void
     */
    private function clear()
    {
        $this->_id = null;
        $this->_enable = null;
        $this->_code = null;
        $this->_title = null;
        $this->_uri = null;
        $this->_target = null;
        $this->_description = null; 
    }

    private function setData()
    {
        return [
            'enable' => $this->_enable,
            'code' => $this->_code,
            'title' => $this->_title,
            'uri' => $this->_uri,
            //'target' => $this->_target,
            'description' => $this->_description
        ];
    }

    private function getData($data)
    {
        $this->_enable = $data->enable;
        $this->_code = $data->code;
        $this->_title = $data->title;
        $this->_uri = $data->uri;
        //$this->_target = $data->target;
        $this->_description = $data->description;
    }

    private function tableTitle()
    {
        return [
            '메뉴코드',
            '타이틀',
            'target',
            'url'
        ];
    }




    public function render()
    {
        $data['title'] = $this->tableTitle();
        $data['rows'] = Model::paginate($this->paging); //::all();
        // $items = DB::table('countries')->get();
        return view('livewire.admin.basic-menu',compact("data"))
            ->layout('layouts.admin');
    }
}
