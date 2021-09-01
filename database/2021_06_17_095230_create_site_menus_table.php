<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();
            $table->string('enable')->nullable();
            $table->string('code')->nullable();
            $table->string('title')->nullable();
            $table->string('uri')->nullable();
            $table->text('description')->nullable();
            $table->string('operator')->nullable();

            $table->unsignedInteger('level')->nullable();
            $table->unsignedInteger('ref')->nullable();
            $table->unsignedInteger('pos')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_menus');
    }
}
