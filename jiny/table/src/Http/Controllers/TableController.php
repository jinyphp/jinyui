<?php

namespace Jiny\Table\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    private $tablename;
    private $rule;
    private $conf;

    private function rules()
    {
        $path = resource_path($this->rule);
        $json = file_get_contents($path);
        $this->conf = json_decode($json,true);
        $this->tablename = $this->conf['tablename'];

        return [
            'table'=>$this->tablename,
            'title' => $this->conf['title'],
            'forms' => $this->conf['forms'],
            'filter_forms' => $this->conf['filter']
        ];
    }

    protected function setRuleJson($rule)
    {
        $this->rule = $rule;
        return $this;
    }

    protected function setTablename($name)
    {
        $this->conf['table'] = $name;
        return $this;
    }

    protected function setTitle($title)
    {
        $this->conf['title'] = $title;
        return $this;
    }





    /**
     * index 리스트목록 출력
     *
     * @return void
     */
    public function index(Request $request)
    {
        return view('jinytable::datatable', $this->rules());
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
        DB::table($this->tablename)->whereIn('id', $ids)->delete();
        return response()->json(['status'=>"200", 'ids'=>$ids]);
    }
}
