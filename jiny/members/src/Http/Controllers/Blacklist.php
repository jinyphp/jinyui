<?php

namespace Jiny\Members\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

use Jiny\Members\Http\Controllers\CrudController;

class Blacklist extends CrudController
{
    public $rules;
    public function __construct()
    {
        $this->tablename="site_members_blacklist";
        $this->rules['tablename'] = $this->tablename;
        $this->rules['routename'] = explode(".", Route::currentRouteName())[0];

        $this->rules['view']['list'] = "jinymem::members.blacklist.list";
        $this->rules['view']['edit'] = "jinymem::members.blacklist.edit";
        $this->rules['view']['edit'] = "jinymem::members.blacklist.edit";



        $this->rules['thead'] =[
            ['title'=>"id",'field'=>"id"],
            ['title'=>"이메일",'field'=>"email"],
            ['title'=>"설명",'field'=>"description"]
        ];

        $this->rules['filter'] = [
            //Tab1
            [
                //layout1
                [
                    ['title'=>"출력목록",'type'=>"text", 'name'=>"listnum", 'default'=>""],
                    ['title'=>"성별",'type'=>"radio", 'value'=>"man:남성,woman:여성,business:법인", 'name'=>"sex", 'default'=>""]
                ],
                //Layout2
                [
                    ['title'=>"국가",'type'=>"text", 'name'=>"country", 'default'=>""],
                    ['title'=>"이메일",'type'=>"text", 'name'=>"email", 'default'=>""]
                ]
            ]
            //Tab2
            //Tab2
        ];

        // 테이블 확인
        //Schema::dropIfExists("members");
     
        if (!$this->isTable($this->tablename)) {
            Schema::create($this->tablename, function (Blueprint $table) {
                $table->id();
                $table->string('enable')->nullable();
                $table->integer('ref')->default(0);
                $table->integer('level')->default(1);
                $table->integer('pos')->default(0);
                $table->timestamps();

                $table->string('email')->nullable();
                $table->string('description')->nullable();
            });
        }
    
        
        //
        //Schema::dropIfExists("rmembers");

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view("jinytable::datalist",['rules'=>$this->rules]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        unset($this->rules['edit_id']); // 초기화
        return view("jinytable::dataedit",['rules'=>$this->rules]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 라이브와이어에서 처리됨
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
    public function edit($id)
    {
        $this->rules['edit_id'] = $id;
        return view("jinytable::dataedit",['rules'=>$this->rules]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 라이브와이어에서 처리됨
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
