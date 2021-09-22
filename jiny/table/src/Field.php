<?php 
namespace Jiny\Table;

/**
 * Field DTO
 */

class Field
{
    // 리스트, 폼필드의 제목을 출력합니다.
    public $title;

    // 필드명
    // 컬럼 => 컬럼을 출력합니다.
    // 컬럼.테이블_ => 1:N 관계형 테이블에서, 컬럼을 사용합니다.
    // 컬럼.테이블* => M:N 관계형 테이블에서, 컬럼을 사용합니다.
    // 컬럼.테이블= => 1:1 관계의 테이블에서, 컬럼을 사용합니다.
    public $name;

    // 폼 입력을 허용합니다. true or flase
    public $form;

    // 입력받는 데이터 타입입니다.
    // text, radio, check, textarea
    // html : 문자열을 출력합니다.
    // link: 링크를 생성합니다.
    public $input;
    public $link;
    public $value;

    //
    public $placeholder;
    
    // 기본값입니다.
    public $default;

    // form을 출력하는 순서를 지정합니다.
    public $form_pos;

    // 리스트를 출력합니다.
    public $list;
    // 선택한 컬럼을 기준으로 정렬을 합니다.
    public $list_sort;
    // crud 의 수정링크로 이동합니다.
    public $list_edit;
    // 리스트를 출력하는 순서를 지정합니다.
    public $list_pos;

    // 해당필드로 검색을 허용합니다.
    public $filter;
    // 검색필드를 출력하는 순서를 지정합니다.
    public $filter_pos;
}