<?php
	@session_start();

	// include ($_SERVER['DOCUMENT_ROOT']."/func/layout.class.php");

	// include "./func/layout.class.php";
	class layout {
		public $meta;

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

		function __construct(){ 
        	$a = func_get_args(); 
        	$i = func_num_args(); 
        	if (method_exists($this,$f='__construct'.$i)) { 
            	call_user_func_array(array($this,$f),$a); 
        	} 
    	} 
    
    	function __construct1($a1){ 
        	echo('__construct with 1 param called: '.$a1.PHP_EOL); 
    	} 
    
    	function __construct2($a1,$a2){ 
        	echo('__construct with 2 params called: '.$a1.','.$a2.PHP_EOL); 
    	} 
    
		function __construct3($a1,$a2,$a3){ 
        	echo('__construct with 3 params called: '.$a1.','.$a2.','.$a3.PHP_EOL); 
    	} 



		// ++ meta
		function setMeta(){	
			// 언어셋을 UTF-8로 지정
			array_push($this->meta, "jquery", "");
			
		}


		function showHTML(){

			// array_push($this->javascript, "charSet", "<script type=\"text/javascript\" src=\"//code.jquery.com/jquery-1.11.0.min.js\"></script>\n");
			$this->javascript['charSet'] = "<script type=\"text/javascript\" src=\"//code.jquery.com/jquery-1.11.0.min.js\"></script>\n";

			$this->html = "<!doctype html>\n";	// HTML 5 로 선언!
			$this->html .="<html>\n";
			$this->html .="<head>\n";

			// ++ 자바스크립트 출력
			foreach ($this->javascript as $value){ $this->html .= $value; }

			$this->html .= "</head>\n";
			$this->html .= "<body>\n";
			$this->html .= "layout class";
			$this->html .= "</body>\n";
			$this->html .= "</html>";

			echo $this->html;

			echo "aaa";
		}
	}

	$site_env = "site_env ";
	$layout = new layout($site_env);
	// $layout->setMeta();

	$layout->showHTML();

?>