<?php

namespace Jiny\DB\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DBTableDesc extends Controller
{
    private $tablename;

    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($table)
    {
        $pdo = DB::connection()->getPdo();
        $query = "DESC ".$table; // 테이블 목록
        $stmt = $pdo->query($query); // 쿼리준비

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $rows []= $row;
        }

        $rowFunc = function ($row) use ($table) {
            $string = "";
            //dd($row);
            foreach ($row as $key =>$item) {
                if($key == "Field") {
                    $string .= "<td><a href='".route('admin-db-desc.edit',[$table, $item])."'>".$item."(".$key.")</a></td>";
                } else {
                    $string .= "<td>".$item."(".$key.")</td>";
                }                
            }
            return $string;
        };

        return view("jinydb::database.desc.list",[
            'table'=>$table,
            'rows'=>$rows, 
            'rowfunc'=>$rowFunc
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($table)
    {
        return view("jinydb::database.desc.create",['table'=>$table]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->table);
        Schema::table($request->table, function (Blueprint $table) use ($request) {
            $typeMethod = $request->field_type; // 데이터타입
            $table->$typeMethod($request->field_name);
        });
    
        return redirect()->to( route('admin-db-desc.index', $request->table) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($table, $id)
    {
        
        $pdo = DB::connection()->getPdo();
        $query = "DESC ".$table; // 테이블 목록
        $stmt = $pdo->query($query); // 쿼리준비

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            if($row['Field'] == $id) {
                break;
            }
        }

        return view("jinydb::database.desc.edit",['table'=>$table, 'row'=>$row]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        $query = "DESC ".$request->table; // 테이블 목록
        $stmt = $pdo->query($query); // 쿼리준비

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            if($row['Field'] == $request->_field) {
                break;
            }
        }

        // 필드명 수정
        if ($row['Field'] != $request->field_name) {
            Schema::table($request->table, function (Blueprint $table) use ($row, $request) {
                $table->renameColumn($row['Field'], $request->field_name);
            });
        }

        // 필드명 수정

        if ($request->field_null == "YES") {
            Schema::table($request->table, function (Blueprint $table) use ($row, $request) {
                $start = strpos($row['Type'],'(')+1;
                $end = strrpos($row['Type'], ')');
                $num = substr($row['Type'], $start, $end-$start);

                $table->string($row['Field'], $num)->nullable()->change();
            });
        } else {
            Schema::table($request->table, function (Blueprint $table) use ($row, $request) {
                $start = strpos($row['Type'],'(')+1;
                $end = strrpos($row['Type'], ')');
                $num = substr($row['Type'], $start, $end-$start);

                $table->string($row['Field'], $num)->change();
            });
        }

        return redirect()->to( route('admin-db-desc.index', $request->table) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request);

        Schema::table($request->table, function (Blueprint $table) use ($request) {
            $table->dropColumn($request->_field);
        });

        return redirect()->to( route('admin-db-desc.index', $request->table) );
    }


}
