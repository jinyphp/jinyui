<?php
	//+ layout 클래스 선언 : 2016.05.15
	class layout {		
		public $mete;

		public $seo_title;
		public $seo_keyword;
		public $seo_description;

		public $css;					// CSS 어레이
		public $javascript;				// java 어레이

		public $body_leftMargin;		// body 좌축 여백마진
		public $body_topMargin;			// body 상단 여백마진
		public $body_align;				// body 정렬방식
		public $body_bgcolor;			// body 배경색
		public $body_width;				// body 가로크기

		public $layout;
		
		public $header;
		public $header_width;
		public $header_align;
		public $header_bgcolor;

		public $menu;					// 메뉴
		public $menuTree;				// 메뉴트리 내용
		
		public $bodyLeft;
		public $bodyMain;
		public $bodyRight;
		
		public $footer;
		public $footer_width;
		public $footer_align;
		public $footer_bgcolor;

		public $html;

		// ++ meta
		function setMeta(){	
			/*		
			// 언어셋을 UTF-8로 지정
			array_push($this->meta, "charSet", "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n");
			*/
		}

		// ++ 완성된 페이지를 출력한다.
		function showHTML(){
			/*
			$this->html = "<!doctype html>\n";	// HTML 5 로 선언!
			$this->html .="<html>\n";
			$this->html .="<head>\n";
			$this->html .= "</head>\n";
			$this->html .= "<body>\n";
			$this->html .= "layout class";
			$this->html .= "</body>\n";
			$this->html .= "</html>";

			echo $this->html;
			*/

			echo "aaa";
		}

	}

?>