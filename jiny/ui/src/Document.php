<?php 
namespace Jiny\UI;

class Document
{
    private static $Instance;
    public $dom;

    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance()
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.                
            self::$Instance = new self();
            self::$Instance->dom = CDiv();
            return self::$Instance;
        } else {
            // 인스턴스가 중복
            return self::$Instance; 
        }
    }



}