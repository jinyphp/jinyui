<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Company extends Controller
{
    private $table;

    public function __construct()
    {
        $this->table = [
            'name'=>"site_menus",
            'rules'=>"jiny/menu.json"
        ];
    }

    /**
     * index 리스트목록 출력
     *
     * @return void
     */
    public function index()
    {
        return view('sales.company',[
            'table'=>$this->table
        ]);
    }

        
    /**
     * delete 선택한 항목 삭제
     *
     * @param  mixed $request
     * @return void
     */
    public function delete(Request $request)
    {
        $ids = $request->ids;
        // 선택한 항목 삭제 AJAX
        DB::table($this->table['name'])->whereIn('id', $ids)->delete();
        return response()->json(['status'=>"200", 'ids'=>$ids]);
    }
}
