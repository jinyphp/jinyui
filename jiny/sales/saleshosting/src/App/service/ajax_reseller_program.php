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
	include ($_SERVER['DOCUMENT_ROOT']."/func/currency.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");

	$javascript = "<script>
		function mode(mode,uid,limit){
			var url = \"ajax_reseller_program_editup.php\";
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
            var url = \"reseller_program_edit.php\";		
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_reseller_program.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#mainbody',url);
    	}


        /*
		function edit(mode,uid){
			var url = \"reseller_program_edit.php?mode=\" + mode + \"&uid=\" + uid;
			location.replace(url);	
        }
                
        function list(limit){
            var url = \"ajax_reseller_program.php?limit=\"+limit;
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }
        */

        // 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.sales.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

    	// 국가
 		$('#country').on('change',function(){
        	list(0);
    	});
              
    </script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// 서비스 관련 함수들 
		include "service_function.php";

		$body = $javascript._theme_page($site_env->theme,"service_reseller_program",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);

		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='sales' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='신규추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);

		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","국가별 체널프로그램") ,$body);


			/*
			$_list_num = 10;
			$_block_num = 10;
			$mode = _formmode();
			$limit = _formdata("limit"); 

		
			$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);

		
			$searchkey = _formdata("searchkey");
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
			$body = str_replace("{search}",$button_search,$body);
			*/
		
		

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];
		$body = str_replace("{reseller}",$email,$body);


		$query = "select * from service.reseller_program where reseller = '$email' ";
		if($searchkey) $query .= " and title like '%".$searchkey."%' ";		
		$query .= "order by level desc ";
		
			$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

			// 검색된 데이터 내에서 , limit 설정 
			if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
			// echo $query;

			if($rowss = _mysqli_query_rowss($query)){

				$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>등록일자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='40'>국가</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >타이틀</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>레벨</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>마진율</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>설정비</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>유지비</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>체널수</td>
							</tr>
						</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->title."</a>";
					if(!$rows->enable) $title_name = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->title."</a></span>";

					$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";


					$setup = _currency_format($site_env->currency,$rows->setup);
					$charge = _currency_format($site_env->currency,$rows->charge);
				
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> $tid </td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='40'> 
									<img src='../images/flags/".$rows->country.".png' width='20' border=0></td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->level."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->margin."%</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$setup."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$charge."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->ucount."</td>
							</tr>
						</table>";

				}


			
				// $list .= _listbar($_list_num,$_block_num,$limit, $total);
				$body = str_replace("{datalist}",$list,$body);
		
			} else {
				$msg = "내역이 없습니다.";
				$body = str_replace("{datalist}",$msg,$body);		
			}		

		echo $body;
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>