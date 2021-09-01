<?php
	//*  WebLib V1.5
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.04 = 코드정리 

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	

		$skinbody  ="<!doctype html>\n";	// HTML 5 로 선언!
		$skinbody .="<html>\n";
		$skinbody .="<head>\n";
		
		// 언어셋을 UTF-8로 지정
		$skinbody .= _html_meta("utf-8");

		//$skinbody .= _html_head_crossbrowser();

		// 작성한 Header 파일을, 치환 형태로 코드삽입.	
		$skinbody .= " <script src=\"//code.jquery.com/jquery-1.11.0.min.js\"></script>\n";

		$skinbody .= "</head>\n";

		/////////////////////////////

		//$skinbody .= _layout_templet();
		$skinbody .= _html_body("0","0","#f1f1f1"); // ex)_html_body($top,$left,$bgcolor)
		$skinbody .="</html>";
	
	$body = $skinbody;	
		




	$javascript = "<script>
		$('#btn_main').on('click',function(){
			// var search = document.goods.searchkey.value;
        	alert(\"a\");
        	
    	});

		$('#main_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	//pagelist(0);
        	}
    	});

		function main_search(){

			var search = $('main_search').val();
			alert(search);

			// var search = document.goods.searchkey.value;
            
            var url = \"/ajax_search.php?search=\";
        	alert(url);
          
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
       
		}
	</script>";

		// <form name='search' method='post' enctype='multipart/form-data' action='search.php'>
		$search_form = "
		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<tr>
				<td><input type='text' name='main_search' id=\"main_search\" style=\"$css_textbox\"></td>
				<td width='5'></td>
				<td width='50'> <input type='button' onclick=\"javascript:main_search()\" value='검색' id=\"btn_main\" style=\"$css_btn_gray\"> </td>
			</tr>
		</table>";

			$_body = str_replace("{search}",$javascript.$search_form,$_body);
		
	} 

	$body = str_replace("</body>", $_body, $body);

	//$body =  _skin_emptybody($skin_name);
	// $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
	//$search = _formdata("main_search");
	//echo $search;
	//$body = str_replace("<!--{skin_emptybody}-->","<script>"._javascript_ajax_html("#mainbody","/ajax_search.php?ajaxkey=".$ajaxkey."&search=".$search)."</script>",$body);



	echo $body;


?>