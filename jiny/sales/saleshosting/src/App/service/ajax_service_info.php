<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hosting.php");


	$javascript = "<script>
		function user_renewal(mode,uid){
			var url = \"ajax_hosting_users_editup.php?mode=\"+mode+\"&uid=\"+uid;
			alert(url);

			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });

            // var url = \"hosting_renewal.php\";
			/// url_replace(url);			
		}

		function members_edit(mode,uid){
            var url = \"/members/site_members_edit.php?mode=\"+mode+\"&uid=\"+uid;
			url_replace(url);			
		}
	</script>";
	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$body = $javascript._theme_page($site_env->theme,"service_info",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,160),$body);

		$body=str_replace("{formstart}","<form id='data' name='hosting' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$email = $_COOKIE['cookie_email'];
		$members = _members_rows($email);

		// 회원 정보 표시
		$body = str_replace("{member_name}",$members->username." ".$members->firstname,$body);
		$body = str_replace("{member_email}",$members->email,$body);
		$body = str_replace("{members_emoney}",$members->emoney,$body);
		$body = str_replace("{members_point}",$members->point,$body);

		$body = str_replace("{edit}","<input type='button' value='회원수정' onclick=\"javascript:members_edit('edit','".$members->Id."')\" style=\"".$css_btn_gray."\" >",$body);
		
		// $body = str_replace("{renewal}","<input type='button' value='연장신청' onclick=\"javascript:service('renewal','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		// $hosting = _hosting_rows($members->email);
		// $body = str_replace("{renewal}","<input type='button' value='연장신청' onclick=\"javascript:user_renewal('renewal','".$hosting->Id."')\" style=\"".$css_btn_gray."\" >",$body);
		


		$query = "select * from service.service_host where email = '".$email."'"; //" order by level asc";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			// echo "ID = ".$rows->Id."<br>";
			$body = str_replace("{renewal}","<input type='button' value='연장신청' onclick=\"javascript:user_renewal('hostingRenewal','".$rows->Id."')\" style=\"".$css_btn_gray."\" >",$body);

		} else {
			$body = str_replace("{renewal}","",$body);
		}	

		$hostingPlan_rows = _service_hostingPlanRows_Id($rows->plan);
		$body = str_replace("{hosting_plan}",$hostingPlan_rows->title,$body);

		$body = str_replace("{host_code}","<b>".$rows->code."</b>",$body);
		$body = str_replace("{host_domain}","<a href='http://".$rows->domain."/?admin=".$rows->adminkey."'>".$rows->domain."</a>",$body);


		$body = str_replace("{site}",$rows->site,$body);
		$body = str_replace("{shop}",$rows->shop,$body);
		$body = str_replace("{sales}",$rows->sales,$body);
		$body = str_replace("{business}",$rows->business,$body);
		$body = str_replace("{company}",$rows->company,$body);
		$body = str_replace("{trans}",$rows->trans,$body);
		$body = str_replace("{manager}",$rows->manager,$body);
		$body = str_replace("{house}",$rows->house,$body);
		$body = str_replace("{quotation}",$rows->quotation,$body);
		$body = str_replace("{taxprint}",$rows->taxprint,$body);

		$body = str_replace("{expire}",$rows->expire,$body);
		$body = str_replace("{service_type}",$rows->service_type,$body);

		//# 전처리 plug코드 실행

		// 타이틀 이미지 전처리기 코드를 처리하여, 이미지를 진열함
		// 출력, Body {titleimg_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "titleimg_";
		if($keyword_count = _keyword_count($body, "{".$keyword)){
			$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				// CSS id = 기능구분
				// CSS class = 세부 설정값 
				$body = str_replace("{".$class."}","<article class=\"$class\" id=\"title_images\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_titleimg.php?code=$rows[$i]")."</script>
					</article>\n",$body);
			}
		}

		// 상품진열 전처리기 코드를 처리하여, 상품을 진열함
		//상품리스트 출력, Body {goodlist_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "goodlist_";
		if($keyword_count = _keyword_count($body, "{".$keyword)){
			$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$body = str_replace("{".$class."}","<article  class=\"$class\" style='width:100%;z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_goodlist.php?code=$rows[$i]")."</script>
					</article>\n",$body);
			}
		}
	


		// 계시물 전처리기 코드를 처리하여, 계시판 내용 표시
		// 보드리스트 출력, Body {board_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "board_";
		if($keyword_count = _keyword_count($body, "{".$keyword)){
			$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_boardlist.php?board=$rows[$i]")."</script>
					</article>\n",$body);
			}
		}



		// 블럭코드 전처리기 코드를 처리하여, 상품을 진열함
		// 블럭리스트 출력, Body {blocklist_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "block_";
		if($keyword_count = _keyword_count($body, "{".$keyword)){
			$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_blocklist.php?code=$rows[$i]")."</script>
					</article>\n",$body);
			}
		}
		

		echo $body;

	} else {

		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");

	}

?>