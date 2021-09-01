<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("relations", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('master');
            $table->BigInteger('master_id')->unsigned();

            $table->string('slave');
            $table->BigInteger('slave_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("relations");
    }
}
