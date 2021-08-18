<?

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



	$javascript = "<script>

		function mem_mode(mode,uid,limit){
			var url = \"ajax_site_members_editup.php\";
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
			var url = \"site_members_edit.php\";

			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }
                
        function list(limit){
        	var url = \"ajax_site_members.php\";
        	var form = document.site;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);	
        }

        function mem_point(email){
            var url = \"site_members_point.php\";

			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.email.value = email;
			
			form.submit();	
        }

        function mem_emoney(email){
			//var url = \"ajax_site_members_emoney.php?email=\"+email;	
            //ajax_html('#mainbody',url);

            var url = \"site_members_emoney.php\";

			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.email.value = email;
			
			form.submit();

        }
                           
    	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.site.chk_all.checked == true) chk[i].checked = true;
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
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");
		

		$body = $javascript._theme_page($site_env->theme,"site_members",$site_language,$site_mobile);

		
		
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
								<input type='hidden' name='email' value='$email'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);


		$button ="<input type='button' value='신규등록' onclick=\"javascript:edit('new','0','$limit')\" style=\"$css_btn_gray\" >";          
		$body = str_replace("{new}",$button,$body);

		//$button ="<input type='button' value='예약어' onclick=\"javascript:mem_reserved('new','0')\" style=\"$css_btn_gray\" >";          
		$body = str_replace("{reserved}","",$body);
		
		//$button ="<input type='button' value='블랙리스트' onclick=\"javascript:mem_blacklist('new','0')\" style=\"$css_btn_gray\" >";          
		$body = str_replace("{blacklist}","",$body);

		//$button ="<input type='button' value='이머니' onclick=\"javascript:mem_emoney('new','0')\" style=\"$css_btn_gray\" >";          
		$body = str_replace("{emoney}","",$body);

		//$button ="<input type='button' value='포인트' onclick=\"javascript:mem_point('new','0')\" style=\"$css_btn_gray\" >";          
		$body = str_replace("{point}","",$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"$css_btn_gray\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);


		// 국가 선택 


		
		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("members_country",$css_textbox,"members_country",$country_rowss,$site_country,"code","name","국가를선택해 주세요") ,$body);


		


		$_form_select_sex = "<select name='members_sex' style='$css_textbox' id=\"members_sex\">";
		$_form_select_sex .= "<option value='man'>man</option>";
		$_form_select_sex .= "<option value='woman'>woman</option>";
		$_form_select_sex .= "<option value='business'>business</option>";
		$_form_select_sex .= "</select>";
		$body = str_replace("{sex}",$_form_select_sex,$body);



		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_members` ";
		
		if($searchkey && $cate){
			$query .= " where email like '%".$searchkey."%' or username like '%".$searchkey."%' ";
		} else if($cate) {
			$query .= " where cate = '".$cate."' ";
		} else if($searchkey) {
			$query .= " where email like '%".$searchkey."%' or username like '%".$searchkey."%'  ";
		}
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";		  
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>승인</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>가입일자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>국가</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>성별</td>";	
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>회원명</td>";	
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>이메일</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>할인율</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>적립금</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>포인트</td>";
			$list .= "</tr>
					  </table>";
			// $listbar = _pagination($_list_num,$_block_num,$limit,$total);

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";			

				if($rows->auth) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30' > 
					<a href='#' onclick=\"javascript:mem_mode('disable','".$rows->Id."','$limit')\">▣</a></td>";
				else $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>
					<a href='#' onclick=\"javascript:mem_mode('enable','".$rows->Id."','$limit')\">□</a></td>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>".$rows->regdate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->country."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->sex."</td>";	
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->username."</td>";	

				$email_link = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->email."</a>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$email_link."</td>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->discount."%</td>";
				$emoney_link = "<a href='#' onclick=\"javascript:mem_emoney('".$rows->email."')\">".$rows->emoney."</a>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$emoney_link."</td>";
				$point_link = "<a href='#' onclick=\"javascript:mem_point('".$rows->email."')\">".$rows->point."</a>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$point_link."</td>";
				$list .= "</tr>
						</table>";	
				

			}


			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{member_list}",$list.$listbar,$body);
			echo $body;
			
		} else {
			$msg = "회원 목록 없습니다.";
			$body = str_replace("{member_list}",$msg,$body);
			echo $body;
		}	
		
		
	} else {
		
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
		
	}

	
?>