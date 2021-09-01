<?php

namespace Jiny\Members\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

use Jiny\Members\Http\Controllers\CrudController;

class Agreements extends CrudController
{
    public $rules;
    public function __construct()
    {
        $this->tablename="site_members_agree";
        $this->rules['tablename'] = $this->tablename;
        $this->rules['routename'] = explode(".", Route::currentRouteName())[0];

        $this->rules['view']['list'] = "jinymem::members.agreements.list";
        $this->rules['view']['edit'] = "jinymem::members.agreements.edit";
        $this->rules['view']['edit'] = "jinymem::members.agreements.edit";



        $this->rules['thead'] =[
            ['title'=>"id",'field'=>"id"],
            ['title'=>"코드",'field'=>"code"],
            ['title'=>"타이틀",'field'=>"title"]
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

                $table->string('code')->nullable();
                $table->string('title')->nullable();
                $table->string('lang')->nullable();
                $table->string('require')->nullable(); // 필수동의
                $table->string('content')->nullable();
            });
        }
    
        
        //
        //Schema::dropIfExists("rmembers");

    }


}
