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
        // 라이브와이어 예약어 충돌을 방지하기 위하여 (_)을 붙여서 사용함.
        
        Schema::create('jiny_fields', function (Blueprint $table) {
            $table->id();

            $table->string('_uri');
            $table->string('_code');
            $table->string('_title')->nullable();

            /* 목록검색 */
            $table->string('_list_filter')->nullable(); // 검색필터
            $table->string('_list_filter_pos')->nullable();

            $table->string('_list')->nullable(); // 목록 출력 여부
            $table->string('_list_pos')->nullable(); // 출력번호
            $table->string('_list_sort')->nullable();

            /* 수정 */
            $table->string('_edit')->nullable(); // 수정편집 링크허용

            /* 삽입 및 편집 */
            $table->string('_form')->nullable(); // 생성 및 수정폼 출력여부
            $table->string('_form_pos')->nullable(); // 출력번호
            $table->string('_form_type')->nullable();
            $table->string('_form_placeholder')->nullable();
            $table->string('_form_value')->nullable(); // 기본값
            $table->string('_form_option')->nullable(); // 선택목록일 경우 기본목록
            $table->string('_form_ref_table')->nullable(); //option이 외부 테이블일 경우
            $table->string('_form_ref_field')->nullable();

            /* 외부참조 */
            $table->string('_ref_table')->nullable();
            $table->string('_ref_field')->nullable();
            
            /* 부가정보 */
            $table->text('_description')->nullable(); //필드설명
            $table->string('_operator')->nullable(); //조작자 정보
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
