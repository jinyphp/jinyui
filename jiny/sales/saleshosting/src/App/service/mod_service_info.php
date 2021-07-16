<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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
	
	
	// $_body = $javascript._skin_page($skin_name,"service_info");
	$_body = $javascript._theme_page($site_env->theme,"service_info",$site_language,$site_mobile);
	$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,160),$body);

	$_body=str_replace("{formstart}","<form id='data' name='hosting' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$_body);
	$_body = str_replace("{formend}","</form>",$_body);

	$email = $_COOKIE['cookie_email'];
	$members = _members_rows($email);

	// 회원 정보 표시
	$_body = str_replace("{member_name}",$members->username." ".$members->firstname,$_body);
	$_body = str_replace("{member_email}",$members->email,$_body);
	$_body = str_replace("{members_emoney}",$members->emoney,$_body);
	$_body = str_replace("{members_point}",$members->point,$_body);

	$_body = str_replace("{edit}","<input type='button' value='회원수정' onclick=\"javascript:members_edit('edit','".$members->Id."')\" style=\"".$css_btn_gray."\" >",$_body);
		

	$query = "select * from service.service_host where email = '".$email."'"; //" order by level asc";
	// echo $query."<br>";
	if($rows = _mysqli_query_rows($query)){	
		// echo "ID = ".$rows->Id."<br>";
		$_body = str_replace("{renewal}","<input type='button' value='연장신청' onclick=\"javascript:user_renewal('hostingRenewal','".$rows->Id."')\" style=\"".$css_btn_gray."\" >",$_body);
	} else {
		$_body = str_replace("{renewal}","",$_body);
	}	

	$hostingPlan_rows = _service_hostingPlanRows_Id($rows->plan);
	$_body = str_replace("{hosting_plan}",$hostingPlan_rows->title,$_body);

	$_body = str_replace("{host_code}","<b>".$rows->code."</b>",$_body);
	$_body = str_replace("{host_domain}","<a href='http://".$rows->domain."/?admin=".$rows->adminkey."'>".$rows->domain."</a>",$_body);


	$_body = str_replace("{site}",$rows->site,$_body);
	$_body = str_replace("{shop}",$rows->shop,$_body);
	$_body = str_replace("{sales}",$rows->sales,$_body);
	$_body = str_replace("{business}",$rows->business,$_body);
	$_body = str_replace("{company}",$rows->company,$_body);
	$_body = str_replace("{trans}",$rows->trans,$_body);
	$_body = str_replace("{manager}",$rows->manager,$_body);
	$_body = str_replace("{house}",$rows->house,$_body);
	$_body = str_replace("{quotation}",$rows->quotation,$_body);
	$_body = str_replace("{taxprint}",$rows->taxprint,$_body);

	$_body = str_replace("{expire}",$rows->expire,$_body);
	$_body = str_replace("{service_type}",$rows->service_type,$_body);

	//# 전처리 plug코드 실행

	// 타이틀 이미지 전처리기 코드를 처리하여, 이미지를 진열함
	// 출력, Body {titleimg_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "titleimg_";
	if($keyword_count = _keyword_count($_body, "{".$keyword)){
		$rows = _keyword_rows($_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				// CSS id = 기능구분
				// CSS class = 세부 설정값 
				$_body = str_replace("{".$class."}","<article class=\"$class\" id=\"title_images\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_titleimg.php?code=$rows[$i]")."</script>
					</article>\n",$_body);
		}
	}

		// 상품진열 전처리기 코드를 처리하여, 상품을 진열함
		//상품리스트 출력, Body {goodlist_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "goodlist_";
		if($keyword_count = _keyword_count($_body, "{".$keyword)){
			$rows = _keyword_rows($_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$_body = str_replace("{".$class."}","<article  class=\"$class\" style='width:100%;z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_goodlist.php?code=$rows[$i]")."</script>
					</article>\n",$_body);
			}
		}
	


		// 계시물 전처리기 코드를 처리하여, 계시판 내용 표시
		// 보드리스트 출력, Body {board_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "board_";
		if($keyword_count = _keyword_count($_body, "{".$keyword)){
			$rows = _keyword_rows($_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$_body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_boardlist.php?board=$rows[$i]")."</script>
					</article>\n",$_body);
			}
		}



		// 블럭코드 전처리기 코드를 처리하여, 상품을 진열함
		// 블럭리스트 출력, Body {blocklist_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "block_";
		if($keyword_count = _keyword_count($_body, "{".$keyword)){
			$rows = _keyword_rows($_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$_body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_blocklist.php?code=$rows[$i]")."</script>
					</article>\n",$_body);
			}
		}
		
?>