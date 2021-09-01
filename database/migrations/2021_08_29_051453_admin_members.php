<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("admin_members", function (Blueprint $table) {
            $table->id();
            $table->string('enable')->nullable();
            $table->integer('ref')->default(0);
            $table->integer('level')->default(1);
            $table->integer('pos')->default(0);
            $table->timestamps();

            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('sex')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('post')->nullable();
            $table->string('address')->nullable();
            $table->string('auth')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('emoney')->nullable();
            $table->string('point')->nullable();
            $table->string('discount')->nullable();
            $table->string('regdate')->nullable();
            $table->string('lastlog')->nullable();
            $table->string('regref')->nullable();

            // 1:1
            /*
            $table->BigInteger('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')
                ->onDelete('cascade'); // 회원 삭제시, 같이 삭제
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("admin_members");
    }
}
