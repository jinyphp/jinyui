<?php
	//*  Openshopping V2.1
	//*  Program by : hojin lee
	//*  

	// update : 2016.01.04 = 코드정리 

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

// TinyMCD Editor
			$tinyMCD = "<script src=\"//cdn.tinymce.com/4/tinymce.min.js\"></script>
  						<script type=\"text/javascript\"> 
  					
tinymce.init({
  selector: \"textarea\",
  height: 300,
  plugins: [
    \"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker\",
    \"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking\",
    \"table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern\"
  ],

  toolbar1: \"newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect\",
  toolbar2: \"cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor\",
  toolbar3: \"table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft\",

  menubar: false,
  toolbar_items_size: 'small',

  style_formats: [{
    title: 'Bold text',
    inline: 'b'
  }, {
    title: 'Red text',
    inline: 'span',
    styles: {
      color: '#ff0000'
    }
  }, {
    title: 'Red header',
    block: 'h1',
    styles: {
      color: '#ff0000'
    }
  }, {
    title: 'Example 1',
    inline: 'span',
    classes: 'example1'
  }, {
    title: 'Example 2',
    inline: 'span',
    classes: 'example2'
  }, {
    title: 'Table styles'
  }, {
    title: 'Table row 1',
    selector: 'tr',
    classes: 'tablerow1'
  }],

  templates: [{
    title: 'Test template 1',
    content: 'Test 1'
  }, {
    title: 'Test template 2',
    content: 'Test 2'
  }],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});

  						</script>";


  	$javascript = "<script>

		$('#btn_search').on('click',function(){
        	board_list(0);
    	});

		$('#goods_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		list(0);
        	}
    	});

    	function search(){
    		list(0);
    	}

        function list(limit){
			var url = \"ajax_board.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#main-content',url);
    	}

        function newEdit(mode,uid,limit){   	
        	var url = \"ajax_board_new.php\";
        	var form = document.site;
        	form.mode.value = mode;
        	form.uid.value = uid;
  			form.limit.value = limit;

			ajax_html('#main-content',url);	 	
        }

        function view(mode,uid,limit){
			var url = \"ajax_board_view.php\";
        	var form = document.site;
        	form.mode.value = mode;
        	form.uid.value = uid;
  			form.limit.value = limit;

			ajax_html('#main-content',url);
    	}

		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

	</script>";					

  	// ++ 계시판 관련 함수 라이브러리	
	include "./board/board.class.php";


	$body = _theme_emptybody();
   	
	// ++ 계시판 출력
	if($board = _formdata("board")){

		if($board_rows = _board_rows($board)){

			$mainbody = $javascript._theme_page($site_env->theme,"board",$site_language,$site_mobile);
			$menu_id = _menuID_byBoard($board);
			// echo "menu_id = ".$menu_id;
			$mainbody = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language, $menu_id ),$mainbody);
		
			$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
			require_once("inc.board_list.php");

			$body = str_replace("<!--{skin_emptybody}-->",$mainbody,$body);

		} else {
			$body = str_replace("<!--{skin_emptybody}-->","11계시판 정보를 읽어 올 수 없습니다.",$body);
		}

		// echo $body.$javascript;
	} else {
		$body = str_replace("<!--{skin_emptybody}-->","<div id=\"error_massage\">Error! 계시판 코드가 없습니다.</div>",$body);
			
	}

	echo $body;	

	$php_end = get_time();
	$php_time = $php_end - $php_start;
	echo "<!-- Second ".$php_time."-->";


	function _menuID_byBoard($board){
		global $_current_menuCode;
		$menu_code = $_current_menuCode;
		$url = $_SERVER['REQUEST_URI'];

		$query = "select * from site_menu where enable = 'on' and code = '".$menu_code."' and urlmode = 'board' and url = '".$board."' order by pos desc";
		//echo $query."<br>";
		if($menu_rows = _mysqli_query_rows($query)){

			$tree = explode(">", $menu_rows->tree);
			return str_replace(";","",$tree[1]);
			// echo "menu-id = $menu_id"."<br>";;
			
		}

	}

	// ++ body에서 특정 키워드를 삭제함
	function _str_remove($key,$body){
		return str_replace($key,$val,$body);
	}

?>