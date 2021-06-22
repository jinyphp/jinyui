<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JinyField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jiny_fields', function (Blueprint $table) {
            $table->id();

            $table->string('uri');
            $table->string('code');
            $table->string('title')->nullable();

            /* 목록검색 */
            $table->string('filter')->nullable(); // 검색필터
            $table->string('filter_pos')->nullable();

            $table->string('list')->nullable(); // 목록 출력 여부
            $table->string('list_pos')->nullable(); // 출력번호
            $table->string('list_sort')->nullable();

            /* 수정 */
            $table->string('edit')->nullable(); // 수정편집 링크허용

            /* 삽입 및 편집 */
            $table->string('form')->nullable(); // 생성 및 수정폼 출력여부
            $table->string('form_pos')->nullable(); // 출력번호
            $table->string('form_type')->nullable();
            $table->string('form_placeholder')->nullable();
            $table->string('form_value')->nullable(); // 기본값
            $table->string('form_option')->nullable(); // 선택목록일 경우 기본목록
            $table->string('form_ref_table')->nullable(); //option이 외부 테이블일 경우
            $table->string('form_ref_field')->nullable();

            /* 외부참조 */
            $table->string('ref_table')->nullable();
            $table->string('ref_field')->nullable();
            
            /* 부가정보 */
            $table->text('description')->nullable(); //필드설명
            $table->string('operator')->nullable(); //조작자 정보
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
        Schema::dropIfExists('jiny_fields');
    }
}
