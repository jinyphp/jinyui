<?php
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

	// include "./func/css.php";
	// include "./func/members.php";
	// include "./func/reseller.php";
	// include "./func/hosting.php";

	$javascript = "<script>
		function backup(mode,uid,limit){
			var url = \"ajax_backup.php\";
        	var form = document.hosting;
        	form.mode.value = mode;
        	form.uid.value = uid;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);	
        }

        function list(limit){
			var url = \"ajax_backup.php\";
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
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();

		if($mode == "new"){
			//echo "new backup <br>";

			// $sales_db->hostname

			$backup_file = $sales_db->database."_".date("Y-m-d.H-i-s").".sql";
			$command = "mysqldump --opt -u".$sales_db->user." -p".$sales_db->password." ".$sales_db->database." > $backup_file";
			//echo $command;
			exec($command,$output);


			$insert_filed = "`regdate`,";
			$insert_value = "'$TODAYTIME',";

			$insert_filed .= "`filename`,";
			$insert_value .= "'$backup_file',";

			$query = "INSERT INTO backup ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			//echo $query;
			_sales_query($query);

		} else if($mode == "delete"){
			//# 선택 전표 삭제
			$TID = $_POST['TID'];
    		for($i=0;$i<count($TID);$i++){
    			$query = "select * from backup WHERE `Id`='$TID[$i]'";
    			if($rows = _sales_query_rows($query)){
    				$query1 = "DELETE FROM `backup` WHERE `Id`='$TID[$i]'";
    				//echo $query1."<br>";
					_sales_query($query1);

					unlink($rows->filename);
				}

    		}
    	} else if($mode == "restore"){		
    		$uid = _formdata("uid"); 
    		$query = "select * from backup WHERE `Id`='$uid'";
    		//echo $query."<br>";
    		if($rows = _sales_query_rows($query)){
    			echo "restore : ".$rows->filename."<br>";
    		}		
		}


		$body = $javascript._theme_page($site_env->theme,"service_backup",$site_language,$site_mobile);	

		$_block_num = 10;
		
		$limit = _formdata("limit"); 

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);

		
		$body = str_replace("{formstart}","<form id=\"data\" name='hosting' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='uid' id=\"uid\">
					   			<input type='hidden' name='mode' id=\"mode\">
					   			<input type='hidden' name='limit' id=\"limit\">
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='백업' onclick=\"javascript:backup('new','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='삭제' onclick=\"javascript:backup('delete','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{delete}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);
		


		$query = "select * from backup ";	
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		//echo $query;

		if($rowss = _sales_query_rowss($query)){

			$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>백업일자</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >파일명</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'></td>
						</tr>
					</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->title."</a>";
					if(!$rows->enable) $title_name = "<span style=\"text-decoration:line-through;\">".$title_name."</span>";

					$restore ="<input type='button' value='복원' onclick=\"javascript:backup('restore','".$rows->Id."','$limit')\" style=\"".$css_btn_gray."\" >";  

					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='font-size:12px;padding:10px;' width='30'>".$tid."</td>
							<td style='font-size:12px;padding:10px;' width='120'>".$rows->regdate."</td>
							<td style='font-size:12px;padding:10px;'><a href='".$rows->filename."'>".$rows->filename."</a></td>														
							<td style='font-size:12px;padding:10px;' width='100'> $restore </td>
							</tr>
						</table>";
				}

				$list .= _pagination($_list_num,$_block_num,$limit,$total);
				$body = str_replace("{datalist}",$list,$body);
		
		} else {
			$msg = "백업 기록이 없습니다.";
			$body = str_replace("{datalist}",$msg,$body);		
		}	

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		
		echo $body;

	}

	
?>