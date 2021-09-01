<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");


	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hoosting.php");

	$javascript = "<script>

		function edit(mode,uid,limit){
			var url = \"service_server_edit.php\";
			var form = document.hosting;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }
                
        function list(limit){
        	var url = \"ajax_service_server.php\";
        	var form = document.hosting;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);

          	
        }

        // 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.hosting.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});


    </script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		// 서비스 관련 함수들 
		include "service_function.php";
		
		$body = $javascript._theme_page($site_env->theme,"service_partner",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);	

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];		
	
		$query = "select * from service.service_host where reseller = '$email' ";
		$total_host = _mysqli_query_count($query);
		$body = str_replace("{total_users}","<a href='hosting_users.php'>".$total_host."</a>",$body);

		$query = "select * from service.reseller where tree like '%".$_COOKIE['cookie_email']."%' order by pos desc";
		$total_reseller = _mysqli_query_count($query);
		$body = str_replace("{total_reseller}","<a href='reseller.php'>".$total_reseller."</a>",$body);

		$query = "select * from service.server where reseller = '$email' ";
		$total_server = _mysqli_query_count($query);
		$body = str_replace("{total_server}","<a href='service_server.php'>".$total_server."</a>",$body);

		echo $body;

	} else {

		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>