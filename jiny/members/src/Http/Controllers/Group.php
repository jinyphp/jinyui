<?php

namespace Jiny\Members\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

use Jiny\Members\Http\Controllers\CrudController;

class Group extends CrudController
{
    public $rules;
    public function __construct()
    {
        $this->tablename="site_members_group";
        $this->rules['tablename'] = $this->tablename;
        $this->rules['routename'] = explode(".", Route::currentRouteName())[0];

        $this->rules['view']['list'] = "jinymem::members.group.list";
        $this->rules['view']['edit'] = "jinymem::members.group.edit";
        $this->rules['view']['edit'] = "jinymem::members.group.edit";



        $this->rules['thead'] =[
            ['title'=>"id",'field'=>"id"],
            ['title'=>"이메일",'field'=>"email"],
            ['title'=>"그룹",'field'=>"group"]
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
                $table->string('groups')->nullable();
            });
        }
    
        
        //
        //Schema::dropIfExists("rmembers");

    }





}
